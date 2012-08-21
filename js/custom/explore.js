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
		$('#btn-exp-dating button').tooltip({
			placement : 'bottom'
		});
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

		$('#rekomendasi').find('#dating-date').DatePicker({
			flat: true,
			date: $('#default_date').val(),
			current: $('#default_date').val(),
			calendars: 1,
			mode: "single",
			starts: 1,
			onRender: function(date) {
				var today = new Date();
				var tomorrow = new Date(today.getTime() - (24 * 60 * 60 * 1000));
				return {
					disabled: (date.valueOf() <= tomorrow.valueOf()),
					className: date.valueOf() <= tomorrow.valueOf() ? 'datepickerSpecial' : false
				}
			},
			onChange: function(formated, dates){
				var c = $(this).closest('form');
				c.find('#dating-date-hdn').val(formated);
			}
		});

		$('#rekomendasi').find('#dating-time').timepicker({
			'timeFormat': 'H:i'
		});

		$('#rekomendasi').find('#btn-dating-date').on('click', function(){
			var el = $(this);
			var c = el.closest('li');

			if (!el.hasClass('active')) {
				c.find('#dating-date-container').show();
			}else{
				c.find('#dating-date-container').hide();
			}
		});

	});
});