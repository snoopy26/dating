$(function(){
	$(window).load(function(){
		
		// month change
		$('#month, #year').bind('change', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			$.post('/ajax/generate_day', {
				'month' : $('#month').val(),
				'year'  : $('#year').val()
			}, function(response){
				$('#day').html(response.days);
				el.data('working', false);
			}, 'json')
			return false;
		});

		// pilih province => ubah kabupaten
		$('#province').bind('change', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			$.post('/ajax/generate_kabupaten', {
				province : el.val()
			}, function(response){
				var opt = response.kabupaten;
				$('#kabupaten').html(opt);
				el.data('working', false);
			}, 'json')
			return false;
		});
		
		// pilih kabupaten => ubah kecamatan
		$('#kabupaten').bind('change', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			$.post('/ajax/generate_kecamatan', {
				kabupaten : el.val()
			}, function(response){
				var opt = response.kecamatan;
				$('#kecamatan').html(opt);
				el.data('working', false);
			}, 'json')
			return false;
		});
		
		// pilih kecamatan => ubah kelurahan
		$('#kecamatan').bind('change', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			$.post('/ajax/generate_kelurahan', {
				kecamatan : el.val()
			}, function(response){
				var opt = response.kelurahan;
				$('#kelurahan').html(opt);
				el.data('working', false);
			}, 'json')
			return false;
		});
		
	});
});