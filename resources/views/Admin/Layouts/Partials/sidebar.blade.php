<div class="list-group">
    <a href="{{ route('admin.homepage') }}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Login</a>
    <a href="{{ route('admin.product') }}" class="list-group-item" >
        <span class="fa fa-fw fa-cubes"></span>Products
        <span class="badge badge-dark badge-pill pull-right"></span>
    </a>
    <a href="{{ route('admin.category') }}" class="list-group-item" >
        <span class="fa fa-fw fa-cubes"></span>Categories
        <span class="badge badge-dark badge-pill pull-right"></span>
    </a>
    <div class="list-group collapse" id="submenu1">
        <a href="#" class="list-group-item">Category</a>
        <a href="#" class="list-group-item">Category</a>
    </div>
    <a href="{{ route('admin.usermanagement') }}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Users
        <span class="badge badge-dark badge-pill pull-right"></span>
    </a>
</div>
