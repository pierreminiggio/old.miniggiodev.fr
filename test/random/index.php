<style>
	.nombre-random {
		font-size: 24px;
		font-weight: bold;
	}
</style>

Nombre entre 1 et 20 : <span class="nombre-random" data-min="1" data-max="20"></span><br>
Nombre entre 50 et 100 : <span class="nombre-random" data-min="50" data-max="100"></span>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('.nombre-random').each(function() {
			var min = $(this).data('min');
			var max = $(this).data('max');
			$(this).html(Math.floor(Math.random() * (max - min + 1)) + min);
		});
	});
</script>
