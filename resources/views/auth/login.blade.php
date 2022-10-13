@extends('layouts.app')

@section('content')
<!-- Style Css -->
<link rel="stylesheet" href="{{ asset('public/assets/css/pages-css/autn.css') }}" />
<link rel="stylesheet" href="{{ 'resources/css/app.css'}}" />

<!-- Style Css -->


<section class="autn-form sec-ptb">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12">
          <div class="site-logo">
          <a class="navbar-brand" href="{{url('/')}}">
                <h1>Laravel Base</h1>
            </a>
          </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-xl-6">
        <div class="user-form-card">
                  <h2 class="text-center">Log In To Continue</h2><br>
             <form method="POST" action="{{url('/sign-in')}}">
            @csrf
            @if(session('message'))
              <h6 class="alert alert-success">
                {{ session('message') }}
              </h6>
            @endif
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="custom-password-field">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
               <div class="eye-icons"><i class="fas fa-eye-slash" id="show_password" onclick="showPassword('password')"></i><i class="fas fa-eye" id="hide_password" onclick="hidePassword('password')" style="display:none"></i></div>
              </div>
              @error('password')
             
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            @if($errors->any())
                  <div class="invalid-feedback">{{ $errors->first() }}</div>
                @endif
            <div class="row form-group">
             
              <div class="col-sm-6 text-sm-right mt-sm-0 mt-10">
                @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
                @endif
              </div>
            </div>
            <div class="form-button">
              <button type="submit" class="secondary-btn btn btn-bg  btn-lg w-100 mt-3">
                {{ __('Login') }}
              </button>
            </div>
              <div class="form-scoial-hd">
               <h2>
                  Or Login With
               </h2>
              </div>
            <div class="form-social-media">
              <ul class="social-link">
                    <li><a href="javascript:void(0);" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="javascript:void(0);" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="javascript:void(0);" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="javascript:void(0);" target="_blank"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
          </form>
          <div class="user-form-remind text-center">
            <p class="mb-0">Don't have any account? <a href="{{url('/register')}}">SignUp </a> here</p>
          </div>
          <div class="login-copyright-menu text-center">
            <ul>
              <li><a class="text-dark" href="http://localhost/project/whizzer-yii2-1836/terms">Terms &amp; Conditions</a></li>
              <li>|</li>
              <li><a class="text-dark" href="http://localhost/project/whizzer-yii2-1836/privacy">Privacy &amp; Policy</a></li>
             
              <li>
                  <p>© 2016-2022  <a href="/remak-yii2-1644/"></a> All Rights
                  Reserved. Powered By <a target="_blank" class="resrved-btn"  href="https://www.toxsl.com">ToXSL Technologies</a>
                </p>
            
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
   function showPassword(id){
     $("#"+id).attr('type', 'text'); 
     $("#hide_"+id).show();
     $("#show_"+id).hide();
  }
  
  function hidePassword(id){
     $("#"+id).attr('type', 'password'); 
     $("#hide_"+id).hide();
     $("#show_"+id).show();
  }
  </script>
@endsection
