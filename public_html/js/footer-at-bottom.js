$(document).ready(function(){
    var headerHeight = $('#header').height() + 2;
    var contentHeight = $('#pageWrapper').height();
    var footerHeight = $('#footer').height();

    if (headerHeight + contentHeight < $(window).height() - footerHeight) {
        $('footer').addClass('footer-at-bottom');
    }
});

$(window).resize(function(){
    var headerHeight = $('#header').height() + 2;
    var contentHeight = $('#pageWrapper').height();
    var footerHeight = $('#footer').height();

    if (headerHeight + contentHeight < $(window).height() - footerHeight) {
        $('footer').addClass('footer-at-bottom');
    }
    else {
        $('footer').removeClass('footer-at-bottom');
    }
});