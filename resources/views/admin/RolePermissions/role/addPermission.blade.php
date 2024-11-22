@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mt-3 mb-4 ms-md-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item ps-3">
                        <a class="nav-link active" aria-current="page" href="{{ url('roles') }}">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('permissions') }}">Permissions</a>
                    </li>
                </ul>
            </div>
            {{-- @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" style="margin-left: 5%; width: 81%;">
                <span>{{session('status')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}
            <div class="col-md-10 ms-md-5 ms-sm-2">
                <div class="card">
                    <div class="card-header h-25 shadow-sm">
                        <h5> Role : {{ $role->name }}
                            {{-- <a href="{{ url('roles') }}" class="btn btn-primary float-end me-5">Back</a> --}}
                        </h5>
                    </div>

                    <div class="card-body w-100 border-0">

                        <form action="{{ route('role#givePermissionsToRole', ['roleId' => $role->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="">
                                <h6 class="mb-3">Permissions</h6>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-3">
                                            <span class="me-5 mb-3" style=""><input type="checkbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermission) ? 'checked' : '' }}>
                                                {{ $permission->name }}</span>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="card-footer mt-3 float-end me-5">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
