$(function () {

	$('#publication').submit(function (e) {

			e.preventDefault();
			$('.return').empty();
			var postdata = $('#publication').serialize();

			$.ajax({

				type: 'POST',
				url: 'php/traitement.php',
				data: postdata,
				dataType: 'json',
				success: function(result) {

					if (result.isSuccess) 
					{
						$("#publication").append("<p class="thank-you">votre méssage a bien été envoyé. Merci de m'avoir contacté :)</p>");
						$("#publication")[0].reset();
					}
				}
			});
	})


})