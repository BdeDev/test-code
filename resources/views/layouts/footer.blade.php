  <!--Footer Here-->
  <footer class="footer-area">
      <div class="container">
          <div class="row">
             <div class="col-lg-3">
             <div class=" footer-logo">
                  <a href="{{url('/')}}">
                      <h1>Laravel Base</h1>
                  </a>
                  <p class="desc mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
              </div>
             
             </div>
           <div class="col-lg-3">
            <h5 class="color_white my-3">Useful Links</h5>
           <ul class="support-link">
                  <li><a href="javascript:void(0);">Join the team </a></li>
                  <li><a href="{{url('/about')}}">About</a></li>
                
                  <li><a href="javascript:void(0);">Locations</a> </li>
                  <li><a href="javascript:void(0);">Gift Cards Press </a> </li>
              </ul>
           </div>
           <div class="col-lg-3">
           <h5 class="color_white my-3">Legal Links</h5>
           <ul class="support-link">
           <li><a href="{{url('/contact')}}">Contact</a> </li>
                  <li><a href="{{url('/privacy')}}">Privacy Policy </a></li>
                  <li><a href="{{url('/terms')}}">Terms & Conditions</a></li>
                  
              </ul>
           </div>
              <div class="col-lg-3">
            
              <ul class="social-link">
                  <li><a href="javascript:void(0);" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="javascript:void(0);" target="_blank"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="javascript:void(0);" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                  <li><a href="javascript:void(0);" target="_blank"><i class="fab fa-instagram"></i></a></li>
              </ul>
              <ul class="app-link">
                  <li>
                      <a href="javascript:void(0);">
                          <img src="{{ asset('public/assets/images/AppStore.png') }}" alt="">
                      </a>
                  </li>
                  <li>
                      <a href="javascript:void(0);">
                          <img src="{{ asset('public/assets/images/GooglePlay.webp') }}" alt="">
                      </a>
                  </li>
              </ul>
              </div>
          </div>
      </div>
  </footer>