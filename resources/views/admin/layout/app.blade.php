<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('plugins/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('plugins/img/favicon.png') }}">
    <title>
        Point Of Sale System
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="{{ asset('plugins/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/css/nucleo-svg.css') }}" rel="stylesheet" />

    <link href="{{ asset('plugins/css/nucleo-svg.css') }}" rel="stylesheet" />

    <link id="pagestyle" href="{{ asset('plugins/css/argon-dashboard.minf27d.css') }}" rel="stylesheet" />
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    {{-- datepicker --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

    {{-- sweetalert --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>

    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="dashboard.html" target="_blank">
                <img src="{{ asset('plugins/img/logo.png') }}" class="navbar-brand-img" alt="main_logo">
                <span class="ms-1 font-weight-bold">Maple Mart</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto h-100">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('admin#userLists') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('roles') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-bars-progress text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Role & Permissions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('productlistPage') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Product</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('category.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Category</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('invoicePage') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-receipt text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Invoice</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('customerlistPage') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-people-group text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Customer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('inventory') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-store text-primary text-sm opacity-10"></i>
                        </div>
                        @php
                            $number = DB::table('alerts')->sum('qty');
                            $inventories = DB::table('inventories')
                                ->select('product_id', 'stock_balance')
                                ->where('stock_balance', '<', $number)
                                ->get()
                                ->toArray();
                        @endphp
                        @if (empty($inventories))
                            <span type="" class="nav-link-text ms-1">
                                Inventory
                            </span>
                        @else
                            <span class="nav-link-text ms-1">Inventory<span
                                    class="badge text-bg-danger ms-2">1</span>
                            </span>
                        @endif
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account Setting</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('profilePage') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link alert" data-bs-toggle="modal" data-bs-target="#alertModal">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-regular fa-bell text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Alert </span>
                </a>
                </li>
                <li class="nav-item ms-1">
                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <a href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();"  class="nav-link">

                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-right-from-bracket text-danger text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Logout </span>
                            </a>
                        </form>
                </li>
            </ul>
        </div>
    </aside>

    <main class="main-content position-relative border-radius-lg ">

        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm text-white active font-weight-bolder text-white mb-0">
                            <h6 class="font-weight-bolder text-white mb-0">Point of Sale / Admin Panel</h6>
                        </li>
                    </ol>
                    {{-- <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6> --}}
                </nav>
                <div class="collapse navbar-collapse justify-content-between d-block" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0"></div>
                    <div class="navbar-nav ml-auto pb-1">
                        <div class="dropdown d-inline">
                            <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" style=" color: white; border: 1px solid #FF8C6B;">
                                @if (Auth::user()->image == null)
                                    <img src="{{ asset('images/adminProfile.png') }}"
                                        style="width: 30px; height: 30px; border-radius: 80%;" class="me-2">
                                @else
                                    <img src="data:image/jpeg;base64,{{ Auth::user()->image }}"
                                        style="width: 30px; height: 30px; border-radius: 80%;" class="me-2">
                                @endif
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu mt-3">
                                <li><a class="dropdown-item" href="{{ route('profilePage') }}"><i
                                            class="fa-solid fa-key my-2 me-2"></i>Change Password</a></li>
                                {{-- <li><a class="dropdown-item" href=""><i class="fa-solid fa-key my-2 me-2"></i>Change Password</a></li> --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();"
                                            class="dropdown-item"> <i class="fa-solid fa-right-from-bracket me-1"></i>
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
        {{-- dashboard --}}
        {{-- <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Money</p>
                                        <h5 class="font-weight-bolder">
                                            $53,000
                                        </h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">+55%</span>
                                            since yesterday
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Users</p>
                                        <h5 class="font-weight-bolder">
                                            2,300
                                        </h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">+3%</span>
                                            since last week
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                        <h5 class="font-weight-bolder">
                                            +3,462
                                        </h5>
                                        <p class="mb-0">
                                            <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                            since last quarter
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                                        <h5 class="font-weight-bolder">
                                            $103,430
                                        </h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">+5%</span> than last
                                            month
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-7 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">Sales overview</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more</span> in 2021
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com/" class="font-weight-bold"
                                    target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div> --}}

        @yield('contents')
    </main>

    {{-- Alert --}}
    <div class="modal fade" id="alertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
            <div class ="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">Setting Alert for Out Of Stock
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('alertStock') }}" method="post">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div>
                                <div class="container w-200 h-100  d-flex justify-content-center">
                                    <div class="m-3">

                                        <div class="col-md-10 mb-3" style="width: 350px;">
                                            <label for="" class="mb-2"><b>Set Alert</b></label>
                                            <input type="number" id="alert" name="alert"
                                                value="{{ old('qty') }}"
                                                class="form-control w-100 mb-2 @error('alert') is-invalid @enderror">
                                            @error('alert')
                                                <div class="is-invalid mb-1"><span
                                                        class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End of alert --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="{{ asset('plugins/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('plugins/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('plugins/js/plugins/chartjs.min.js') }}"></script>

    @yield('scriptText')

    {{-- <script async defer src="../../../buttons.github.io/buttons.js"></script> --}}

    <script src="{{ asset('plugins/js/argon-dashboard.minf27d.js?v=2.0.4') }}"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"8b9b7ead5a854816","version":"2024.8.0","serverTiming":{"name":{"cfL4":true}},"token":"1b7cbb72744b40c580f8633c6b62637e","b":1}'
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

</body>

<!-- Mirrored from demos.creative-tim.com/argon-dashboard/pages/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Aug 2024 10:49:53 GMT -->

</html>
