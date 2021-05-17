<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel Admin @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('/assets/admin/css/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/edit.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Painel Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i
                        class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Site
            </div>

            <!-- Nav Item - Clientes -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.orders.index') }}"><i
                        class="fas fa-shopping-cart"></i><span>Pedidos</span></a>
            </li>

            <!-- Nav Item - Produtos -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#produtos"
                    aria-expanded="true" aria-controls="produtos">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Placas</span>
                </a>

                <div id="produtos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.placas.index') }}">Ver todas</a>
                        <a class="collapse-item" href="{{ route('admin.modelos.index') }}">Modelos</a>
                        <a class="collapse-item" href="{{ route('admin.molduras.index') }}">Molduras</a>
                        <a class="collapse-item" href="{{ route('admin.fundos.index') }}">Fundos</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Clientes -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.customers.index') }}"><i
                        class="fas fa-users"></i><span>Clientes</span></a>
            </li>

            <!-- Nav Item - Frases -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.frases.index') }}"><i
                        class="fas fa-align-justify"></i><span>Frases</span></a>
            </li>

            <!-- Nav Item - Banners -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.banners.index') }}"><i
                        class="far fa-images"></i><span>Banners</span></a>
            </li>

            <!-- Nav Item - Mensagens -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.messages.index') }}"><i
                        class="far fa-envelope"></i><span>Mensagens</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Administrador</div>

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}"><i
                        class="fas fa-users"></i><span>Usuários</span></a>
            </li>



            <!-- Nav Item - Configurações 
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#config" aria-expanded="true"
                    aria-controls="config">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Configurações</span>
                </a>
                <div id="config" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="">Funções</a>
                        <a class="collapse-item" href="">Permissões</a>
                    </div>
                </div>
            </li>

            Nav Item - Pages Collapse Menu 
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Item</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Itens 1:</h6>
                        <a class="collapse-item" href="">Item 1.1</a>
                        <a class="collapse-item" href="">Item 1.2</a>
                        <a class="collapse-item" href="">Item 1.3</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Itens 2:</h6>
                        <a class="collapse-item" href="">Item 2.1</a>
                        <a class="collapse-item" href="">Item 2.2</a>
                    </div>
                </div>
            </li>-->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsOrder" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter countOrders"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsOrder">
                                <h6 class="dropdown-header">Pedidos</h6>
                                <div class="dropdown-orders"></div>
                                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.orders.index') }}">Ver todos os pedidos</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsMessage" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter countMessages"></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsMessage">
                                <h6 class="dropdown-header">Mensagens</h6>
                                <div class="dropdown-messages"></div>
                                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.messages.index') }}">Ver todas as mensagens</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/assets/admin/vendor/jquery/jquery.min.js') }} "></script>
    <script src="{{ asset('/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/assets/admin/vendor/jquery-easing/jquery.easing.min.js') }} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    


    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/assets/admin/js/scripts.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/main.js') }}"></script>


    <script>
        $(document).ready(function() {

            // Order Notification
            function loadOrderNotification(view = '') {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.dashboard.orderNotification') }}",
                    method: "POST",
                    data: {
                        view: view
                    },
                    dataType: "json",
                    success: function(data) {
                        $('.dropdown-orders').html(data.notification);
                        if (data.unseen_notification > 0) {
                            $('.countOrders').html(data.unseen_notification);
                            //$("title").append(' ('+ data.unseen_notification +')');
                        }else{
                            $('.countOrders').html('');
                        }
                    }
                });
            };

            loadOrderNotification();

            $(document).on('click', '#alertsOrder', function() {
                $('.count').html('');
                loadOrderNotification('yes');
            });

            setInterval(function() {
                loadOrderNotification();
            }, 5000);


            // Messages Notification
            function loadMessageNotification(view = '') {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.dashboard.messageNotification') }}",
                    method: "POST",
                    data: {
                        view: view
                    },
                    dataType: "json",
                    success: function(data) {
                        $('.dropdown-messages').html(data.notification);
                        if (data.unseen_notification > 0) {
                            $('.countMessages').html(data.unseen_notification);
                        }else{
                            $('.countMessages').html('');
                        }
                    }
                });
            };

            loadMessageNotification();

            $(document).on('click', '#alertsMessage', function() {
                $('.count').html('');
                loadMessageNotification('yes');
            });

            setInterval(function() {
                loadMessageNotification();
            }, 5000);

        });

    </script>

</body>

</html>
