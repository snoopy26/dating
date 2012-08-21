$(function(){
	$(window).load(function(){
		$('#rekomendasi').find('#btn-flagged').on('click', function(){
			var el = $(this);
			var closest = el.closest('.btn-group');
			var memberid = closest.attr('data-memberid');
			var d = "Are you sure Unflagged ?";
			var isActive = 0;
			if (!el.hasClass('active')) {
				d = "Are you sure flagged ?";
				isActive = 1;
			}
			var c = confirm(d);
			if (c == true){
				$.post('/ajax/flagUser', {
					memberid : memberid,
					isActive : isActive
				}, function(response){
					
				}, 'json');
				return;
			}
			return false;
		});
	});
});