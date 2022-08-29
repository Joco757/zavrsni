$(window).on("load", function () {
  $('.loader-wrapper').show().delay(700);
  $(".loader-wrapper").fadeOut("slow");
});

document.addEventListener('DOMContentLoaded', () => {

  const themeStylesheet = document.getElementById('theme');
  const storedTheme = localStorage.getItem('theme');
  if (storedTheme) {
    themeStylesheet.href = storedTheme;
  }
  const themeToggle = document.getElementById('theme-toggle');
  themeToggle.addEventListener('click', () => {
    // if it's light -> go dark
    if (themeStylesheet.href.includes('light')) {
      themeStylesheet.href = 'css/darkmode.css';
      themeToggle.innerText = 'Switch to light mode';



    } else {
      // if it's dark -> go light
      themeStylesheet.href = 'css/lightmode.css';
      themeToggle.innerText = 'Switch to dark mode';


    }
    // save the preference to localStorage
    localStorage.setItem('theme', themeStylesheet.href)
  })

  /* let el = document.getElementsByClassName("collapse");
  let check = document.getElementById("check");

  check.addEventListener("click", function() {
    if(document.getElementById("check").checked){
      for (var i = 0; i < el.length;  i++) {
        el[i].removeAttribute("data-parent");
      }
    } else if(document.getElementById("check").checked == false){
      for (var i = 0; i < el.length;  i++) {
        el[i].setAttribute("data-parent", "#accordionExample275");
      }
    }
  })*/
})


$(document).ready(function () {
  $('#display').css('display', 'none');
  $("#kljRijec").keyup(function () {
    var query = $(this).val();
    if (query != "") {
      $.ajax({
        url: 'search/backend-search.php',
        method: 'POST',
        data: { query: query },
        success: function (data) {

          $('#display').html(data);
          $('#display').css('display', 'block');

        }
      });
    } else {
      $('#display').css('display', 'none');
    }
  });

  $("#kljRijec").click(function () {
    setTimeout(clear, 1);
  });
});

function clear () {
  if ($("#kljRijec").val() == "") {
    $('#display').css('display', 'none');
  }
}

//hover effect over categories

$(document).ready(function () {
  $('.navbar-dark .dmenu').hover(function () {
    $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
  }, function () {
    $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
  });
});

/*Scroll to top when arrow up clicked BEGIN*/
$(window).scroll(function () {
  let height = $(window).scrollTop();
  if (height > 100) {
    $('#back2Top').fadeIn();
  } else {
    $('#back2Top').fadeOut();
  }
});

$(document).ready(function () {
  $("#back2Top").click(function (event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });

});