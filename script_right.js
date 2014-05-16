(function ($) {
	$(document).ready(function(){
		$("a[target!='_blank']").click(function () {
			var url = $(this).attr( 'href' );
			$('html').css({'-moz-transform':'scale(0.98)',
						'-webkit-transform':'scale(0.98)',
						'-webkit-transform-origin':'left top',
						'-moz-transform-origin':'left top',
						'position':'relative',
						'left':'1%',
						'top':'10px',
						'margin':'0',
						'box-shadow':'5px 7px 45px rgb(0, 0, 0)'
						});
			setTimeout(function(){
				$('html').animate({
						'left':'100%'
							},1000,function() {
	      					      location.href = url;
	      					  });
			},100);
			return false;
		});
	});
})(jQuery);