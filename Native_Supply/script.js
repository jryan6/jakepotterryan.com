/*jslint browser: true*/
/*global $, jQuery, alert*/
/*
$(document).ready(function () {
    "use strict";
    $('#scroll-right').click(function () {
        event.preventDefault();
        $('#main-front').animate({
            marginLeft: "-=200px"
        }, "fast");
    });
    $('#scroll-left').click(function () {
        event.preventDefault();
        $('#main-front').animate({
            marginLeft: "+=200px"
        }, "fast");
    });
});*/
/*$(document).ready(function () {
    "use strict";
    document.addEventListener('DOMContentLoaded', function () {
        var button = document.getElementById('scroll-right');
        button.onclick = function () {
            document.getElementById('main-front').scrollLeft += 20;
        };
    }, false);
});*?*/

$(document).ready(function () {
    "use strict";
    $('#scroll-right').click(function () {
        document.getElementById('main-front').scrollLeft += 40;
    });
});
$(document).ready(function () {
    "use strict";
    $('#scroll-left').click(function () {
        document.getElementById('main-front').scrollLeft += 40;
    });
});