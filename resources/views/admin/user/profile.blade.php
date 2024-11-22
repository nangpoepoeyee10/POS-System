@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
@include('sweetalert::alert')
    <div class="container-fluid" style="">
        <div class="card w-75 shadow-sm mt-4 parent" >
            <div class="card-title">
                <h4 class="text-center mt-3">Profile</h4>
            </div>
            <div class="card-body row d-flex justify-content-around ms-1 ps-4 mb-2 ps-md-5">
                <div class="col-1 col-md-3 ms-2">
                    @if (Auth::user()->image == null)
                        <img src="{{ asset('images/adminProfile.png') }}"
                            style="width: 100px; height: 100px; border-radius: 80%;">
                    @else
                        <img src="data:image/jpeg;base64,{{ Auth::user()->image }}"
                            style="width: 110px; height: 100px; border-radius: 80%;" class="">
                    @endif
                    <span class="fw-bold d-block my-3">{{ Auth::user()->name }}</span>

                </div>
                <div class="col-10 col-md-5 m-2 ps-md-1 ms-md-1">
                    @foreach (Auth::user()->getRoleNames() as $rolename)
                        <label class="">Role</label>
                        <input type="text" class="form-control" value="{{ $rolename }}">
                    @endforeach
                    <label for="">Email</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->email }}">
                </div>

            </div>
        </div>
        <div class="ms-1 mt-5">
            <ul class="nav nav-tabs">
                <li class="nav-item ps-sm-2 ps-md-5">
                    <button class="nav-link active password " style="color: blue;">Privacy</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link edit" href="" style="color: blue;">Change Profile</button>
                </li>
            </ul>

            {{-- @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show float-end" role="alert">

                    <strong class="me-2">{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>
            @endif
            @if (session('unmessage'))
                <div class="alert alert-danger alert-dismissible fade show float-end" role="alert">

                    <span class="me-2">{{ session('unmessage') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>
            @endif --}}
        </div>
        <div id="pwd">
            <div class="row m-1 mt-4 m-sm-5">
                <form action="{{ route('changePassword') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">

                    <div class="col-md-10">

                        <div class="form-group">
                            <label class="mb-2">Old Password</label>
                            <input type="password"
                                class="form-control w-100 w-md-75 mb-3 @error('oldPassword') is-invalid @enderror"
                                name="oldPassword">
                            @error('oldPassword')
                                <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-2">New Password</label>
                            <input type="password"
                                class="form-control w-100 w-md-75 mb-3 @error('newPassword') is-invalid @enderror"
                                name="newPassword">
                            @error('newPassword')
                                <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-2">Confirm Password</label>
                            <input type="password"
                                class="form-control w-100 w-md-75 mb-3 @error('confirmPassword') is-invalid @enderror"
                                name="confirmPassword">
                            @error('confirmPassword')
                                <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit" style="float: left;">Save</button>

                    </div>
                    {{-- <div class="col-md-8 col-lg-9 ms-5 ms-md-5">
                        <button type="submit" class="btn btn-primary mt-2 float-end">Save</button>
                    </div> --}}
                </form>
            </div>
        </div>

        {{-- Update Profile --}}
        <div id="update" style="display: none;">
            <div class="row m-1 my-3 m-sm-5">
                <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">

                    <div class="col-md-12">
                        <div class="row  gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="my-2 mt-2">Username</label>
                                <input class="mb-4 form-control @error('name') is-invalid @enderror"
                                    type="text" name="name" value="{{ Auth::user()->name }}">
                                @error('name')
                                    <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="my-2">Email Address</label>
                                <input class="mb-4 form-control @error('name') is-invalid @enderror"
                                    type="text" name="email" value="{{ Auth::user()->email }}">
                                @error('email')
                                    <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                                @enderror

                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="my-2 mt-2">Gender</label>
                                <select name="gender" id="" class="form-control mb-4">
                                    <option value="">Select Gender</option>
                                    <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                    <option value="female"@if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="my-2">Image</label>
                                <input class="mb-4 form-control @error('image') is-invalid @enderror"
                                    type="file" name="image">
                                @error('image')
                                    <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" style="float: left;">Update</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- End of update profile --}}
    </div>
@endsection

@section('scriptText')
    <script>
        $(document).ready(function() {

            $('.edit').click(function() {
                $('.nav-link.active').removeClass('active');
                $(this).addClass('active');
                $(this).parents('li').addClass('active');
                $('#pwd').hide();
                $('#update').show();

            });
            $('.password').click(function() {
                $('.nav-link.active').removeClass('active');
                $(this).addClass('active');
                $(this).parents('li').addClass('active');
                $('#pwd').show();
                $('#update').hide();

            });
        })
    </script>
@endsection
