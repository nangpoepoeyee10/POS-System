@extends('admin.dashboard')
@section('content')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row">
            <div class="mt-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item ps-3">
                        <a class="nav-link active" aria-current="page" href="{{ url('roles') }}">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('permissions') }}">Permissions HELLO</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                {{-- @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif --}}
                <div class="card">
                    <div class="card-header row">
                        <h5 class="mt-1">Roles
                            {{-- <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a> --}}
                            <a class="addRole btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#addModal" style="color: black;">Add Role</a>
                        </h5>
                    </div>
                    <div class="card-body row">
                        <div style="overflow-x: scroll; overflow-y: scroll;">
                            <table class="table table-striped table-condensed" style="position: sticky;">
                                <thead>
                                    <tr>
                                        <th>Role Name</th>
                                        <th class="ps-5 d-none d-md-block">Permissions</th>
                                        <th>
                                            <div class="float-end me-4">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <input type="hidden" class="roleName" value="{{ $role->name }}">
                                            <input type="hidden" class="roleId" value="{{ $role->id }}">

                                            <td class=" ps-3">{{ $role->name }}</td>
                                            <td class="d-none d-md-block">
                                                @if (!empty($role->getAllPermissions()))
                                                    <ul class="mt-2">
                                                        @foreach ($role->getAllPermissions()->pluck('name') as $permissionName)
                                                            <li class="mb-1"> - {{ $permissionName }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="float-end mt-4">
                                                    <a href="{{ url('roles/' . $role->id . '/addPermissionToRole') }}"
                                                        class="text-primary"><i
                                                            class="fa-solid fa-elevator fs-5 me-2"></i></a>
                                                    {{-- <a href="{{ url('roles/' . $role->id . '/edit') }}" class="text-primary"><i class="fa-regular fa-pen-to-square fs-5"></i></a> --}}
                                                    <a class="editPermission" data-bs-toggle="modal"
                                                        data-bs-target="#editModal"><i
                                                            class="fa-regular fa-pen-to-square fs-5"></i></a>
                                                    <a href="{{ url('roles/' . $role->id . '/delete') }}" class="ms-1 text-danger"><i class="fa-solid fa-trash fs-5 me-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                        {{-- Edit Role --}}
                                        <div class="modal fade" id="editModal" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                                <div class ="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Role
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('updateRole') }}" method="POST">
                                                        @csrf
                                                        {{-- @method('PUT') --}}
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-center">
                                                                <div>
                                                                    <div
                                                                        class="container w-100 h-100  d-flex justify-content-center">
                                                                        <div class="m-3">
                                                                            <input type="hidden" name="id"
                                                                                id="id" value="">
                                                                            <div class="col-md-7 mb-3">
                                                                                <label for="" class="mb-2">Role
                                                                                    Name</label>
                                                                                <input type="text" id="oldRole"
                                                                                    name="role"
                                                                                    value="{{ $role->name }}"
                                                                                    id=""
                                                                                    class="form-control w-100 mb-2 @error('role') is-invalid @enderror">
                                                                                @error('role')
                                                                                    <div class="is-invalid mb-1"><span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    </div>
                                                                                @enderror
                                                                                {{-- <button type="submit" class="btn btn-primary float-end mt-2">Update</button> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary delete">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Edit Role --}}

                                        {{-- Add Role --}}
                                            <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                                    <div class ="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Role</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ url('roles') }}" method="POST">
                                                            @csrf
                                                            {{-- @method('PUT') --}}
                                                            <div class="modal-body">
                                                                <div class="d-flex justify-content-center">
                                                                    <div>
                                                                        <div class="container w-100 h-100  d-flex justify-content-center">
                                                                            <div class="m-3">
                                                                                <label for="" class="mb-2">Role Name</label>
                                                                                <input type="text" name="role" id="" class="form-control w-100 mb-3 @error('role') is-invalid @enderror">
                                                                                @error('role')
                                                                                    <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                                                                                @enderror
                                                                                {{-- <button type="submit" class="btn btn-primary float-end mt-2">Update</button> --}}
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
                                        {{-- End add Role --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptText')
    <script>
        $(document).ready(function() {
            var table = $('.role_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('roles') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
            $('.editPermission').click(function() {
                $parentNode = $(this).parents('tr');
                $roleName = $parentNode.find('.roleName').val();
                $roleId = $parentNode.find('.roleId').val();
                $('#oldRole').val($roleName);
                $('#id').val($roleId);
                console.log($roleId, $roleName);
            })
        })
    </script>
@endsection
