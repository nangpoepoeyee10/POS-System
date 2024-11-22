@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
@include('sweetalert::alert')
    <div class="container">
        <form action="#" method="get" enctype="multipart/form-data">
            @csrf
            <button class="btn btn-warning my-2" type="submit" style="float:right; background-color: #ffffff;">
                <a href="{{ route('admin#createProductPage') }}" style="color: dark;">Add Product</a> </button>
            {{-- <a href="{{ route('recentlyDeletedProduct') }}">Recently Deleted</a> --}}

            <h4 class="mt-3 mb-1 ms-3" style="color: white;" >Product Lists</h4>
            <div class="card col-12">
                <div class="card-body">
                    <div style="overflow: auto;">
                        <table class="table table-striped table-bordered" id="productTable">
                            {{-- <table class="table table-hover"> --}}
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Sell Price</th>
                                    {{-- <th>MFD</th> --}}
                                    <th>EXP</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            {{-- <tbody> --}}
                            {{-- @foreach ($products as $product)
                            <tr>
                                <input type="hidden" id="productId" value="{{ $product->id }}">
                                <input type="hidden" id="product_name" value="{{ $product->product_name }}"> --}}
                            {{-- <td style="width: 250px;"><img src="{{ asset('storage/' . $product->image) }}"
                                        style="width:60%; height: 25%;  margin-left: 10px;">
                                {{-- </td> --}}
                            {{-- //already hide --}}
                            {{-- <td>{{ $product->barcode }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->qty }}</td>

                                <td>{{ $product->buy_price }}</td>
                                <td>{{ $product->sell_price }}</td>
                                <td>{{ $product->mfd ? Carbon\Carbon::parse($product->mfd)->format('Y-m-d') : '-' }}</td>
                                <td>{{ $product->exp ? Carbon\Carbon::parse($product->exp)->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <a href="{{ route('productDetail', ['productId' => $product->id]) }}"
                                        class=" detailForm btn btn-outline-primary"><i
                                            class="fa-solid fa-circle-info"></i></a>

                                    <a href="{{ route('productEdit', ['productId' => $product->id]) }}"
                                        class=" editForm btn btn-outline-primary"><i
                                            class="fa-solid fa-pen-to-square"></i></a>

                                    <a class="deleteForm btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i
                                            class="fa-solid fa-trash text-danger  mt-1"></i></a>

                                </td>
                            </tr>
                        @endforeach --}}

                            {{-- End of Delete Modal --}}
                            {{-- </tbody> --}}
                            {{-- <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('deleteProduct') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <div class="container w-100 h-100  d-flex justify-content-center">
                                                    <div class="m-3">
                                                        <input type="hidden" name="id" id="productDeleteId">
                                                        <div class="d-block deleteDiv"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary delete">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Delete Modal --}}
    @can('delete product')
        <div class="modal fade" id="deleteProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete
                            Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('deleteProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <div class="container w-100 h-100  d-flex justify-content-center">
                                        <div class="m-3">
                                            <input type="hidden" name="id" id="productId" value="">
                                            <div class="d-block deleteDiv"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    {{-- End of Delete Modal --}}
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
            var table = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                scrollY: true,

                ajax: {
                    url: "{{ route('productlistPage') }}",
                },
                columns: [{
                        data: 'barcode',
                    },
                    {
                        data: 'product_name',
                    },
                    {
                        data: 'category_name',
                    },
                    {
                        data: 'sell_price',
                    },
                    // {
                    //     data: 'mfd', },
                    {
                        data: 'exp',
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'action',
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
            $add = '';
            $(document).on('click', '.delete', function() {
                var id = $(this).attr('id');
                console.log(id);
                $('#productId').val(id);
                $('#deleteProductModal').modal('show');
                $add += ` <span class="mb-2">Do you want to delete?</span>`
                $('.deleteDiv').html($add);

            });

            $(document).on('click','.close-btn',function(){
                window.location.reload();
            });
        });

        // $(document).ready(function() {

        //     $('.editForm').click(function() {
        //         $parentNode = $(this).parents('tr');
        //         $categoryName = $parentNode.find('#categoryName').val();
        //         $categoryId = $parentNode.find('#categoryId').val();
        //         $('#name').val($categoryName);
        //         $('#id').val($categoryId);
        //     })
        //     $add = '';
        //     $('.deleteForm').click(function() {
        //         $parentNode = $(this).parents('tr');
        //         $product_name = $parentNode.find('#product_name').val();
        //         $add += ` <label class="mb-2">Do you want to delete ${$product_name}</label>`
        //         $('.deleteDiv').html($add);

        //         $productId = $parentNode.find('#productId').val();
        //         $('#productDeleteId').val($productId);
        //     })

        // })
        $(document).ready(function() {
            $('label[for="dt-length-0"]').hide();
        });
    </script>
@endsection
