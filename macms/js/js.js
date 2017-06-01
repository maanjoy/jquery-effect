$(function() {

	$('.tab').tab({
		event: 'click',
		auto: false,
		before: function() {

		},
		after: function() {
			if ($('.tab .nav li:last').is('.current')) {
				$('body').addClass('on');
			} else {
				$('body').removeClass('on');
			}
		}
	});


});