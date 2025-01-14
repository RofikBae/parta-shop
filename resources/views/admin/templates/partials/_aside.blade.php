<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('lte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{url('admin')}}">
            <i class="fa fa-angle-double-right"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/category')}}">
            <i class="fa fa-angle-double-right"></i> <span>Category</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/product')}}">
            <i class="fa fa-angle-double-right"></i> <span>Product</span>
          </a>
        </li>
      </ul>
    </section>
    
  </aside>