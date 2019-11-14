<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MenuItem;
class MenuItemController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($showAll, $showFood)
    {
        if($showAll){
            $menuItemList = DB::table('menu_items')->groupBy('id','type')->orderBy('name')->paginate(5);
            return view('menu.index', ['menu_items' => $menuItemList,'showAll'=>$showAll,'showFood' => $showFood]);
        }elseif($showFood){
            $menuItemList = DB::table('menu_items')->where('type', '<>', 'drink')->paginate(5);
            return view('menu.index', ['menu_items' => $menuItemList,'showAll'=>$showAll,'showFood' => $showFood]);
        }else{
            $menuItemList = DB::table('menu_items')->where('type', 'drink')->paginate(5);
            return view('menu.index', ['menu_items' => $menuItemList,'showAll'=>$showAll,'showFood' => $showFood]);
        }
    }

    public function filter($tag, $showAll, $showFood)
    {
            $menuItemList = DB::table('menu_items')->where('tags', 'ilike', '%'.$tag.'%' )->paginate(5);
            return view('menu.index', ['menu_items' => $menuItemList,'showAll'=>$showAll,'showFood' => $showFood, 'searching' => 1]);
    }

    public function search(Request $request){
        $search = $request->get('search');
        $result = DB::table('menu_items')->where('name', 'ilike', '%'.$search.'%')->paginate(3);
        return view('menu.index', ['menu_items' => $result, 'showAll'=>'1', 'showFood' => '0', 'searching' => true]);
    }

    public function searchAjax(Request $request){
        $search = $request->get('search');
        $result = DB::table('menu_items')->where('name', 'ilike', '%'.$search.'%')->get();
        return response()->json($result);
    }

    public function showRecipeAjax(Request $request){
        $search = $request->get('recipe_id');
        $result = DB::table('recipes')->where('id', $search)->get();
        return response()->json($result);
    }

    public function showPriceAjax(Request $request){
        $result = MenuItem::all('name', 'price');
        return response()->json($result);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new MenuItem;
        $this->validate($request,[
                'name'=>'required|unique:menu_items',
                'recipe_id'=>'exists:recipes,id|nullable',
                'type'=>'required',
        ]);
        $item->name = $request->name;
        $item->recipe_id = $request->recipe_id;
        $item->price = $request->price;
        $item->item_description = $request->item_description;
        $item->type = $request->type;
        $tags = "";
        if($request->input('tags')){
            foreach($request->input('tags') as $tag){
                $tags .= $tag . ", ";
            }
        }
        
        $item->tags = trim($tags, ', ');
        if($item->save()){
            return redirect()->route('admin.manageMenu', [1,0])
            ->with('success', 'Inventory added successfully');
        }
        return back()->withInput()->with('errors' , $validator->messages());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editItem = MenuItem::find($id);
        return view('menu.edit', ['item'=>$editItem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $tags = "";
        if($request->input('tags')){
            foreach($request->input('tags') as $tag){
                $tags .= $tag . ", ";
            }
        }

        
        $menuitemUpdate = MenuItem::where('id', $id)-> update([
            'name' => $request->input('name'),
            'recipe_id' => $request->input('recipe_id'),
            'price' => $request->input('price'),
            'item_description' => $request->input('item_description'),
            'type'=>$request->input('type'),
            'tags' => $tags

        ]);
        if($menuitemUpdate){
            return redirect()->route('admin.manageMenu', [1,0])
            ->with('success', 'Menu item updated successfully');
        }
        return back()->withInput()->with('error' ,'Error updating Item. Please try again.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = MenuItem::find( $id);
		if($item->delete()){
            
            //redirect
            return redirect()->route('admin.manageMenu', [1,0])
            ->with('success' , 'Item deleted successfully');
        }
        return back()->withInput()->with('error' , 'Item could not be deleted');
    }
}
