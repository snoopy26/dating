$(function(){
	$(window).load(function(){
		$('#rekomendasi').find('#change_date_btn').on('click', function(){
			var el = $(this);
			var c = el.closest('.btn-lists');
			c.next().show();
			c.remove();
			return false;
		});
		$('#rekomendasi').find('#remove_dating_btn').on('click', function(){
			var el = $(this);
			var c = confirm("Are you sure to delete this dating?");
			if (c == true){

			}
			return false;
		});
	});
});