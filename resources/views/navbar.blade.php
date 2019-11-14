<nav class="navbar navbar-default" style="margin-left:300px; width:1400px;">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
        <li><a href= "{{ route('home') }}">Dashboard</a></li>
        <!-- <li><a href="# }}">View All Tech</a></li> -->
        <li><a href= "{{ route('addTransactions') }}">Add Transactions</a></li>
        <li><a href= "{{ route('viewInventories') }}">Inventory</a></li>
        <li><a href= "{{ route('viewMenu', ['showAll'=>'1', 'showFood' => '0']) }}">Menu</a></li>
        </ul>
    </div>
</nav> 