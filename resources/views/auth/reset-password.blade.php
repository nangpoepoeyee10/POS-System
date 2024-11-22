{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <main class="login-form">
        <div class="cotainer" style="margin-top: 100px;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h4 class="d-inline" style="text-align: center; ">Point of Sale System</h4>
                    <div class="card mt-4">
                        <div class="card-header">Reset Password</div>
                        <div class="card-body">
                            <form action="{{ route('resetPassword') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Email Address</label>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" id="email_address" class="form-control @error('email') is-invalid

                                        @enderror" name="email" required autofocus>
                                        @error('email')
                                        <div class="is-invalid mb-1"><span class="text-danger">{{$message}}</span></div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6 mb-2">
                                        <input type="password" id="password" class="form-control" name="password" required autofocus>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6 mb-2">
                                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
      </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Point of Sale</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
    </head>
    <body>

     <div class="container d-flex justify-content-center align-items-center min-vh-100" >
           <div class="row border rounded-5 p-1 shadow box-area"  style="background: #FFA775">

        <!--Left Box -->

           <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #FFA775">
               <div class="featured-image mb-3">
                <img src="{{asset('images/bgimg.png')}}" class="img-fluid" style="width: 100%;">
               </div>
            </div>

        <!-- Right Box -->

           <div class="col-md-6 right-box" style="background: white; border-top-right-radius: 6%;  border-bottom-right-radius: 6%;">
              <div class="row align-items-center mt-5">
                    <div class="header-text my-4 text-center">

                         <h5>Password Reset</h5>
                    </div>
                    <form action="{{ route('resetPassword') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="input-group mb-3">
                            <input type="text" id="email_address"  class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror required autofocus" name="email" placeholder="Email Address">
                            @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="password-confirm" id="password"  class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror required autofocus" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password-confirm"  class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror required autofocus" name="password_confirmation" placeholder="Confrimation Password">
                            @if ($errors->has('password-confirm'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-rounded w-100 fs-6" type="submit" style="background: #FF6A16; border-radius: 18px; color:white;">Reset</button>
                    </div>
                </form>
              </div>
           </div>

          </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
