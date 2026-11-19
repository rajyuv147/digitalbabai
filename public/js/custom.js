var i = 0;
var i2 = 0;
var i3 = 0;

// text limit
var TextLimit = 60;

//section all data
var allsec1 = $('#testsection1').text();
var conarray = JSON.parse(allsec1);

var allsec2 = $('#testsection2').text();
var conarray2 = JSON.parse(allsec2);

var allsec3 = $('#testsection3').text();
var conarray3 = JSON.parse(allsec3);

const cloneSec1File = $("#sec1File").clone();
const cloneSec1Url = $("#sec1Url").clone();
const cloneSec1Content = $("#sec1Content").clone();
const cloneSec1ImageFile = $("#sec1ImageFile").html();

const cloneSec2File = $("#sec2File").clone();
const cloneSec2Url = $("#sec2Url").clone();
const cloneSec2Content = $("#sec2Content").clone();
const cloneSec2ImageFile = $("#sec2ImageFile").html();

const cloneSec3File = $("#sec3File").clone();
const cloneSec3Url = $("#sec3Url").clone();
const cloneSec3Content = $("#sec3Content").clone();
const cloneSec3ImageFile = $("#sec3ImageFile").html();

const clonepdfpath = $('#FileSec1').attr('src');

var tag = document.createElement('script');
tag.id = 'iframe-demo';
tag.src = 'https://www.youtube.com/iframe_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player, player2, player3;

function readyYoutube() {
    if ((typeof YT !== "undefined") && YT && YT.Player) {
        player = new YT.Player('vdo1', {
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    } else {
        setTimeout(readyYoutube, 100);
    }
}

var onPlayerStateChange = function (event) {
    if (event.data == 0) {
        mychangefuction();
    }
};

function readyYoutube2() {
    if ((typeof YT !== "undefined") && YT && YT.Player) {
        player2 = new YT.Player('vdo2', {
            events: {
                'onStateChange': onPlayerStateChange2
            }
        });
    } else {
        setTimeout(readyYoutube2, 100);
    }
}

var onPlayerStateChange2 = function (event) {
    if (event.data == 0) {
        mychangefuction2();
    }
};

function readyYoutube3() {
    if ((typeof YT !== "undefined") && YT && YT.Player) {
        player3 = new YT.Player('vdo3', {
            events: {
                'onStateChange': onPlayerStateChange3
            }
        });
    } else {
        setTimeout(readyYoutube3, 100);
    }
}

var onPlayerStateChange3 = function (event) {
    if (event.data == 0) {
        mychangefuction3();
    }
};

//Scrolling Text Content
function scrolling() {
    $('#textContent').marquee({
        duration: 15000,
        gap: 25,
        delayBeforeStart: 0,
        direction: 'up',
        duplicated: false,
    }).bind('finished', function () {
        mychangefuction();
    });
}

function scrolling2() {
    $('#textContent2').marquee({
        duration: 15000,
        gap: 25,
        delayBeforeStart: 0,
        direction: 'up',
        duplicated: false,
    }).bind('finished', function () {
        mychangefuction2();
    });
}

function scrolling3() {
    $('#textContent3').marquee({
        duration: 15000,
        gap: 25,
        delayBeforeStart: 0,
        direction: 'up',
        duplicated: false,
    }).bind('finished', function () {
        mychangefuction3();
    });
}

// {{-- To Remove Sec 1 --}}
//     console.log($('#resizable').width());
if ($('#resizable').width() < 100) {
    $('#vdo1').remove();
    $('#resizable').remove();
}

//For Sec 1 full screen
if ($('#resizable').width() > 1000) {
    $('#sec2').remove();
    $('#vdo2').remove();
    $('#vdo3').remove();
    $('#sec3').remove();
}


//Remove Sec 3
if ($('#sec3').height() == 0) {
    $('#vdo3').remove();
}

// --textContent and myslide height management--
$(function () {
    var parentheight = $('#resizable').height();
    var childheight = $('.headerTextContent').height();
    var setHeight = parentheight - childheight;
    $('#textContent').height(setHeight);
    $('#fileContent').height(setHeight);
    $('.mySlides1').height(setHeight);

    var parentheight2 = $('#sec2').height();
    var childheight2 = $('.headerTextContent').height();
    var setHeight2 = parentheight2 - childheight2;
    $('#textContent2').height(setHeight2);
    $('#fileContent2').height(setHeight2);
    $('.mySlides2').height(setHeight2);


    var parentheight3 = $('#sec3').height();
    var childheight3 = $('.headerTextContent').height();
    var setHeight3 = parentheight3 - childheight3;
    $('#textContent3').height(setHeight3);
    $('#fileContent3').height(setHeight3);
    $('.mySlides3').height(setHeight3);

});

//For News Marquee
$(document).ready(function () {

    $('#marquee').marquee({
        duration: 15000,
        gap: 25,
        delayBeforeStart: 0,
        direction: 'left',
        duplicated: true,
        controls: false,
    });
});

//To run all section function
$(function () {
    if(conarray.length !== 0){
        if ($('#resizable').height() == 0) {
            $('#resizable').children().remove();
        }else{
            mychangefuction();
        }
    }else{
        $('#resizable').children().remove();
    }
    if(conarray2.length !== 0){

        if ($('#sec2').height() == 0) {
            $('#sec2').children().remove();
        }else{
            mychangefuction2();
        }
    }else{
        $('#sec2').children().remove();
    }
    if(conarray3.length !== 0){
        if ($('#sec3').height() == 0) {
            $('#sec3').children().remove();
        }else{
            mychangefuction3();
        }
    }else{
        $('#sec3').children().remove();
    }
    // addEventListener support for IE8
    function bindEvent(element, eventName, eventHandler) {
        if (element.addEventListener) {
            element.addEventListener(eventName, eventHandler, false);
        } else if (element.attachEvent) {
            element.attachEvent('on' + eventName, eventHandler);
        }
    }

    bindEvent(window, 'message', function (e) {
        if (e.data == "first-iframe" && (conarray.length !== 0) ) {
            mychangefuction();
        } else if (e.data == "second-iframe" && (conarray2.length !== 0)) {
            mychangefuction2();
        } else if (e.data == "third-iframe" && (conarray3.length !== 0)) {
            mychangefuction3();
        }
        // results.innerHTML = e.data;
    });
});

function mychangefuction() {
    if (conarray[i]['type'] == 'File') {
        $('#resizable').children().remove();
        $('#resizable').html(cloneSec1File);
        var truncateTitle = jQuery.trim(conarray[i]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec1File').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#FileSec1').attr('src', clonepdfpath + conarray[i]['content']);
        var parentheight = $('#resizable').height();
        var childheight = $('.headerTextContent').height();
        var setHeight = parentheight - childheight;
        $('#fileContent').height(setHeight);
    } else if (conarray[i]['type'] == 'Url') {
        $('#resizable').children().remove();
        $('#resizable').html(cloneSec1Url);
        var truncateTitle = jQuery.trim(conarray[i]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec1Url').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#vdo1').attr('src', conarray[i]['content'] + '?autoplay=1&enablejsapi=1');
        var parentheight = $('#resizable').height();
        var childheight = $('.headerTextContent').height();
        var setHeight = parentheight - childheight;
        $('#fileContent').height(setHeight);
        readyYoutube();
    } else if (conarray[i]['type'] == 'ImageFile') {
        $('#resizable').children().remove();
        $('#resizable').html(cloneSec1ImageFile);
        $('#resizable').append('<ul id="image-gallery" class="content-slider"></ul>');
        var truncateTitle = jQuery.trim(conarray[i]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#resizable').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        noOfImage = conarray[i]['imagedetails'];
        $('#image-gallery').children().remove();
        for (j = 0; j < noOfImage.length; j++) {
            $('#image-gallery').append('<li>' +
                '<img id="s' + j + '" class="mySlides1"/>' +
                '</li>');
            $('#s' + j).attr('src', noOfImage[j].file_details);
        }
        var parentheight = $('#resizable').height();
        var childheight = $('.headerTextContent').height();
        var setHeight = parentheight - childheight;
        $('.mySlides1').height(setHeight);
        var countimg = 2;
        $('#image-gallery').lightSlider({
            adaptiveHeight: false,
            item: 1,
            auto: true,
            slideMargin: 0,
            loop: false,
            onAfterSlide: function () {
                if (noOfImage.length > countimg) {
                    countimg++;
                } else {
                    setTimeout(mychangefuction,3000);
                }
            }
        });
    } else if (conarray[i]['type'] == 'Content') {
        $('#resizable').children().remove();
        $('#resizable').html(cloneSec1Content);
        var truncateTitle = jQuery.trim(conarray[i]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec1Content').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#textContent').text(conarray[i]['content']);

        var parentheight = $('#resizable').height();
        var childheight = $('.headerTextContent').height();
        var setHeight = parentheight - childheight;
        $('#textContent').height(setHeight);
        scrolling();
    }
    if (conarray.length - 1 > i) {
        i++;
    } else {
        i = 0;
    }
}

function mychangefuction2() {
    if (conarray2[i2]['type'] == 'File') {
        $('#sec2').children().remove();
        $('#sec2').html(cloneSec2File);
        var truncateTitle = jQuery.trim(conarray2[i2]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec2File').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#FileSec2').attr('src', clonepdfpath + conarray2[i2]['content']);
        var parentheight2 = $('#sec2').height();
        var childheight2 = $('.headerTextContent').height();
        var setHeight2 = parentheight2 - childheight2;
        $('#fileContent2').height(setHeight2);
    } else if (conarray2[i2]['type'] == 'Url') {
        $('#sec2').children().remove();
        $('#sec2').html(cloneSec2Url);
        var truncateTitle = jQuery.trim(conarray2[i2]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec2Url').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#vdo2').attr('src', conarray2[i2]['content'] + '?autoplay=1&enablejsapi=1');
        var parentheight2 = $('#sec2').height();
        var childheight2 = $('.headerTextContent').height();
        var setHeight2 = parentheight2 - childheight2;
        $('#fileContent2').height(setHeight2);
        readyYoutube2();
    } else if (conarray2[i2]['type'] == 'ImageFile') {
        $('#sec2').children().remove();
        $('#sec2').html(cloneSec2ImageFile);
        $('#sec2').append('<ul id="image-gallery2" class="content-slider"></ul>');
        var truncateTitle = jQuery.trim(conarray2[i2]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec2').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        noOfImage = conarray2[i2]['imagedetails'];
        $('#image-gallery2').children().remove();
        for (j2 = 0; j2 < noOfImage.length; j2++) {
            $('#image-gallery2').append('<li>' +
                '<img id="s2' + j2 + '" class="mySlides2"/>' +
                '</li>');
            $('#s2' + j2).attr('src', noOfImage[j2].file_details);
        }
        var parentheight2 = $('#sec2').height();
        var childheight2 = $('.headerTextContent').height();
        var setHeight2 = parentheight2 - childheight2;
        $('.mySlides2').height(setHeight2);

        var countimg2 = 2;
        $('#image-gallery2').lightSlider({
            adaptiveHeight: false,
            item: 1,
            auto: true,
            slideMargin: 0,
            loop: false,
            onAfterSlide: function () {
                if (noOfImage.length > countimg2) {
                    countimg2++;
                } else {
                    setTimeout(mychangefuction2,3000);
                }
            }
        });
    } else if (conarray2[i2]['type'] == 'Content') {
        $('#sec2').children().remove();
        $('#sec2').html(cloneSec2Content);
        var truncateTitle = jQuery.trim(conarray2[i2]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec2Content').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#textContent2').text(conarray2[i2]['content']);

        var parentheight2 = $('#sec2').height();
        var childheight2 = $('.headerTextContent').height();
        var setHeight2 = parentheight2 - childheight2;
        $('#textContent2').height(setHeight2);
        scrolling2();
    }
    if (conarray2.length - 1 > i2) {
        i2++;
    } else {
        i2 = 0;
    }
}

function mychangefuction3() {
    if (conarray3[i3]['type'] == 'File') {
        $('#sec3').children().remove();
        $('#sec3').html(cloneSec3File);
        var truncateTitle = jQuery.trim(conarray3[i3]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec3File').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#FileSec3').attr('src', clonepdfpath + conarray3[i3]['content']);
        var parentheight3 = $('#sec3').height();
        var childheight3 = $('.headerTextContent').height();
        var setHeight3 = parentheight3 - childheight3;
        $('#fileContent3').height(setHeight3);
        console.log($('#FileSec3', window.parent.document).html());
    } else if (conarray3[i3]['type'] == 'Url') {
        $('#sec3').children().remove();
        $('#sec3').html(cloneSec3Url);
        var truncateTitle = jQuery.trim(conarray3[i3]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec3Url').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#vdo3').attr('src', conarray3[i3]['content'] + '?autoplay=1&enablejsapi=1');
        var parentheight3 = $('#sec3').height();
        var childheight3 = $('.headerTextContent').height();
        var setHeight3 = parentheight3 - childheight3;
        $('#fileContent3').height(setHeight3);
        readyYoutube3();
    } else if (conarray3[i3]['type'] == 'ImageFile') {
        $('#sec3').children().remove();
        $('#sec3').html(cloneSec3ImageFile);
        $('#sec3').append('<ul id="image-gallery3" class="content-slider"></ul>');
        var truncateTitle = jQuery.trim(conarray3[i3]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec3').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        noOfImage = conarray3[i3]['imagedetails'];
        $('#image-gallery3').children().remove();
        for (j2 = 0; j2 < noOfImage.length; j2++) {
            $('#image-gallery3').append('<li>' +
                '<img id="s3' + j2 + '" class="mySlides3"/>' +
                '</li>');
            $('#s3' + j2).attr('src', noOfImage[j2].file_details);
        }
        var parentheight3 = $('#sec3').height();
        var childheight3 = $('.headerTextContent').height();
        var setHeight3 = parentheight3 - childheight3;
        $('.mySlides3').height(setHeight3);

        var countimg3 = 2;
        $('#image-gallery3').lightSlider({
            adaptiveHeight: false,
            item: 1,
            auto: true,
            slideMargin: 0,
            loop: false,
            onAfterSlide: function () {
                if (noOfImage.length > countimg3) {
                    countimg3++;
                } else {
                    setTimeout(mychangefuction3,3000);
                }
            }
        });
    } else if (conarray3[i3]['type'] == 'Content') {
        $('#sec3').children().remove();
        $('#sec3').html(cloneSec3Content);
        var truncateTitle = jQuery.trim(conarray3[i3]['title']).substring(0, TextLimit).trim(this) + "...";
        $('#sec3Content').children('.headerTextContent').children('.titleHeader').text(truncateTitle);
        $('#textContent3').text(conarray3[i3]['content']);

        var parentheight3 = $('#sec3').height();
        var childheight3 = $('.headerTextContent').height();
        var setHeight3 = parentheight3 - childheight3;
        $('#textContent3').height(setHeight3);
        scrolling3();
    }
    if (conarray3.length - 1 > i3) {
        i3++;
    } else {
        i3 = 0;

    }
}
