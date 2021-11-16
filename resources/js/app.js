$(function () {
    $('.js-toggle').on('click', function (e) {
        e.preventDefault();
        var $target = $($(this).data('target'));
        var $subjects = $target
            .find('.js-toggle-subject');
        $subjects.prop('checked', !$subjects.prop('checked'));
    });

    $(".navbar-burger").click(function() {
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");
    });


});
