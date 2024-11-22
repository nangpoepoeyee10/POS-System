@extends('admin.layout.app')
@section('contents')
<div class="container">
    <form action="#" method="get" enctype="multipart/form-data">
        @csrf
        {{-- <button class="btn btn-warning mt-2 me-3" type="submit" style="float:right;background-color: #FF6D1A;">
            <a href="{{ route('customercreate') }}" style="color:white;">Add Customer</a> </button> --}}
            <h4 class="mt-3 mb-1 ms-3"  style="color: white;">Customer Lists</h4>

            <div class="card mt-4 col-12">
                <div class="card-body">
                    <div style="overflow: auto;">

                <table class="table table-striped table-bordered" id="customerTable">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Register Date</th>
                            {{-- <th>Stock Status</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($stocks as $stock)
                            <tr>
                                <input type="hidden" id="stockId" value="{{ $stock->id }}">
                                <td>{{ $stock->product_name }}</td>
                                <td>{{ $stock->qty }}</td>
                                <td>{{ $stock->purchase_price }}</td>
                                <td>{{ $stock->date ? Carbon\Carbon::parse($stock->date)->format('Y-m-d') : '-' }}</td>
                                <td>
                                    @if ($stock->qty > 0)
                                        <label for="">In stock</label>
                                    @else
                                        <label for="">Out of stock</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>

    </form>
@endsection

@section('scriptText')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let exportFormatter = {
                format: {
                    body: function(data, row, column, node) {
                        // Strip $ from salary column to make it numeric
                        return column === 5 ? data.replace(/[$,]/g, '') : data;
                    }
                }
            };
            var table = $('#customerTable').DataTable({
                processing: true,
                serverSide: true,
                scrollY: true,

                ajax: {
                    url: "{{ route('customerlistPage') }}",
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'

                    },
                    {
                        data: 'register_date',
                        name: 'register_date'

                    },
                    // {
                    //     data: 'stock_status',
                    //     name: 'stock_status'
                    // },

                ],
                layout: {
                    topStart: {
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                exportOptions: exportFormatter
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: exportFormatter
                            }
                        ]
                    }
                }
            });
        });
        $(document).ready(function() {
            $('label[for="dt-length-0"]').hide();
        });
    </script>
@endsection
