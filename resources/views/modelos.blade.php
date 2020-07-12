@extends ('layout') @section ('body')

<div class="card border">
	<div class="card-body">
		<h5 class="card-title">Todos os Modelos de Carro</h5>
		<table class="table table-ordered table-hover" id="carstable">
			<thead class="thead-dark">
				<tr>
					<th>Id</th>
					<th>Modelo</th>
					<th>Alterações</th>

				</tr>
			</thead>

			<tbody>
				@foreach($models as $m)
				<tr>

					<td>{{$m->id}}</td>
					<td>{{$m->model}}</td>
					<td>
						<button class="btn btn-sm btn-primary" role="button"
							onClick="edit({{$m->id}})">Editar</button>
						<button class="btn btn-sm btn-danger" role="button"
							onClick="remove({{$m->id}})">Excluir</button>
					</td>


				</tr>
				@endforeach
			</tbody>
		</table>

		<div class="card-footer">
			<button class="btn btn-sm btn-primary" role="button"
				onClick="newModel()">Adicionar Modelo</button>

		</div>

	</div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="CarsForm">
	<div class="modal-dialog" role="document">

		<div class="modal-content">
			<form class="form-horizontal" id="formCars">

				<div class="modal-header">
					<h5 class="modal-title">Novo Modelo</h5>

				</div>

				<div class="modal-body">
					@csrf <input type="hidden" id="id" class="form-control">

					<div class="form-group">
						<label for="carModel" class="control-label">Modelo do Carro</label>
						<div class="input-group">
							<input type="text" class="form-control" id="carModel"
								placeholder="Modelo do carro">


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

		function edit(id){
			$.getJSON('/api/modelos/' + id, function(data){
				
				$('#id').val(data.id);
				$('#carModel').val(data.model);
				$('#CarsForm').modal('show');
				
				});
			}

		function saveeditedCar(){
			
				car = {
						id: $("#id").val(),
						model: $("#carModel").val(),
				};

				$.ajax({
					type: "PUT",
					url: "/api/modelos/" + car.id,
					context: this,
					data: car,
					
				
					
			
					
				});
			}


		function remove(id){
			$.ajax({
					type: "DELETE",
					url: "/api/modelos/" + id,
					context: this,
					success: function(){
						
						lines = $("#carstable>tbody>tr");
						
						x = lines.filter(function(i, elemento){
							return elemento.cells[0].textContent == id;
							});
						
						if(x)
							x.remove();
						}
					
			
					
				});
			}

	

		function newModel(){

			$('#carModel').val('');
			$('#CarsForm').modal('show');
		}




		function createModel(){
				car = {model: $("#carModel").val(),
				};
				$.post("/api/modelos", car);
		}

		

		
	
		$("#CarsForm").submit(function(event){

			if($("#id").val() != ''){
				saveeditedCar();
				location.reload();
			}
			
			else{
    			createModel();
    			
    		$('#CarsForm').modal('hide');
    		
    		
			}
			
			
	})
	

	
	

	

		

</script>

@endsection
