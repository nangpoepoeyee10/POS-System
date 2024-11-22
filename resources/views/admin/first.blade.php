@extends('admin.layout.app')

{{-- @section('alert')
        @if ($inventories == null)
                <button type="" class="btn btn-outline-warning text-dark">
                    Setting
                </button>

        @else
            <button type="" class="btn btn-outline-warning text-dark">
                Setting <span class="badge text-bg-danger">1</span>
            </button>
            @section('stockOutInventories')
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-store" class="btn btn-outline-warning border border-white text-dark"></i>
                        <span class="btn btn-outline-warning border border-white text-dark">Nearly Out of Stock</span>
                    </a>
                </li>
            @endsection
        @endif

    @endsection --}}
@include('admin.alert')
@section('contents')
    <div class="container mt-3">
        <div class="row ">
            <div class="col-md-12 mb-4">
                <div class="d-block float-end">
                    <select class="form-select me-4" id="year" aria-label="Default select example">
                        @foreach ($db_year as $dyear)
                            <option value="{{ $dyear->years }}"  @if ($year == $dyear->years) selected @endif >
                                {{ $dyear->years }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
        <div class="row">
            {{-- Daily Sales --}}
            <div class="col-md-4">
                <div class="card mb-2 shadow-lg">
                    <div class="card-header p-3 pt-2" style="background-color: white;">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-store fs-4" style="color: white;"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Daily Sales</p>
                            <div class="">
                                <span class="mb-0 text-sm" id="number">{{ $carbon_products_daily }}&nbsp; MMK</span>
                            </div>

                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer" id="parent" style="background-color: white;">
                        <div class="mt-1">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder px-1" id="txt">

                                    @if ($compareIncome == 'not less')
                                        <i class="fa-regular fa-circle-up"></i>
                                    @else
                                        <i class="fa-regular fa-circle-down"></i>
                                    @endif

                                    than yesterday
                                </span>
                                <input type="date" name="date" id="date"
                                    class="form-control d-inline-block pt-0 float-end" style="width: 140px"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        {{-- <i class="fa-solid fa-magnifying-glass btn btn-sm" id="search"></i> --}}
                        </p>
                    </div>
                    </a>
                </div>
            </div>
            {{-- End of Daily Sales --}}
            {{-- Stock Weely --}}
            <div class="col-md-4">
                <div class="card mb-2 shadow-lg">
                    <a href="{{ route('inventory') }}">
                        <div class="card-header p-3 pt-2" style="background-color: white;">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="fa-solid fa-bag-shopping fs-3 text-white"></i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Stock</p>
                                <span class="mb-0 " id="numberOfStocks">{{ $stockBalance }}</span>
                            </div>
                        </div>
                    </a>
                    <hr class="horizontal my-0 dark">
                    <div class="card-footer" id="parent" style="background-color: white;">
                        <div class="mt-1">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder px-1"
                                    id="txt">product available in the store</span>
                        </div>
                        {{-- <i class="fa-solid fa-magnifying-glass btn btn-sm" id="search"></i> --}}
                        </p>
                    </div>
                    </a>
                </div>
            </div>
            {{-- End of stock weekly --}}

            {{-- Monthly Sale --}}
            <div class="col-md-4">
                <div class="card mb-2 shadow-lg">
                    <div class="card-header p-3 pt-2 " style="background-color: white;">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-danger shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-store text-white fs-3"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize ">Monthly Sales</p>
                            <div class="">
                                <span class="mb-0 " id="monthlySale">{{ $monthly_sale }}&nbsp; MMK</span>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark ">
                    <div class="card-footer " id="monthParent" style="background-color: white;">
                        <div class="mt-1">
                            <p class="" style="padding-bottom: 1px;"><small
                                    class="text-success text-sm font-weight-bolder" id="txt">
                                    @if ($compareIncomeMonthly == 'not less')
                                        <i class="fa-regular fa-circle-up"></i>
                                    @else
                                        <i class="fa-regular fa-circle-down"></i>
                                    @endif
                                    than last month
                                </small>
                                <input type="month" name="month" id="month"
                                    class="form-control d-inline-block pt-0 float-end" style="width: 140px"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m') }}">
                                {{-- <i class="fa-solid fa-magnifying-glass btn btn-sm" id="monthlyBtnSearch"></i> --}}
                            </p>
                        </div>

                    </div>
                    </a>
                </div>

            </div>
            {{-- End of Monthly Sale --}}
            {{-- Invoice --}}
            <div class="row mt-4 pe-0">
                <div class="col-md-12 pe-0">
                    <div class="card mb-4 ">
                        <h4 class="mt-3 mb-2 ms-3 ">Daily Invoices</h4>
                        <div class="container">
                            {{-- <table class="table table-striped " id="productTable"> --}}
                            <table class="table table-hover" id="invoiceTable">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Total Amount</th>
                                        <th> Discount</th>
                                        <th>Sub Total</th>
                                        <th> Payment Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end of invoice --}}
        </div>
    </div>
    <div class="container mt-1">
        <div class="row">
            <div class="col-md-6">
                <div class="border border-dark border-opacity-25 border-1 rounded shadow-lg mb-3"
                    style="width: 580px; height:350px; background-color:white; ">
                    <p class="mt-2 ms-2 fw-bold">Best Product Lists</p>
                    <div class="ms-2" style="height:450px; width:550px; margin-auto;">
                        <canvas id="barchartdesc"></canvas>
                    </div>
                    <script>
                        var products1 = {!! $products1 !!}
                        const product_name_desc = [];
                        const stock_desc = [];
                        $.each(products1, function(key, val) {
                            product_name_desc.push(val.product_name);
                            stock_desc.push(val.stock_balance);
                        });
                        console.log(product_name_desc);
                        console.log(stock_desc);
                        new Chart(document.getElementById('barchartdesc'), {
                            "type": 'bar',
                            "data": {
                                "labels": product_name_desc,
                                "datasets": [{
                                    "label": "Product Lists",
                                    "data": stock_desc,
                                    "barPercentage": 0.4,
                                    "fill": false,
                                    "backgroundColor": ['#DBA9E8', '#A1A0E8', '#5ADCE6', '#9061E8', '#C639E6', '#E54FBC',
                                        '#E86A56',
                                        '#E69BD2', '#E6395C', '#E6604E'
                                    ],
                                }],
                            },

                        });
                    </script>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border border-dark border-opacity-25 border-1 rounded shadow-lg mb-3"
                    style="width: 580px; height:350px; background-color:white; ">
                    <p class="mt-2 ms-2 fw-bold">Bad Product Lists</p>
                    <div class="ms-2" style="height:450px; width:550px; margin-auto;">
                        <canvas id="barchart"></canvas>
                    </div>
                    <script>
                        var products2 = {!! $products2 !!}
                        const product_name = [];
                        const stock_balance = [];
                        $.each(products2, function(key, val) {
                            product_name.push(val.product_name);
                            stock_balance.push(val.stock_balance);
                        });
                        console.log(product_name);
                        console.log(stock_balance);
                        new Chart(document.getElementById('barchart'), {
                            "type": 'bar',
                            "data": {
                                "labels": product_name,
                                "datasets": [{
                                    "label": "Product Lists",
                                    "data": stock_balance,
                                    "barPercentage": 0.4,
                                    "fill": false,

                                    "backgroundColor": ['#E3DD5F', '#9EE57C', '#C0E35F', '#D4E3AB', '#5FE3E3', '#A5BCE5',
                                        '#ABD1E3',
                                        '#637AE6', '#E86BCC', '#DBA9E8'
                                    ],
                                }],
                            },

                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptText')
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#invoiceTable').DataTable({
                processing: true,
                serverSide: true,
                bFilter: false,
                bInfo: false,
                paging: false,
                // scrollX: true,

                scrollY: '200px',
                order: [
                    [0, 'desc']
                ],

                ajax: {
                    url: "{{ route('invoice') }}",
                },
                columns: [

                    {
                        data: 'invoice_id',
                        name: 'invoice_id'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'

                    },
                    {
                        data: 'discount',
                        name: 'discount'

                    },
                    {
                        data: 'sub_total',
                        name: 'sub_total',

                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',

                    },
                ]
            });

            $('#create_record').click(function() {
                $('.modal-title').text('Add New Record');
                $('#action_button').val('Add');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#formModal').modal('show');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // $('#month').val('243');
            $('#year').change(function() {
                $year = $(this).val();
                var hostname = window.location.hostname;
                var baseUrl = '';
                if (hostname === 'localhost' || hostname === '127.0.0.1') {
                    baseUrl = 'http://127.0.0.1:8000';
                } else {
                    baseUrl = 'http://192.168.100.11/pos-backend/public';
                }
                var url = baseUrl + '/ajax/yearlySale';

                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        'year': $year
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#date').val(response.date);
                            $.fn.dateFunction();
                            $('#month').val(response.month);
                            $.fn.monthFunction();
                        }
                    }
                });
            })
            $('#date').change(function() {
                $.fn.dateFunction();
            });

            $('#month').change(function() {
                $.fn.monthFunction();
            });
            $.fn.dateFunction = function() {
                $datePicker = $('#date').val();
                var hostname = window.location.hostname;
                var baseUrl = '';
                if (hostname === 'localhost' || hostname === '127.0.0.1') {
                    baseUrl = 'http://127.0.0.1:8000';
                } else {
                    baseUrl = 'http://192.168.100.11/pos-backend/public';
                }
                var url = baseUrl + '/ajax/dailySale';
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        'data': $datePicker
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            if (response.sums[0].sums == null) {
                                $('#number').html(` <span class="mb-0">0</span>&nbsp;MMK`);
                            } else {
                                // console.log(response.sums[0].sums);
                                $('#number').html(
                                    ` <span class="mb-0">${response.sums[0].sums}</span>&nbsp;MMK`
                                );
                            }
                        }
                    }
                });
            }
            $.fn.monthFunction = function() {
                $month = $('#month').val();
                console.log($month);
                var hostname = window.location.hostname;
                var baseUrl = '';
                if (hostname === 'localhost' || hostname === '127.0.0.1') {
                    baseUrl = 'http://127.0.0.1:8000';
                } else {
                    baseUrl = 'http://192.168.100.11/pos-backend/public';
                }
                var url = baseUrl + '/ajax/monthlySale';
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        'months': $month
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            if (response.result[0].sums == null) {
                                $('#monthlySale').html(` <span class="mb-0">0</span>&nbsp;MMK`);
                            } else {
                                $('#monthlySale').html(
                                    ` <span class="mb-0">${response.result[0].sums}</span>&nbsp;MMK`
                                );

                            }
                        }
                    }
                });
            }

        })
    </script>
@endsection
