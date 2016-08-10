$( document ).ready(function() {
	$('.distance-calculator input[type="submit"]').click(function(){
		var origins = $('.distance-calculator input[name="origins"]').val();
		var destinations = $('.distance-calculator input[name="destinations"]').val();
		var mode = $('.distance-calculator select[name="mode"]').val();

		if (origins.length > 0 && destinations.length > 0 ) {
			var parameters = {
				origins: origins,
				destinations: destinations,
				mode: mode
			};
			$.post('api/distance-calculator.php',
				parameters,
				function(data){
					$('.api-answer').html(data);
				}
			)
			.fail(function() {
				$('.api-answer').html('Please try again later.');
			});
		}
		else {
			$('.api-answer').html('Please fill all the fields.');
		}

		return false;
	});
});