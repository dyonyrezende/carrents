@extends ('layout') @section ('body')

<div class="card border">
	<div class="card-body">
		<h5 class="card-title">Carros Disponíveis</h5>
		<table class="table table-ordered table-hover" id="carstable">
			<thead class="thead-dark">
				<tr>
					<th>Id</th>
					<th>Modelo</th>
					<th>Cor</th>
					<th>Placa</th>
					<th>Ano</th>
					<th>Alugar</th>

				</tr>
			</thead>

			<tbody>
				@foreach($cars as $c) @if($c->status == 1)
				<tr>

					<td>{{$c->id}}</td>
					<td>{{$c->car->model}}</td>
					<td>{{$c->color}}</td>
					<td>{{$c->boardnumber}}</td>
					<td>{{$c->year}}</td>
					<td>
						<button class="btn btn-sm btn-primary" role="button" onClick="fuck({{$c->id}})">Alugar</button>
					</td>

				</tr>
				@endif 
				@endforeach
			</tbody>
		</table>

		<div class="card-footer"></div>

	</div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="CarsForm">
	<div class="modal-dialog" role="document">

		<div class="modal-content">
			<form class="form-horizontal" id="formCars">

				<div class="modal-header">
					<h5 class="modal-title">Aluguel de Carro</h5>

				</div>

				<div class="modal-body">
					@csrf <input type="hidden" id="id" class="form-control">

					<div class="form-group">

						<label class="control-label">Modelo do Carro</label> <select
							class="form-control" id="carModel" disabled> 
							@foreach ($models as $m)

							<option value="{{$m->id}}">{{$m->model}}</option> 
							
							@endforeach

						</select> 
						
						<label for="locationDate" class="control-label">Data de Locação</label>
    						<div class="input-group">
    							<input type="text" class="form-control" id="locationDate" placeholder="DD/MM/AAAA">
    						</div>

						<label for="devolutionDate" class="control-label">Data de Devolução</label>
    						<div class="input-group">
    							<input type="text" class="form-control" id="devolutionDate" placeholder="DD/MM/AAAA">
    						</div>

						<label for="rentValue" class="control-label">Valor da Locação</label>
    						<div class="input-group">
    							<input type="text" class="form-control" id="rentValue" placeholder="Valor da Loca��o" readonly>
    						</div>

					</div>


				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Confirmar</button>
					<button type="cancel" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</form>


		</div>

	</div>

</div>







@endsection('body') @section('javascript')

<script type="text/javascript">
		$.ajaxSetup({
				headers:{
						'X-CSRF-TOKEN': "{{ csrf_token() }}"
					}

			});


		function fuck(id){
			$.getJSON('/api/alugar/' + id, function(data){

				$('#id').val(data.id),
				$('#carModel').val(data.model_id),
				$('#rentValue').val('1000,00');			
				$('#CarsForm').modal('show');

				
				});
			
			
		}



		function savemodel(){
			carrent = {
					
					model: $("#id").val(),
					locationdate: $("#locationDate").val(),
					devolutiondate: $("#devolutionDate").val(),
					rentvalue: $("#rentValue").val()
			};
			
			$.post("/api/alugar", carrent);
			
			
		}

		
		$("#formCars").submit(function(event){
			
			savemodel();			
      		$('#CarsForm').modal('hide');
			
			location.reload(true);
			
			
      		
    		
    		
	});
	
	
</script>

@endsection
