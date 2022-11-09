<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link centered ml-2">
        <span class="brand-text font-weight-light font-weight-bolder">Trang quản lý</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info" id="user">
                    <i class="nav-icon fas fa-user-circle"></i>
                    <span class="username">
                    <?php
                    $username = Session::get('admin_name');
                    $userid = Session::get('admin_id');
                    if($username){
                        echo "<button class='btn' onclick='userdetail($userid)' >$username</button>";
                    }
                    ?>
                    </span>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{$ur}}cate_add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{$ur}}cate_list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="dashboard" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Thống kê
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Sản phẩm
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{$ur}}product_add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{$ur}}product_list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Đơn hàng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="order_list_new" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn hàng mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="order_list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn hàng đã giao</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="order_list_cancel" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn hàng bị hủy</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Tài khoản
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{$ur}}user_add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm tài khoản</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{$ur}}user_list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách tài khoản</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            Slider
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{$ur}}slider_add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{$ur}}slider_list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách slider</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    @include('admin.modal.user_detail')

    <script type='text/javascript'>
   
        function userdetail(id){
            var url = "user_detail/"+id;
        $('#tbluserinfo tbody').empty();
           $.ajax({
            datatype: 'JSON',
            url: url,
               success: function(response){

                   // Add employee details
                   $('#tbluserinfo tbody').html(response.html);

                   // Display Modal
                   $('#userModal').modal('show'); 
               }
           });
    }
   </script>
</aside>
