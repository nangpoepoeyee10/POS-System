@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
@include('sweetalert::alert')
    <div class="container">
        <div class="row">
            <div class="mt-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item" style="padding-left: 8%;">
                        <a class="nav-link " aria-current="page" href="{{ url('roles') }}">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('permissions') }}">Permissions</a>
                    </li>

                </ul>
            </div>
            <div class="">
                {{-- @if (session('status'))
                    <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}
                <button name="create_role" id="create_permission" class="btn float-end my-2"
                    style="background-color:#ffffff ;color: black; float: right;"> <i class="bi bi-plus-square"></i>
                    Add Permission</button>
                <div class="card col-12">
                    <div class="card-body">
                        <div style="overflow: auto">
                            <table class="table table-striped table-bordered" id="userTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th width="180px">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Add Permission --}}
            <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">

                        <form action="{{ url('permissions') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Add New Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <div class="form-group">
                                    <span>Permission Name: </span>
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
            {{-- End of Add Permission --}}

            {{-- Edit Permission --}}
            <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                    <div class ="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Permission
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('updatePermission') }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            {{-- <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <div class="container w-200 h-100  d-flex justify-content-center">
                                        <div class="m-3">

                                            <div class="col-md-10 mb-3" style="width: 350px;">
                                                <input type="hidden" name="id" id="id" value="">

                                                <label for="" class="mb-2"><b>Permission Name</b></label>
                                                <input type="text" id="oldPermission" name="permission" value=""
                                                    class="form-control w-100 mb-2 @error('permission') is-invalid @enderror">
                                                @error('permission')
                                                    <div class="is-invalid mb-1"><span
                                                            class="text-danger">{{ $message }}</span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                            <div class="modal-body">
                                <span id="form_result"></span>
                                <div class="form-group">
                                    <span>Permission Name: </span>
                                    <input type="text" id="oldPermission" name="permission" value="" class="form-control w-100 mb-2 @error('permission') is-invalid @enderror">
                                    @error('permission')
                                        <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
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
            {{-- End of Edit Permission --}}
            {{-- Delete Modal --}}
            <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Confirmation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('destoryPermission') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <div class="container w-100 h-100  d-flex justify-content-center">
                                            <div class="m-3">

                                                <input type="hidden" name="id" id="permissionDeleteId">
                                                <div class="d-block deleteDiv "></div>
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

            {{-- End of Delete Modal --}}
        @endsection
        @section('scriptText')
            <script type="text/javascript">
                $(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var table = $('#userTable').DataTable({
                        processing: true,
                        serverSide: true,
                        bPaginate: true,
                        showNEntries: false,
                        info: false,
                        ajax: "{{ route('permissions.index') }}",
                        columns: [{
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ]
                    });

                    $('#create_permission').click(function() {
                        $('.modal-title').text('Add New Permission');
                        $('#action_button').val('Add');
                        $('#action').val('Add');
                        $('#form_result').html('');
                        $('#formModal').modal('show');
                    });


                    $(document).on('click', '.edit', function(event) {

                        event.preventDefault();
                        var id = $(this).attr('id');
                        var name = $(this).attr('permissionName');
                        $('#id').val(id);
                        $('#oldPermission').val(name);
                        $('#editModal').modal('show');
                        $('#form_result').html('');

                    });
                    $add = '';
                    $(document).on('click', '.delete', function(event) {
                        event.preventDefault();
                        var id = $(this).attr('id');
                        var name = $(this).attr('permissionName');
                        $('#deleteModal').modal('show');
                        console.log(id);
                        $('#permissionDeleteId').val(id);
                        $add += ` <span class="mb-2">Do you want to delete ${name}</span>`
                        $('.deleteDiv').html($add);
                    });

                    $(document).on('click','.close-btn',function(){
                window.location.reload();
            });

                });
                $(document).ready(function() {
                    $('label[for="dt-length-0"]').hide();
                });
            </script>
        @endsection
