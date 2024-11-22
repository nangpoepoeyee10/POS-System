@extends('admin.layout.app')
@section('contents')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-10 my-5 ms-md-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item ps-3">
                      <a class="nav-link active" aria-current="page" href="{{ url('roles') }}">Roles</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="{{ url('permissions') }}">Permissions</a>
                    </li>
                  </ul>
            </div>
            <div class="col-md-10 ms-md-5 ms-sm-2">
                {{-- @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-1">Create Roles
                            {{-- <a href="{{ url('roles') }}" class="btn btn-primary float-end me-2">Back</a> --}}
                        </h5>
                    </div>
                    <div class="card-body row">
                        <form action="{{ url('roles') }}" method="POST">
                            @csrf
                            <div class="col-md-7 mb-3">
                                <label for="" class="mb-2">Role Name</label>
                                <input type="text" name="role" id=""
                                    class="form-control w-100 mb-3 @error('role') is-invalid @enderror">
                                @error('role')
                                    <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                                <button type="submit" class="btn btn-primary float-end">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container mt-3" style="margin-left: 100px;">
        <div class="row">
            <div class="col-md-10">

                <div class="card-header h-25 shadow-sm">
                    <h4>Create Roles
                        <a href="{{ url('roles') }}" class="btn btn-primary float-end me-5">Back</a>
                    </h4>
                </div>

                <div class="card-body mt-4 w-75 border-0">
                    <form action="{{ url('roles') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="">Role Name</label>
                            <input type="text" name="role" id="" class="form-control ">

                        </div>
                        <div class="card-footer mt-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div> --}}
@endsection
