$(document).ready(function () {
  // For Convert Bootstrap Navbar in Side Navbar
  $('.navbar-toggler').click(function(){
    $('#sidebar-nav').toggleClass('menu-show');
    $(this).toggleClass('collapsed');
    $('body').toggleClass('menu-open');
  });

  // Navbar Toggler Animation
  $('#nav-icon2').click(function(){
    $(this).toggleClass('open');
  });

  // Navbar Toggler Animation
  $('.SideBarToggler').click(function(){
    $('body').toggleClass('SideBarClose');
  });

  $("#sidebar").hover(function(){
      $("body").toggleClass("SideBarOpen");  //Toggle the active class to the area is hovered
  });

});

$(window).resize( function() {
});
