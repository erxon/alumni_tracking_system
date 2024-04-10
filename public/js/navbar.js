$("#about-nav").on("click", () => {
  $("#about-nav").addClass("text-white");
  $("#home-nav").removeClass("text-white");
  $("#contact-nav").removeClass("text-white");
});

$("#contact-nav").on("click", () => {
  $("#contact-nav").addClass("text-white");
  $("#home-nav").removeClass("text-white");
  $("#about-nav").removeClass("text-white");
});

$(window).scroll(function (event) {
  var scroll = $(window).scrollTop();
  if (scroll <= 700 && scroll >= 600) {
    $("#about-nav").addClass("text-white");
    $("#home-nav").removeClass("text-white");
    $("#contact-nav").removeClass("text-white");
  } else if (scroll > 900) {
    $("#contact-nav").addClass("text-white");
    $("#home-nav").removeClass("text-white");
    $("#about-nav").removeClass("text-white");
  } else if (scroll >= 0 && scroll < 600) {
    $("#contact-nav").removeClass("text-white");
    $("#home-nav").addClass("text-white");
    $("#about-nav").removeClass("text-white");
  }
});
