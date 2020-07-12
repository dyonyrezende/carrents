<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbar" aria-controls="navbar" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbar">
		<ul class="navbar-nav mr-auto">
			<?php
use Illuminate\Support\Facades\Auth;

echo '<li class="nav-item"><a class="nav-link" href="/">Home</a></li>';

$x = Auth::id();
if ($x == 1) {
    echo '<li class="nav-item"><a class="nav-link" href="/admin/modelos">Modelos</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="/admin/cars">Carros</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="/admin/alugados">Alugados</a></li>';
} 
else {
    echo '<li class="nav-item"><a class="nav-link" href="/user/alugar">Alugar</a></li>';
}

echo '<li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>';

?>

		</ul>

	</div>
</nav>
