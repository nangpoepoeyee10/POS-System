@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
<div class="container">
    <form action="{{ route('admin#createCategory') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card mt-4" style="width: 50%; height: 50%; margin-left:20%; margin-right: 10%;">
            <div class="container p-3" style="margin-top: 10px;">
                <h4 class="mb-3 text-center">Create Category</h4>
                <div class="row justify-content-center" style="">
                    <div class="col-10 " style="">
                    <div class="d-block">
                        <label class="mb-2">Name</label>
                        <input class="mb-4 form-control @error('name') is-invalid
                        @enderror"
                            type="text" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button class="btn btn-primary m-2 opacity-75" type="submit" style="float:right;">Save</button>

                </div>
            </div>
        </div>
    </form>
@endsection
