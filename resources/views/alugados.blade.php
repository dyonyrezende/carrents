@extends ('layout') @section ('body')

<div class="card border">
	<div class="card-body">
		<h5 class="card-title">Todos os Aluguéis</h5>
		<table class="table table-ordered table-hover" id="carstable">
			<thead class="thead-dark">
				<tr>
					<th>Nº</th>
					<th>Cliente</th>
					<th>Carro</th>
					<th>Data de Locação</th>
					<th>Data de Devolução</th>
					<th>Valor do Aluguel</th>
					<th>Alterar</th>

				</tr>
			</thead>

			<tbody>
				@foreach($cars as $c)
				<tr>

					<td>{{$c->id}}</td>
					<td>{{$c->clientt->name}}</td>
					<td>{{$c->carr->car->model}}</td>
					<td>{{$c->locationdate}}</td>
					<td>{{$c->devolutiondate}}</td>
					<td>{{$c->rentvalue}}</td>


					<td>
					@if($c->status == 1)
						<button class="btn btn-sm btn-success" role="button"
							onClick="makedevolution({{$c->id}})">Registrar Devolução</button>
					@else
						<button class="btn btn-sm btn-danger" role="button" disabled>Carro já devolvido</button>

					</td> 
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>


	</div>

</div>







@endsection('body') @section('javascript')

<script type="text/javascript">
		$.ajaxSetup({
				headers:{
						'X-CSRF-TOKEN': "{{ csrf_token() }}"
					}

			});

		

		
		function makedevolution(id){
			$.getJSON('/api/alugados/' + id, function(data){

						x = data.model_id;


						$.ajax({
							type: "PUT",
							url: "/api/alugados/" + data.id,
							context: this,
							data: x,
							});
						
				});		

	}
		
		
	
</script>

@endsection
