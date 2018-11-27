// $(function () {

//     var links = $('.sidebar-links > a');

//     links.on('click', function () {

//         links.removeClass('selected');
//         $(this).addClass('selected');

//     })
// });

$(function(){
    $("a").each(function(){
        if ($(this).attr("href") == window.location.pathname){
            $(this).addClass("selected");
        }
    });
});