<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Point of Sale</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    {{-- datepicker --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
</head>

<body>
    <div class="wrapper shadow-lg">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">POS System</a>
                </div>
            </div>
            <ul class="sidebar-nav">

                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="fa-solid fa-house" class="btn btn-outline-warning border border-white text-dark"></i>
                        <span class="btn btn-outline-warning border border-white text-dark">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('admin#userLists') }}" class="sidebar-link">
                        <i class="fa-solid fa-users" class="btn btn-outline-warning border border-white text-dark"></i>
                        <span class="btn btn-outline-warning border border-white text-dark">User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ url('roles') }}" class="sidebar-link">
                        <i class="fa-solid fa-bars-progress"
                            class="btn btn-outline-warning border border-white text-dark"></i>
                        <span class="btn btn-outline-warning border border-white text-dark">Role & Permission</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('productlistPage') }}" class="sidebar-link">
                        <i class="fa-brands fa-product-hunt"
                            class="btn btn-outline-warning border border-white text-dark"></i>
                        <span class="btn btn-outline-warning border border-white text-dark">Product</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('category.index') }}" class="sidebar-link">
                        <i class="fa-solid fa-list" class="btn btn-outline-warning border border-white text-dark"></i>
                        <span class="btn btn-outline-warning border border-white text-dark">Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('customerlistPage') }}" class="sidebar-link">
                        <i class="fa-solid fa-people-group me-2"
                            class="btn btn-outline-warning border border-white text-dark"></i>
                        <span class="btn btn-outline-warning border border-white text-dark">Customer</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('inventory') }}" class="sidebar-link">
                        <i class="fa-solid fa-store" class="btn btn-outline-warning border border-white text-dark"></i>

                        @php
                            $number = DB::table('alerts')->sum('qty');
                            $inventories = DB::table('inventories')
                                ->select('product_id', 'stock_balance')
                                ->where('stock_balance', '<', $number)
                                ->get()
                                ->toArray();
                        @endphp
                        @if (empty($inventories))
                            <span type="" class="btn btn-outline-warning border border-white text-dark">
                                Inventory
                            </span>
                        @else
                            <span class="btn btn-outline-warning border border-white text-dark">Inventory<span
                                    class="badge text-bg-danger ms-2">1</span>
                            </span>
                        @endif
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('invoicePage') }}" class="sidebar-link">
                        <i class="fa-solid fa-receipt me-3 ms-1"
                            class="btn btn-outline-warning border border-white text-dark"></i>
                        <span class="btn btn-outline-warning border border-white text-dark">Invoice</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item">
                    <a href="route('alert')" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#profile" aria-expanded="false" aria-controls="auth">
                        <i class="fa-solid fa-gear"></i>


                            <span class="btn btn-outline-warning border border-white text-dark">Setting
                            </span>


                    </a>
                    <ul id="profile" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li>
                            <div class="d-flex" style="margin-left: 35px;">
                                <a class="alert" data-bs-toggle="modal" data-bs-target="#alertModal"><i
                                        class="fa-regular fa-bell text-warning fs-5"></i></a>
                                <span class="mt-3 me-3">| </span>
                                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                                    @csrf
                                    <a href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="text-dark">
                                        Logout
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-regular fa-circle-question"></i>
                        <span>Help</span>
                    </a>
                </li>
            </div>
        </aside>
        {{-- nav-bar --}}
        <div class=" main p-3" style="background-color: #f3f1f1">
            <div class="container-fluid mb-30">
                <div class="row  shadow-sm">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-dark py-1 py-lg-0 px-0"
                            style="background-color: #f3f1f1">
                            <div class="collapse navbar-collapse justify-content-between d-block" id="navbarCollapse">
                                <div class="navbar-nav mr-auto py-0"></div>
                                <div class="navbar-nav ml-auto pb-1">

                                        <div class="dropdown" >
                                            <a class="btn dropdown-toggle " type="button" data-bs-toggle="dropdown"  aria-expanded="false">
                                                <span><i class="fa-regular fa-bell"></i></span>
                                            </a>
                                            <ul class="dropdown-menu mt-3" >
                                               <li>

                                                </li>
                                            </ul>
                                        </div>
                                    <div class="dropdown d-inline">
                                        <a class="btn dropdown-toggle " type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            @if (Auth::user()->image == null)
                                                <img src="{{ asset('images/adminProfile.png') }}"
                                                    style="width: 30px; height: 30px; border-radius: 80%;"
                                                    class="">
                                            @else
                                                <img src="data:image/jpeg;base64,{{ Auth::user()->image }}"
                                                    style="width: 30px; height: 30px; border-radius: 80%;"
                                                    class="">
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
                                                        class="dropdown-item"> <i
                                                            class="fa-solid fa-right-from-bracket me-1"></i>
                                                        Logout
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin/script.js') }}"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

    {{-- datepicker --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script> --}}

</body>

@yield('scriptText')

</html>
