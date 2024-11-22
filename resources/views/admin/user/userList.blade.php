@extends('admin.layout.app')
@include('admin.alert')

@section('contents')

    <div class="container">
        @include('sweetalert::alert')
        {{-- <div class=""> --}}
        {{-- @if (session('status')) --}}
            {{-- <div class="alert alert-success mt-2">{{ session('status') }}</div> --}}
            {{-- <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                <strong>{{ session('status') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}
        <a href="{{ route('admin#createUserPage') }}" name="create_role"  class="btn float-end my-2"
            style="background-color:#ffffff ;color: dark; float: right;"> <i class="bi bi-plus-square"></i> Add User</a>
        <h4 class="mt-3 mb-1 ms-3" style="color: white;">User Lists</h4>
        @if (count($users) != 0)
            <div class="card col-12">

                <div class="card-body">
                    <div style="overflow: auto">
                        <table class="table table-striped table-bordered" id="userTable">
                            <thead>
                                <tr>
                                    <th>Staff ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Gender</th>
                                    <th width="180px">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Change Role Modal --}}
            @can('change role of user')
                <div class="modal fade" id="changeRoleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                        <div class ="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5" id="staticBackdropLabel">Change Role</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('changeRole') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <div class="container h-100">
                                                <div class="m-1" style="width: 350px;">
                                                    <input type="hidden" name="userId" id="id" value="">
                                                    <div class="d-block">
                                                        <label class="mb-2"><b>Role</b></label>
                                                        <select name="roles[]" id="newRole" class="form-select">
                                                            <option value="">Select Role</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role }}"> {{ $role }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="d-block mt-2">
                                                        <div id="staffId">
                                                            <label class="mb-2">Staff Id</label>
                                                            <input
                                                                class="mb-3 form-control @error('staffId') is-invalid @enderror"
                                                                type="text" id="staff" name="staffId">
                                                            @error('staffId')
                                                                <div class="is-invalid mb-1"><span
                                                                        class="text-danger">{{ $message }}</span></div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary delete">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            {{-- End of Change Role Modal --}}

            {{-- Delete Modal --}}
            @can('delete user')
                <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin#deleteUser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <div class="container w-100 h-100  d-flex justify-content-center">
                                                <div class="m-3">

                                                    <input type="hidden" name="id" id="userDeleteId">
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
            @endcan
            {{-- End of Delete Modal --}}
        @else
            <span class="text-danger">There is no data.</span>
        @endif

    </div>


@endsection
@section('scriptText')
    <script type="text/javascript">
        $(function() {

            $add = '';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#userTable').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('admin#userListsTable') }}",
                columns: [{
                        data: 'staff_id'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data) {
                            if (data == ' ' || data == null) {
                                return (
                                    "<img src={{ asset('images/adminProfile.png') }}" +
                                    " loading='lazy' width='100px' class='img-thumbnail' />"
                                );
                            } else {
                                return (
                                    "<img src=data:image/jpeg;base64," +
                                    data +
                                    " loading='lazy' width='100px' class='img-thumbnail' />"
                                );
                            }
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                retrieve: true,
            });

            $('label[for="dt-length-0"]').hide();

            $(document).on('click', '.changeRoleTable', function(event) {
                event.preventDefault();
                $('#changeRoleModal').modal('show');
                var id = $(this).attr('id');
                var role = $(this).attr('roleName');
                var staffId = $(this).attr('staffId');

                $('#id').val(id);
                $('#staff').val(staffId);
                $('#newRole').val(role).change();

            });

            $(document).on('click', '.deleteUser', function(event) {
                // event.preventDefault();
                var id = $(this).attr('id');
                var name = $(this).attr('userName');
                $('#deleteModal').modal('show');
                $('#userDeleteId').val(id);
                $add += ` <span class="mb-2">Do you want to delete ${name}</span>`
                $('.deleteDiv').html($add);
            });

            $(document).on('click','.close-btn',function(){
                window.location.reload();
            });
        });
    </script>
@endsection
