$(function(){
	$(window).load(function(){
		$('#thumbnails').masonry({
			itemSelector : ".box"
		});
		$(window).bind('resize', function(){
			$('#thumbnails').masonry({
				itemSelector : ".box"
			});
		});
		$('#tabs-section').stickyMojo({footerID: '#footer', contentID: '#tab-content'});
		$('.btn-stat .btn').tooltip({
			placement : 'bottom'
		});

		$('#thumbnails').find('#reply_btn').on('click', function(){
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
					$('#thumbnails').masonry({
						itemSelector : ".box"
					});
					form.find('textarea').val('');
				}else{
					alert(data.error);
				}
				el.data('working', false);
			}, 'json');
			return false;
		});

		$('#thumbnails').find('#count_reply').on('click', function(){
			var el = $(this);
			var p = el.closest('ul');
			if (el.data('working')) return false;
			el.data('working', true);

			var kissmessageid = el.attr('data-kissmessageid');
			$.post('/ajax/getReplyKissMessage', {
				kissmessageid : kissmessageid
			}, function(data){
				//console.log(data.replyId);
				if (data.html){
					for(var $i=0; $i<data.replyId.length; $i++){
						var l = p.find('li#listReply_' + data.replyId[$i]);
						if (l) l.remove();
					}
					p.prepend(data.html);
					el.remove();
					$('#thumbnails').masonry({
						itemSelector : ".box"
					});
				}
				el.data('working', false);
			}, 'json');

			return false;
		});

	});
});