@extends ('layout') @section ('body')

<div class="card border">
	<div class="card-body">
		<h5 class="card-title">Todos os Carros</h5>
		<table class="table table-ordered table-hover" id="carstable">
			<thead class="thead-dark">
				<tr>
					<th>Id</th>
					<th>Modelo</th>
					<th>Cor</th>
					<th>Placa</th>
					<th>Ano</th>
					<th>Disponibilidade</th>
					<th>Alterações</th>

				</tr>
			</thead>

			<tbody>
				@foreach($cars as $c)
				<tr>

					<td>{{$c->id}}</td>
					<td>{{$c->car->model}}</td>
					<td>{{$c->color}}</td>
					<td>{{$c->boardnumber}}</td>
					<td>{{$c->year}}</td>
					<td>@if($c->status==1) Disponível @else Alugado @endif</td>
					<td>
						<button class="btn btn-sm btn-primary" role="button" onClick="editmodel({{$c->id}})">Editar</button>
						<button class="btn btn-sm btn-danger" role="button" onClick="remove({{$c->id}})">Excluir</button>
					</td>

				</tr>
				@endforeach
			</tbody>
		</table>

		<div class="card-footer">
			<button class="btn btn-sm btn-primary" role="button"
				onClick="newModel()">Adicionar Carro</button>

		</div>

	</div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="CarsForm">
	<div class="modal-dialog" role="document">

		<div class="modal-content">
			<form class="form-horizontal" id="formCars">

				<div class="modal-header">
					<h5 class="modal-title">Novo Carro</h5>

				</div>

				<div class="modal-body">
					@csrf <input type="hidden" id="id" class="form-control">

					<div class="form-group">

						<label class="control-label">Modelo do Carro</label>
						<div class="input-group">
							<select class="form-control" id="carModel">
								<option disabled selected>Selecione o Modelo do Carro</option>
								
								@foreach ($models as $m)
								<option value="{{$m->id}}">{{$m->model}}</option> 
								@endforeach
								
							</select>
						</div>


						<label for="carColor" class="control-label">Cor do Carro</label>
    						<div class="input-group">
    							<input type="text" class="form-control" id="carColor" placeholder="Cor do carro">
    						</div>

						<label for="carBoard" class="control-label">Placa do Carro</label>
    						<div class="input-group">
    							<input type="text" class="form-control" id="carBoard" placeholder="Placa do carro">
    						</div>

						<label for="carYear" class="control-label">Ano do Carro</label>
    						<div class="input-group">
    							<input type="text" class="form-control" id="carYear" placeholder="Ano do carro">
    						</div>



					</div>


				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
					<button type="cancel" class="btn btn-secondary" data-dismiss>Cancelar</button>
				</div>
			</form>


		</div>

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

		function editmodel(id){
			$.getJSON('/api/cars/' + id, function(data){

				$('#id').val(data.id);
				$('#carModel').val(data.model_id);
				$('#carColor').val(data.color);
				$('#carBoard').val(data.boardnumber);
				$('#carYear').val(data.year);
				$('#CarsForm').modal('show');
					


				});

			}

		function savemodel(){
			car = {
					id: $("#id").val(),
					model: $("#carModel").val(),
					color: $("#carColor").val(),
					board: $("#carBoard").val(),
					year: $("#carYear").val()
			};

			$.ajax({
				type: "PUT",
				url: "/api/cars/" + car.id,
				context: this,
				data: car,
				});

		}
		

		function newModel(){

			$('#carColor').val('');
			$('#carBoard').val('');
			$('#carYear').val('');
			$('#CarsForm').modal('show');
		}
	

		function remove(id){
			$.ajax({
					type: "DELETE",
					url: "/api/cars/" + id,
					context: this,
					success: function(){
						
						lines = $("#carstable>tbody>tr");
						
						e = lines.filter(function(i, elemento){
							return elemento.cells[0].textContent == id;
							});
						
						if(e)
							e.remove();
						}
					
				});
			}


		function createModel(){
				car = { model: $("#carModel").val(),
						color: $("#carColor").val(),
						board: $("#carBoard").val(),
						year: $("#carYear").val()
				};
				$.post("/api/cars", car)
		}
	
		$("#CarsForm").submit(function(event){
    		if($("#id").val() != '')
        		savemodel();
    		else
    			createModel();
    		$('#CarsForm').modal('hide');
    		
    		
	})
	
		
	
	
</script>

@endsection
