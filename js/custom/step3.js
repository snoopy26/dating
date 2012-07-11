$(function(){
	$(window).load(function(){
		$('#modal_progress').modal({
			keyboard : false,
			backdrop : 'static',
			show : false
		});
		//$('#modal_progress').modal('show');
		
		$('.formed').delegate('input[name="photoimg"]', 'change', function(){
			var el = $(this);
			var form = el.closest('form');
			var controls = el.closest('.controls');
			
			var alert = controls.next().next();
			alert.hide();
			
			form.ajaxSubmit({
				url : form.attr('action'),
				dataType : 'json',
				beforeSend : function(){
					$('#modal_progress').modal('show');
				},
				success : function(response){
					$('#modal_progress').modal('hide');
					el.val('');
					console.log(response);
					if (response.image_edit){
						controls.next().find('.ctrl-image').css({
							'background-image' : 'url('+response.image_edit+')'
						});
					}
					
					alert.find('span').text(response.text);
					if (response.status == 0){
						alert.removeClass('alert-info');
					}else{
						alert.addClass('alert-info');
					}
					
					alert.fadeIn();
					
				}
			});
		});
		
	});
});