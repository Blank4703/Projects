/*
const observer = new IntersectionObserver (entries => {
    entries.forEach(entry => {
        if(entry.isIntersecting){
            document.querySelector(".about-content")[0].classlist.add(".about-content-anim");
        }
    })
})

observer.observe(document.querySelector(".about"));
*/

$(document).ready(function () {
    $(window).scroll(function () {
      $(".fade").each(function (i) {
        var bottom_of_object = $(this).position().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
  
        if (bottom_of_window > bottom_of_object) {
          $(this).animate({ opacity: "1" }, 900);
        }
      });
    });
  });
  