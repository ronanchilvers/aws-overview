$(function(){$(".js-toggle").on("click",function(e){e.preventDefault();var t=$($(this).data("target")).find(".js-toggle-subject");t.prop("checked",!t.prop("checked"))}),$(".navbar-burger").click(function(){$(".navbar-burger").toggleClass("is-active"),$(".navbar-menu").toggleClass("is-active")})});