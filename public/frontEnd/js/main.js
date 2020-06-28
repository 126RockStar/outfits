
$(window).scroll(function() {
    if ($(window).scrollTop() > 200) {
        $("#topbtn").removeClass('d-none');
    } else {
        $("#topbtn").addClass('d-none');
    }
});

$(function() {
    $('#main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

