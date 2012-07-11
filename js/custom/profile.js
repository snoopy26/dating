$(function(){
	$(window).load(function(){
		$('#seemore-quote-btn').bind('click', function(){
			var el = $(this);
			$('#modal_quotes').modal();
			return false;
		});
		$('#seemore-about-btn').bind('click', function(){
			var el = $(this);
			$('#modal_summary').modal();
			return false;
		});
		$('#matcher').popover({
			placement : 'bottom',
			selector : true,
			content : $('#hidden-matcher-content').html()
		});
		$('#tabMenu a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
			return false;
		});
	});
});