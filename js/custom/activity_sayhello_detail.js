$(function(){
	$(window).load(function(){
		$('#reply_btn').on('click', function(){
			var el = $(this);
			var form = el.closest('form');
			var li = el.closest('li');
			var message = form.find('textarea').val();
			var kissmessageid = form.find('#kissmessageid').val();

			if (message.length == 0) {
				alert('Reply is empty!');
				return false;
			}

			if (el.data('working')) return false;
			el.data('working', true);

			$.post('/ajax/replyKissMessage', {
				message : message,
				kissmessageid : kissmessageid
			}, function(data){
				if (data.status == 1){
					$(data.html).insertBefore(li);
					form.find('textarea').val('');
				}else{
					alert(data.error);
				}
				el.data('working', false);
			}, 'json');
			return false;
		});
	});
});