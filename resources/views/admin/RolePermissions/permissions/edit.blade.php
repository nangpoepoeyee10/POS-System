@extends('admin.layout.app')
@section('contents')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 my-5 ms-md-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item ps-3">
                        <a class="nav-link " aria-current="page" href="{{ url('roles') }}">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('permissions') }}">Permissions</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 ms-md-5 ms-sm-2">
                {{-- @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-1">Edit Permissions
                    <a href="{{ url('permissions') }}" class=" text-primary float-end me-4 mb-2 d-block d-sm-none"><i
                            class="fa-solid fa-arrow-left"></i></a>
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ url('permissions/' . $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-7 mb-3">
                        <label for="" class="mb-2">Permission Name</label>
                        <input type="text" name="permission" value="{{ $permission->name }}" id=""
                            class="form-control w-100 mb-2 @error('permission') is-invalid @enderror">
                        @error('permission')
                            <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                        @enderror
                        <button type="submit" class="btn btn-primary float-end mt-2">Update</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
