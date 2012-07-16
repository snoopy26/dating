$('table').find('.btn-ajax').click(function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var type = el.attr('data-type');
	if (type == "confirmed") {
		el.data('working', false);
		return false;
	}
	var order_hash = el.attr('data-orderhash');
	var r = confirm("Yakin ?");
	if (r === true){
		$.post("/admincs/ajax/confirm_cs", {
			type : type,
			order_hash : order_hash
		}, function(response){
			if (response.status == 1){
				if (type == "paid"){
					el.removeClass('btn-ajax');
					el.addClass('btn-success');
					el.text('Confirmed');
					el.attr('data-type', 'confirmed');
					el.closest('tr').find('.payment_status').text('confirmed');
					alert("Success Confirmed!");
				}else if (type == "checkout"){
					alert("Success Resend!");
				}
			}
		}, "json");
	}
	el.data('working', false);
	return false;
});

$('#tabMenu a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
	return false;
});