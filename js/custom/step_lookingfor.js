$(function(){
	$(window).load(function(){
		$('#age_start').bind('blur', function(){
			var el = $(this);
			var v = parseInt(el.val());
			var age_end = parseInt($('#age_end').val());
			var age_end_c = v + 1;
			if (v < 18) el.val(18);
			if (v >= age_end) $('#age_end').val(age_end_c);
			return false;
		});
		$('#age_end').bind('blur', function(){
			var el = $(this);
			var v = parseInt(el.val());
			var age_start = parseInt($('#age_start').val());
			var age_end = age_start + 1;
			if (v <= 18) el.val(age_end);
			if (v >= 60) el.val(60);
			if (v <= age_start) el.val(age_end);
			return false;
		});
	});
});