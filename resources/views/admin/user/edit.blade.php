@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
    <form action="{{ route('updateUser') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}

        <div class="card mt-4" style="width: 80%; height: 80%; margin-left:10%; margin-right: 10%;">
            <div class="container p-3" style="margin-top: 10px;">
                <h4 class="mb-3 text-center">Edit User</h4>
                <div class="row justify-content-center" style="">
                    <div class="col-10 " style="">
                    <div class="d-block ">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <label class="my-2 mt-2">Username</label>
                        <input class="mb-4 form-control @error('name') is-invalid @enderror" type="text" name="name"
                            value="{{ $user->name }}">
                        @error('message')
                            <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                        @enderror
                    </div>
                    <div class="d-block">
                        <label class="my-2">Email Address</label>
                        <input class="mb-4 form-control @error('email') is-invalid @enderror" type="email" name="email"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                        @enderror
                    </div>
                    <div class="d-block">
                        <label class="my-2">Role</label>
                        <select name="roles[]" id="" class="form-select mb-4">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" @if ($role == $userRoles) selected @endif>
                                    {{ $role }} </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="d-block">
                        <label class="mb-2">Gender</label>
                        <select name="gender" id="" class="form-control mb-3 " >
                            <option value="">Select Gender</option>
                            <option value="male" @if ($user->gender == 'male') selected @endif>Male</option>
                           <option value="female"  @if ($user->gender == 'female') selected @endif>Female</option>
                        </select>
                    </div>
                    <div class="d-block">
                        <label class="my-2">Image</label>
                        <input class="mb-4 form-control @error('image') is-invalid @enderror" type="file" name="image">
                        @error('image')
                            <div class="is-invalid mb-1"><span class="text-danger">{{ $message }}</span></div>
                        @enderror
                    </div>
                </div>
                <div class="text-end col-10 mt-2">
                    <button type="submit" class="btn btn-primary"> Update</button>
                </div>
            </div>
        </div>

    </div>
</div>

    </form>
@endsection
@section('scriptText')
{{-- <script>
    $(document).ready(function(){
        $('#staffId').hide();
        $('#role').change(function(){
            if($('#role').val() == 'staff'){
                console.log('staff');
                $('#staffId').show();
            }else{
                $('#staffId').hide();
                var staffId = '';
                $('#staff').val(' ');
                // console.log(staffId);

            }
        });
    })
</script> --}}
@endsection
