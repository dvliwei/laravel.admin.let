var accent_class = $.cookie('boday_color');
var $body  = $('body');
$body.addClass(accent_class);


var main_header_value = $.cookie("main-header-value");
if(main_header_value){
    $('.main-header').addClass('border-bottom-0')
}else{
    $('.main-header').removeClass('border-bottom-0')
}

var sm_body_value = $.cookie("sm-body-value");
if(sm_body_value){
    $('body').addClass('text-sm')
}else{
    $('body').removeClass('text-sm')
}

var nav_sidebar_value= $.cookie("nav-sidebar-value");
if(nav_sidebar_value){
    $('.nav-sidebar').addClass('nav-legacy')
}else{
    $('.nav-sidebar').removeClass('nav-legacy')
}

var nav_sidebar_value=$.cookie("nav-sidebar-value");
if(nav_sidebar_value){
    $('.nav-sidebar').addClass('nav-child-indent')
}else{
    $('.nav-sidebar').removeClass('nav-child-indent')
}


var navbar_dark_skins = [
    'navbar-primary',
    'navbar-secondary',
    'navbar-info',
    'navbar-success',
    'navbar-danger',
    'navbar-indigo',
    'navbar-purple',
    'navbar-pink',
    'navbar-navy',
    'navbar-lightblue',
    'navbar-teal',
    'navbar-cyan',
    'navbar-dark',
    'navbar-gray-dark',
    'navbar-gray',
]

var navbar_light_skins = [
    'navbar-light',
    'navbar-warning',
    'navbar-white',
    'navbar-orange',
]
var navbar_all_colors  = navbar_dark_skins.concat(navbar_light_skins);

var main_header_value=$.cookie("main-header-value");
var $main_header = $('.main-header')
$main_header.remove("navbar-white");
$main_header.removeClass('navbar-dark').removeClass('navbar-light');
navbar_all_colors.map(function (color) {
    $main_header.removeClass(color)
})
console.log(main_header_value);
$main_header.addClass('navbar-light');
$main_header.addClass(main_header_value);



