@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('public/assets/css/pages-css/autn.css') }}" />
<link rel="stylesheet" href="{{ 'resources/css/app.css'}}" />
<!-- Style Css -->

<div>
<section class="autn-form sec-ptb registration-form">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 col-xl-6">
      <div class="user-form-card">
        <div class="user-form-title"> 
        </div>
            <h2 class="text-center">SignUp Here</h2><br>
    <form method="post" action="{{url('/register')}}" enctype="multipart/form-data">
        @csrf
      <div class="row">
      <div class="form-group col-lg-6 col-md-12">
            <label>Name:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}"> 
            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
        </div>

        <div class="form-group col-lg-6 col-md-12">
          <label >Role</label>
            <select name="role" class="form-control">
            <option>Choose your role</option>
            <option value="0">Admin</option>
            <option value="1">User</option>
          </select>
          {!!$errors->first("role", "<span class='text-danger'>:message</span>")!!}
        </div>

        <div class="form-group col-lg-6 col-md-12">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
        </div>

        <div class="form-group col-lg-6 col-md-12">
            <label>Password:</label>
            <input type="password" class="form-control" name="password">
            {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="form-group col-lg-12">
            <label>Profile Photo:</label>
            <input type="file" class="form-control" name="image">
        </div>

   
        <button type="submit" class="secondary-btn btn btn-bg  btn-lg w-100 mt-3">
                {{ __('Submit') }}
          </button>
          <div class="register-form-remind text-center">
            <p class="mb-0">Already have a account  <a class="nav-link btn haveacc-btn" href="{{url('/login')}}">Login </a> here.</p>
          </div>
          <div class="login-copyright-menu text-center">
            <ul>
              <li><a class="text-dark" href="http://localhost/project/whizzer-yii2-1836/terms">Terms &amp; Conditions</a></li>
              <li>|</li>
              <li><a class="text-dark" href="http://localhost/project/whizzer-yii2-1836/privacy">Privacy &amp; Policy</a></li>
              <li>|</li>
              <li>
                <p>© 2016-2022  <a href="/remak-yii2-1644/"></a> All Rights
                Reserved. Powered By <a target="_blank" class="resrved-btn"  href="https://www.toxsl.com">ToXSL Technologies</a>
              </p>
              </li>
            </ul>
          </div>
      </div>
    </form>
    @endsection   

