
(function ($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {


    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
      localStorage.setItem("sidebar_collapse", "ON");
    } else {
      localStorage.setItem("sidebar_collapse", "OFF");
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).on('resize', function () {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function (e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });



  function sidebar_collapse() {
    var collapse = localStorage.getItem("sidebar_collapse");
    if (collapse === "ON") {
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
    } else if (collapse === "OFF") {
      //$("body").toggleClass("sidebar-toggled");
      //$(".sidebar").toggleClass("toggled");
    }
  }

  $(this).on('load', sidebar_collapse())


})(jQuery); // End of use strict

jQuery('.form-control').on('blur', function () {
  if ($(this).val() != "" && $(this).attr('type') !== "date") {
    $(this).siblings('label').addClass(' active_label');
  } else {
    $(this).siblings('label').removeClass('active_label');

  }

})

function inputval() {

  $('input').each(
    function () {
      if ($(this).val() != "" && $(this).attr('type') !== "date") {
        $(this).siblings('label').addClass(' active_label');
      }
    }
  )

};
inputval();



