export function ucwords($string) {
  return $string
    .replace(/[_\- ]+/g, " ")
    .toLowerCase()
    .replace(/\b[a-z]/g, function(letter) {
      return letter.toUpperCase();
    });
}

export function hideNewsArticle() {
  $(".news-article").scrollTop(0);
  $("body").removeClass("no-scroll");
  $(".news-article").transition("browse");
}

export function showNewsArticle() {
  $(".news-article").transition("browse");
  $("body").addClass("no-scroll");
}

export function initJQueryFns() {
  $("body").on("click", ".launch-left.icon.item", () => {
    $(".main-sidebar").toggleClass("visible");
    $(".pusher").addClass("dimmed");
  });

  $("body").on("click", ".search-toggle", function() {
    $(".search-topbar").toggleClass("visible");
    $(".pusher").toggleClass("dimmed");
  });

  let lastScrollTop = 0;
  $(window).scroll(function() {
    let st = $(this).scrollTop();
    if (st > lastScrollTop) {
      $(".bottom.sidebar").removeClass("visible");
    } else {
      $(".bottom.sidebar").addClass("visible");
    }
    lastScrollTop = st;
  });

  $(".ui.basic.modal").modal("show");
}
