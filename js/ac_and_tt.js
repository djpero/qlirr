/*! jQuery Accordian && ToolTip Plugins - v 0.1 - 10-06-2013
* d.m.micic@gmail.com
* Copyright (c) 2013 Dragan Micic; Licensed MIT */

(function($){
	$.fn.BuboTooltip = function(){		
		var obj =$(this);
		$('[rel~=tooltip]',obj).each(function(index, element) {
			var ttElement = $(this);
            var tip = ttElement.attr('tooltip');
			ttElement.remove('title');
			var ttWrap ='<div class="buboTTWrap"></div>';
			var ttMark = '<div class="buboTTMark">?</div>';
			var ttTip ='<div class="buboTTTip">' + tip + '</div>';		
			ttElement.wrap(ttWrap).after(ttMark + ttTip);						
        });
		
		$(".buboTTMark").bind( 'mouseenter', function(){
			var par = $(this).parent('.buboTTWrap');
			var tt = $('.buboTTTip',par);
			var ttPos = tt.outerHeight();
			tt.css({'top':(-1*(ttPos+5))});
			$('.buboTTTip',par).show();
		});
		
		$(".buboTTMark").bind( 'mouseleave', function(){
			var par = $(this).parent('.buboTTWrap');
			$('.buboTTTip',par).hide();
		});
		
		$(".buboTTMark").bind( 'click', function(){
			var par = $(this).parent('.buboTTWrap');
			$('.buboTTTip',par).hide();
		});	
	};
	
	
	
	$.fn.BuboAccordian = function(){
		var obj = $(this);
		var selectedAC = $("input[type=hidden]",obj);
		setAC();
		jQuery.event.add(window,"load",setAC);
		
		var action;
		$(window).resize(function(){
		  clearTimeout(action);
		  action = setTimeout(setAC, 100);
		});
	

		$(".acBox>h1",obj).click(function(){
			var parentID = $(this).parent('div').attr("id");
			$(selectedAC).val(parentID);
			scrollToAnchor($(obj).attr('id'));
			setAC('normal');
		});
		
		function setAC(){		
			$('.acBox',obj).each(function(index, element) {
                var titleHeight = $("h1",this).height();
				var curHeight = $(this).height();
				if($(this).attr('id') == $(selectedAC).val()){					
					$(this).height('auto');
					var autoHeight = $(this).height();
					$(this).addClass("active").height(curHeight).animate({height:autoHeight},'2000');
				}
				else{
					$(this).removeClass("active").animate({height:titleHeight},'2000');
				}
            });
		}
		
		function scrollToAnchor(id){
			var anchorn = $("#"+ id);
			var fs=$('body').css('font-size')/2;
			$('html,body').animate({scrollTop: anchorn.offset().top+fs},'normal');
		}
			
	};
	
}(jQuery));