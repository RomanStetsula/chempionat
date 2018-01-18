//import jquery
// window.$ = window.jQuery = require('jquery');

// require ('popper');
// import Popper from 'popper';
// window.Popper = Popper;
//import bootstrapnpm install popper
require('./bootstrap');

//bootstrap-toggle
// global.bootstrapToggle = require('bootstrap-toggle');


$(document).ready(function() {
    $(".title:first").addClass('active');
    
//----------Show post image-----------
    var timer;
    $(".title").mouseenter(function() {
        var that = this;
        var clas = $(that).attr('class');
        if (clas !== 'title active'){
            timer = setTimeout(function(){
                $(".title").removeClass('active');
                var img = $(".main-post-img img");
                img.css({'opacity' : '0.4'});
                setTimeout( function(){
                    var data = that.dataset;
                    img.attr('src', data.img);
                    img.css({'opacity' : '1'});
                    $(".main-post-img a").attr('href', data.href);                    
                    $(".main-post-img .date").html(data.date);
                    $(that).addClass('active');
                }, 150);
            }, 600);
        } 
    }).mouseleave(function() {
        clearTimeout(timer);
    });
 
    if (window.location.hash && window.location.hash === '#_=_') { //clear hash after enter via fabebook 
        window.location.hash = '';
    }
// -----------bootstrap datapicker----------------
    $('#sandbox-container .input-group.date').datepicker({
        maxViewMode: 3,
        language: "uk",
        orientation: "bottom auto",
        forceParse: false,
        daysOfWeekHighlighted: "0",
        autoclose: true,
        todayHighlight: true
    });
//  -----END-------  bootstrap datapicker end --------
//  
//----------Show team logo and team foto-----
    $('#logo').change(function () {
        
        var inputObj = $(this);
        var input = inputObj[0];
        
        var imgPreview = $('#img-preview-logo');
        var src = imgPreview.attr('src');
        
        showUploadImg(imgPreview, input);
        
        $('#reset-img-preview-logo').click(function() {   // Reset image which upload
            resetUploadImg(imgPreview, inputObj, src);
        });
    });
    
    $('#foto').change(function () {
        var inputObj = $(this);
        var input = inputObj[0];
        
        var imgPreview = $('#img-preview-foto');
        
        showUploadImg(imgPreview, input);
        var src = imgPreview.attr('src');
        
        $('#reset-img-preview-foto').click(function() {
            resetUploadImg(imgPreview, inputObj, src);
        });
    });
    
    function showUploadImg(imgPreview, input) {
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    imgPreview.attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                console.log('ошибка, не изображение');
            }
        } else {
            console.log('хьюстон у нас проблема');
        }    
    };
    
    function resetUploadImg(imgPreview, inputObj, src) {
        inputObj.val('');
        imgPreview.attr('src', src);
    }
//----------END --------- Show team logo and team foto-----
    
    //------------modal window-----------------------------------
    
    $('.result').click( function(event){ // лoвим клик пo ссылки с class="result"
		event.preventDefault(); // выключaем стaндaртную рoль элементa
                var game_id = $(this).parent().siblings(".game-id").html();
                $('.modal-league-name h5').html($(".league-table .table-title h5").html());
                $('.modal-add-result .home-team').html($(this).parent().siblings(".home-team").html());
                $('.modal-add-result .away-team').html($(this).parent().siblings(".away-team").html());
                $('.modal-add-result .date').html($(this).parent().siblings(".match-date").html());
                $('.modal-add-result .g1').val($(this).children(".g1").html());
                $('.modal-add-result .g2').val($(this).children(".g2").html());
                $('.modal-add-result .game-id').val($(this).parent().siblings(".game-id").html());
		$('.overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
		 	function(){ // пoсле выпoлнения предъидущей aнимaции
				$('.modal-add-result') 
					.css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
					.animate({opacity: 1, top: '40%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
		});
	});
	/* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
	$('.modal-close, .overlay').click( function(){ // лoвим клик пo крестику или пoдлoжке
		$('.modal-add-result')
			.animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
				function(){ // пoсле aнимaции
					$(this).css('display', 'none'); // делaем ему display: none;
					$('.overlay').fadeOut(400); // скрывaем пoдлoжку
				}
			);
	});


    $('.fa-check-circle').click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "userConfirmResult",
            data: {
                game_id: $(this).parent().siblings(".game-id").html()
            },
            success: function (msg) {
                alert(msg);
            }
        });
        $(this).parent().html('ok!');
    });

/*------------------------ admin toggles --------------------------------------*/

    /* admin League Shoving toggle*/
    $('.league-toggle').change(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});
        $.ajax({
            method: "PUT",
            url: "league-show",
            data: {
                checked: $(this).prop('checked')?1:0,
                league_id: $(this).closest(".toggle-cell").siblings(".league-id").html()
            }
        })
     });
    /* admin User admin toggle*/
    $('.admin-toggle').change(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});
        $.ajax({
            method: "PUT",
            url: "user-admin",
            data: {
                checked: $(this).prop('checked')?1:0,
                user_id: $(this).closest(".toggle-cell").siblings(".user-id").html()
            }
        });
    });

    /* admin User ban toggle*/
    $('.ban-toggle').change(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});
        $.ajax({
            method: "PUT",
            url: "user-ban",
            data: {
                checked: $(this).prop('checked')?1:0,
                user_id: $(this).closest(".toggle-cell").siblings(".user-id").html()
            }
        });
    });
});




