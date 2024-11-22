@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
    <form action="{{ route('createUser') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card mt-4" style="width: 80%; height: 80%; margin-left:10%; margin-right: 10%;">
            <div class="container p-3" style="margin-top: 10px;">
                <h4 class="mb-3 text-center">Create User</h4>
                <div class="row justify-content-center" style="">
                    <div class="col-10 " style="">
                        <div class="d-block">
                            <label class="mb-2 mt-md-2">Name <span class="text-danger">*</span>
                            </label>
                            <input class="mb-3 form-control @error('name') is-invalid @enderror" type="text"
                                name="name">
                            @error('name')
                                <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <label class="mb-2">Email <span class="text-danger">*</span>
                            </label>
                            <input class="mb-3 form-control @error('email') is-invalid @enderror" type="email"
                                name="email">
                            @error('email')
                                <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>

                        <div class="d-block">
                            <label class="mb-2">Password <span class="text-danger">*</span>
                            </label>
                            <input class="mb-3 form-control @error('password') is-invalid @enderror" type="password"
                                name="password">
                            @error('password')
                                <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <label class="mb-2">Confirm Password <span class="text-danger">*</span>
                            </label>
                            <input class="mb-3 form-control @error('confirmPassword') is-invalid @enderror" type="password"
                                name="confirmPassword">
                            @error('confirmPassword')
                                <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <label class="mb-2">Role<span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror mb-3 " >
                                <option value="0" selected>Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach

                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-block">
                            <div id="staffId">
                                <label class="mb-2">Staff Id <span class="text-danger">*</span>
                                </label>
                                <input class="mb-3 form-control @error('staffId') is-invalid @enderror" type="text"
                                    id="staff" name="staffId" value="{{ $staff_id }}" readonly>
                                    @error('staffId')
                                    <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-block">
                            <label class="mb-2">Gender <span class="text-danger">*</span>
                            </label>
                            <select name="gender" id="" class="form-control mb-3 ">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="d-block">
                            <label class="mb-2">Image <span class="text-danger">*</span>
                            </label>
                            <input class="mb-3 form-control @error('image') is-invalid @enderror" type="file"
                                name="image">
                            @error('image')
                                <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end col-11 mt-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>

    </form>
@endsection
