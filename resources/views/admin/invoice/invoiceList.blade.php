@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
<div class="container">
    <form action="#" method="get" enctype="multipart/form-data">
        @csrf
        <h4 class="mt-3 mb-1 ms-3" style="color: white;">Invoice Lists</h4>

        <div class="card mt-4 col-12">
            <div class="card-body">
                <div style="overflow: auto;">
                <table class="table table-striped table-bordered" id="invoiceTable">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Total Amount</th>
                            <th>Discount</th>
                            <th>Sub_total</th>
                            <th>Payment_status</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </div>
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
            var table = $('#invoiceTable').DataTable({
                processing: true,
                serverSide: true,
                scrollY: true,

                // bPaginate: false,
                // bFilter: false,
                // bInfo: false,
                // showNEntries: false,
                ajax: {
                    url: "{{ route('invoicePage') }}",
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
                ],
                layout: {
                    topStart: {
                        buttons: [{
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

            $('#create_record').click(function() {
                $('.modal-title').text('Add New Record');
                $('#action_button').val('Add');
                $('#action').val('Add');
                $('#form_result').html('');

                $('#formModal').modal('show');
            });
        });
        $(document).ready(function() {
            $('label[for="dt-length-0"]').hide();
        });
    </script>
@endsection
