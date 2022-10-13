@extends('layouts.app')

@section('content')

<div id="about">

<section class="about-us banner-bg ">
        <div class="container h-100">
          <div class="row">
            <div class="col-lg-6 col-md-12 breadcrumb-inner banner">
              <div class="banner-inner">
                <h2 class="main-title">About</h2>
               
              </div>
            </div>
            <div class="col-lg-6 col-md-12 banner-wrap">
            
                  <div class="banner-con1">
                    <div class="banner-con2">
                      <div class="banner-con3"><img
                          src="{{asset('/public/assets/images/hero_banner.jpg')}}"
                          alt="cover">
                        <div class="banner-con4"></div>
                        <div class="banner-con5"></div>
                      </div>
                    </div>
                 
              
              </div>
            </div>
          </div>
        </div>
      </section>



    <section class="sec-ptb about-area">
        <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-lg-6 col-12 d-flex justify-content-center">
                            <div class="about-img">
                            <img src="{{asset('/public/assets/images/hero_banner.jpg')}}" alt="about">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-12">
                            <div class="about-text">
                                <h2>Hi, We Are <span>donal</span></h2>
                                <p class="desc">Lorem ipsum scelerisque molestie id molestie magna ante etiam sollicitudin dictum tempus consectetur conubia, urna eros nunc curabitur viverra rutrum tortor luctus.</p>
                                <div class="about-list">
                                    <ul>
                                        <li>We love products that work perfectly and look beautiful.</li>
                                        <li>We create base on a deeply analysis of your project.</li>
                                        <li>We are create design with really high quality standards.</li>
                                        <li>We love products that work perfectly and look beautiful.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </section>
</div>

@endsection