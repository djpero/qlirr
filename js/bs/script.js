$(document).ready(function() {
	// Price updater for money
	$('#priceupdate2').val($('.empty2 .tooltip-inner').text());
	$('.empty2 .tooltip-inner').bind('DOMNodeInserted', function(event) {
    	$('#priceupdate2').val($('.empty2 .tooltip-inner').text());
    });

	// Price updater for months
    $('#priceupdate').val($('.price .tooltip-inner').text());
    $('#priceupdate').val($('.price .tooltip-inner').text());
	$('.price .tooltip-inner').bind('DOMNodeInserted', function(event) {
    	$('#priceupdate').val($('.price .tooltip-inner').text());
    });

    $('.switch').click(function(){
    	$('.switch').toggleClass('reswitch');
    	$('.sellermode').toggleClass('dn');
    	$('.buyermode').toggleClass('db');
    	$('#seller').toggleClass('green');
    	$('#buyer').toggleClass('green');
    });

    $('#buyer').click(function(){
        $('.switch').addClass('reswitch');
        $('.sellermode').addClass('dn');
        $('.buyermode').addClass('db');
        $('#seller').removeClass('green');
        $('#buyer').addClass('green');
    });

    $('#seller').click(function(){
        $('.switch').removeClass('reswitch');
        $('.sellermode').removeClass('dn');
        $('.buyermode').removeClass('db');
        $('#seller').addClass('green');
        $('#buyer').removeClass('green');
    });

    $('.switch2').click(function(){
        $('.switch2').toggleClass('reswitch2');
    	$('.titles .switcher .switcharea').toggleClass('greenbgc');
    	$('.buyermode .empty').toggleClass('dn');
    	$('.buyermode .empty2').toggleClass('db');
        $('.onoff').toggleClass('db');
        $('.offon').toggleClass('dn');
    });

});