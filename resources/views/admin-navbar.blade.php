<nav class="navbar navbar-default" style="margin-left:300px; width:1400px;">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
        <li><a href= "{{ route('admin.dashboard') }}">Dashboard</a></li>
        <!-- <li><a href="# }}">View All Tech</a></li> -->
        <li><a href= "{{ route('admin.manageUsers') }}">Manage Users</a></li>
        <li><a href= "{{ route('admin.manageInventories') }}">Inventory</a></li>
        <li><a href= "{{ route('admin.manageMenu', ['showAll'=>'1', 'showFood' => '0']) }}">Menu</a></li>
        <li><a href= "{{ route('admin.manageTransaction') }}">Manage Transactions</a></li>
        <li><a href="{{route('admin.reports')}}">Report</a></li>
        </ul>
    </div>
</nav>