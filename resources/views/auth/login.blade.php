<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Point of Sale</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>

<body>
    @include('sweetalert::alert')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-1 shadow box-area" style="background: #FFA775">

            <!--Left Box -->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #FFA775">
                <div class="featured-image mb-3">
                    <img src="{{ asset('images/bgimg.png') }}" class="img-fluid" style="width: 100%;">
                </div>
            </div>

            <!-- Right Box -->

            <div class="col-md-6 right-box"
                style="background: white; border-top-right-radius: 6%;  border-bottom-right-radius: 6%;">
                <div class="row align-items-center mt-5">
                    <div class="header-text my-4 text-center">

                        <h5>Welcome from <span style="color: #FF6A16">POS</span> System</h5>
                    </div>
                    <form action="{{route('loginUser')}}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"  placeholder="Email address">
                            @error('email')
                                <div class="is-invalid my-1"><span class="text-danger fs-6">User's Email and Password does not match.</span></div>
                            @enderror
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror" name="password" placeholder="Password">
                            @error('password')
                                <div class="is-invalid mb-1"><span class="text-danger">User's Email and Password does not match.</span></div>
                            @enderror
                        </div>
                        <div class="input-group mb-4 d-flex justify-content-between">
                            <div></div>
                            <div class="forgot">
                                <small><a href="{{ route('password.request') }}">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-rounded w-100 fs-6" type="submit"
                                style="background: #FF6A16; border-radius: 18px;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>
