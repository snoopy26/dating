$(function(){
	$(window).load(function(){
		$('.rounded-rating').tooltip({
			placement : 'right'
		});
		$('#tabMenu a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
			return false;
		});
	});
});