@extends('admin.layout.app')
@include('admin.alert')

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
                        <h5 class="mt-1">Create Permissions
                        {{-- <a href="{{ url('permissions') }}" class="btn btn-primary float-end me-2 mt-1 d-none d-md-block">Back </a> --}}
                        {{-- <a href="{{ url('permissions') }}" class="float-end me-3 mt-1  d-block d-md-none"><i class="fa-solid fa-arrow-left"></i> </a> --}}

                        </h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('permissions') }}" method="POST">
                            @csrf
                            <div class="col-md-7 mb-3">
                                <label for="" class="mb-2">Permission Name</label>
                                <input type="text" name="permission" id=""
                                    class="form-control w-100 mb-2 @error('permission') is-invalid @enderror">
                                @error('permission')
                                    <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                                <button type="submit" class="btn btn-primary float-end">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
