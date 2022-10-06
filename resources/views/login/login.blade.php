<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/sign.css">
    <title>{{ $title }}</title>
</head>
<body>
    
    <div class="container" id="container-login">
        {{-- {{ url()->previous() }} --}}
        <a href="/">
            <i class="close-right fa-solid fa-xmark"></i>
        </a>
        <div class="forms-container">
            <div class="login">
                <form action="{{ route('login.authenticate') }}" method="POST" class="login-form">
                    @csrf
                    @if (session()->has('loginError'))
                        <h2>
                            {{ session('loginError') }}
                        </h2>
                    @endif
                    @if (session()->has('success'))
                        <h2>
                            {{ session('success') }}
                        </h2>
                    @endif

                    <h2 class="title">{{ $title }}</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" 
                        placeholder="Username" autofocus value="{{ old('username') }}">
                        @error('username')
                        <small><span> {{ $message }} </span></small>
                        @enderror
                    </div>
                    
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" 
                        id="password" placeholder="Password">
                        @error('password')
                        <small><span> {{ $message }} </span></small>
                        @enderror
                    </div>
                    <input type="submit" value="Login" class="btn solid">
                    
                    {{-- <p class="social-text">Or Login with Social Platform</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fa-brands fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div> --}}
                </form>

                <div class="panel left-panel">
                    <div class="content-login">
                        <h3>New Here? </h3>
                        <a href="/register"><button class="btn transparent" id="register-btn">Register</button></a>
                        
                    </div>
                    <img src="/img/gatot.svg" class="gatot" alt="">
                    
    
                </div>

            </div>
        </div>

        <div class="panels-containers">
            
        </div>
    </div>
</body>
</html>
    
<script src="https://kit.fontawesome.com/a076c9a6eb.js" crossorigin="anonymous"></script>