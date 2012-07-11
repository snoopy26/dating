$(function(){
	$(window).load(function(){
/*
$('#slider-carousel').tiket_carousel({
	autoplay : false,
	navNext : $('#navNext'),
	navPrev : $('#navPrev'),
	diff_left : 650,
	carousel : false,
	sliderEasing : 'jswing'
});
*/

		$('#btn-opt button').tooltip({
			placement : 'bottom'
		});
		
		$('.checkbox span').popover({
			placement : 'bottom',
			selector : true
		});
		
		var total_questions = 30;
		$('#navNext').live('click', function(){
			var el = $(this);
			var closest = el.closest('#slider-carousel');
			var question = closest.find('#question');
			
			var count_questions = parseInt($('#count-question').text());
			if (total_questions <= count_questions) {
				el.remove();
				question.remove();
				window.location = window.location;
			}
			if (el.data('working')) return false;
			el.data('working', true);
			
			var parent_question = question.parent();
			var ref = question.attr('data-ref');
			var uid = question.attr('data-uid-ref');
			var qid = question.attr('data-qid');
			var uqid = question.attr('data-uid-qid');
			var ask = (question.find('#ask-mate').attr('checked') == "checked" ? 1 : 0);
			
			var idx = -1;
			var aid = "", qaid = "";
			if (question.find('button.btn').hasClass('active')){
				var btn_active = question.find('button.btn.active');
				idx = btn_active.index() + 1;
				aid = btn_active.attr('data-aid');
				qaid = btn_active.attr('data-ref-aid');
			}
			
			if (idx > 0){
				$.post('/ajax/questions',{
					ref : ref,
					uid : uid,
					idx : idx,
					qid : qid,
					uqid : uqid,
					ask : ask,
					aid : aid,
					qaid : qaid
				}, function(response){
					if (response.status == 1){
						question.remove();
						parent_question.html(response.html);
						$('#count-question').text(count_questions + 1);
						$('#btn-opt button').tooltip({
							placement : 'bottom'
						});
						$('.checkbox span').popover({
							placement : 'bottom',
							selector : true
						});
					}else{
						$('#modal-message').modal();
					}
					el.data('working', false);
				}, 'json');
			}else{
				el.data('working', false);
			}
			
			
			return false;
		});
	
	});
});