@extends('admin.layout.app')
{{-- @include('admin.alert') --}}

@section('contents')
<div class="container">
    <form action="#" method="get" enctype="multipart/form-data">
        @csrf
        <h4 class="mt-3 mb-1 ms-3" style="color: white;">Stock in details</h4>
        <div class="card mt-4 col-12">
            <div class="card-body">
                <div style="overflow: auto;">
                <table class="table table-striped table-bordered" id="stockdetailTable">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Purchase Price</th>
                        <th>Date</th>
                        {{-- <th>Stock Status</th>
                        <th>Remark</th> --}}

                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($stocks as $stock)
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Purchase Price</th>
                            <th>Date</th>
                            <th>Stock Status</th>
                        </tr>
                    </thead>
                    <br><br><br>
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
            let exportFormatter = {
                format: {
                    body: function(data, row, column, node) {
                        // Strip $ from salary column to make it numeric
                        return column === 5 ? data.replace(/[$,]/g, '') : data;
                    }
                }
            };
            var table = $('#stockdetailTable').DataTable({
                processing: true,
                serverSide: true,
                scrollY: true,

                ajax: {
                    url: "{{ route('stockindetail') }}",
                },
                columns: [{
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'purchase_price',
                        name: 'purchase_price'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },

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


