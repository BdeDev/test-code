

@extends('layouts.app')

@section('content')

<div id="contact">

    <section class="contact-us banner-bg ">
        <div class="container h-100">
          <div class="row">
            <div class="col-lg-6 col-md-12 breadcrumb-inner banner">
              <div class="banner-inner">
                <h2 class="main-title">Contact Us</h2>
               
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

    <section class="contact-from-area sec-ptb ">

                <div class="container">
                  
                    <div class="row justify-content-center">
                      
                        <div class="col-lg-8 col-12">
                             <div class="contact-right">
                                <div class="contact-form fix">
                                  
                                    <form id="contact-form" action="mail.php" method="post">
                                     <div class="row">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12">
                                            <label for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="form-group col-lg-12">
                                            <label for="subject">Subject</label>
                                                <input type="text" name="text" id="sub" class="form-control" placeholder="Subject">
                                            </div>
                                            <div class="form-group col-lg-12">
                                            <label for="message">Message</label>
                                                <textarea name="message" id="message" cols="30" rows="6" placeholder="Message" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <button type="submit" class="secondary-btn btn btn-bg submit-btn">SUBMIT</button>
                                            </div>
                                            
                                     </div>
                                    </form>
                                </div>                             
                            </div>                            
                        </div>
                    </div>
                 </div>                     
           
    </section>

</div>

@endsection
