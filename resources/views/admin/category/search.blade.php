@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
    <div class="container">
        <button class="btn btn-warning text-white my-2" type="submit" type="button" name="create_record" id="create_record"
            style="float:right; background-color: #ffffff;">
            <span style="color: black;">Add Category</span> </button>
            <h4 class="mt-3 mb-1 ms-3" style="color: white;">Category Lists</h4>

        {{-- <button id="btnExcel" class="btn btn-primary">Excel</button> --}}

        {{-- <a href="" class="btn btn-warning text-white" type="submit" style="background-color: #FF6D1A;">
                    <i class="bi bi-plus-square"></i> Report</a>
                <br>
                <br> --}}
        {{-- <div class="container"> --}}
            <div class="card col-12">
                <div class="card-body">
                    <div style="overflow: auto;">
                        <table class="table table-striped table-bordered" id="userTable">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th width="180px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                @can('create category')
                    <div class="modal  fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <form action="{{ route('admin#createCategory') }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Add New Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span id="form_result"></span>
                                        <div class="form-group">
                                            <span>Name : </span>
                                            <input type="text" name="name" id="name" class="form-control" />
                                        </div>

                                        <input type="hidden" name="action" id="action" value="Add" />
                                        <input type="hidden" name="hidden_id" id="hidden_id" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan


                {{-- Edit Modal --}}
                @can('edit category')
                    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                            <div class ="modal-content">

                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('updateCategory') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="">
                                            <div>
                                                <div class="container">
                                                    <div class="m-3">

                                                        <input type="hidden" name="id" id="editId">
                                                        <div class="d-block">
                                                            <span class="mb-2">Category Name</span>
                                                            <input class="name mb-4 form-control" type="text" name="name"
                                                                id="cname">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary update">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan

                {{-- End of Edit Modal --}}

                {{-- Delete Modal --}}
                @can('delete category')
                    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete
                                        Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('deleteCategory') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <div class="container w-100 h-100  d-flex justify-content-center">
                                                    <div class="m-3">
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <div class="d-block deleteDiv"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary close-btn"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan

                {{-- End of Delete Modal --}}

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

                    // let exportFormatter = {
                    //     format: {
                    //         body: function(data, row, column, node) {
                    //             // Strip $ from salary column to make it numeric
                    //             return column === 5 ? data.replace(/[$,]/g, '') : data;
                    //         }
                    //     }
                    // };
                    var table = $('#userTable').DataTable({

                        processing: true,
                        serverSide: true,
                        scrollY: true,

                        // bLengthChange: false,
                        ajax: {
                            url: "{{ route('category.index') }}",
                        },
                        // "dom": 'lBfrtip',
                        // buttons: ['copy', 'excel', 'pdf'],

                        columns: [
                            // {
                            //     data: 'id',
                            //     name: 'id'
                            // },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'created_at',
                                name: 'created_at'

                            },
                            {
                                data: 'updated_at',
                                name: 'updated_at'

                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ]
                        // layout: {
                        //     topStart: {
                        //         buttons: [{
                        //                 extend: 'copyHtml5',
                        //                 exportOptions: exportFormatter
                        //             },
                        //             {
                        //                 extend: 'excelHtml5',
                        //                 exportOptions: exportFormatter
                        //             },
                        //             {
                        //                 extend: 'pdfHtml5',
                        //                 exportOptions: exportFormatter
                        //             }
                        //         ]
                        //     }
                        // }
                    });

                    $('#create_record').click(function() {
                        $('.modal-title').text('Add New Category');
                        $('#action_button').val('Add');
                        $('#action').val('Add');
                        $('#form_result').html('');

                        $('#formModal').modal('show');
                    });
                });


                $(document).on('click', '.edit', function(event) {

                    event.preventDefault();
                    var id = $(this).attr('id');
                    var name = $(this).attr('categoryName');
                    $('#editId').val(id);
                    $('#cname').val(name);
                    $('#editModal').modal('show');
                    $('#form_result').html('');

                });
                $add = '';
                $(document).on('click', '.delete', function() {
                    var id = $(this).attr('id');
                    console.log(id);
                    $('#id').val(id);
                    $('#deleteModal').modal('show');
                    $add += ` <span class="mb-2">Do you want to delete?</span>`
                    $('.deleteDiv').html($add);

                });

                $(document).on('click','.close-btn',function(){
                window.location.reload();
            });
                $(document).ready(function() {
                    $('label[for="dt-length-0"]').hide();
                });
            </script>
        @endsection
