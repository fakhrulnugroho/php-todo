<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TodoList App</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<span class="navbar-brand mb-0 h1">TodoList App</span>	
		</div>
	</nav>
	<div class="jumbotron">
		<div class="container">
			<h1 class="display-4">Welcome!</h1>
			<hr>
			<p class="lead">There is a simple TodoList App using PHP & MySQL.</p>
		</div>
	</div>
	<div class="container">
		<div class="row mb-5">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header clearfix">
						<div class="float-left">
							<h5>Task Active</h5>
						</div>
						<div class="float-right">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal">
								Add Task
							</button>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<td>No</td>
									<td>Task</td>
									<td>Start</td>
									<td>Finish</td>
									<td>Status</td>
									<td>Action</td>
								</tr>
							</thead>
							<tbody id="task-active">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-5">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header clearfix">
						<div class="float-left">
							<h5>Task Archive</h5>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<td>No</td>
									<td>Task</td>
									<td>Status</td>
									<td>Action</td>
								</tr>
							</thead>
							<tbody id="task-archive">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel">Add Task</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="save_task.php" method="POST">
						<div class="form-group">
							<label for="task">Task</label>
							<input type="text" name="task" id="task" class="form-control" placeholder="Add Task . . ." required="required">
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="start">Start</label>
									<input type="date" name="start" id="start" class="form-control" required="required">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="finish">Finish</label>
									<input type="date" name="finish" id="finish" class="form-control" required="required">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" id="description" class="form-control" rows="4" style="resize: none;" placeholder="Add Description" required="required"></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Add</button>
							<button type="reset" class="btn btn-danger btn-sm">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery-3.4.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			get_tasks_active()
			get_tasks_archive()

			$('button[type=reset]').click(function(){
				$('#modal').modal('toggle')
			})

			$('button[type=button]').click(function(){
				reset_form()
			})

			$(document).on('submit', 'form', function(e){
				e.preventDefault()

				const method = $(this).attr('method')
				const action = $(this).attr('action')
				const data = $(this).serialize()

				$.ajax({
					type: method,
					url: action,
					dataType: 'json',
					data: data,
					success: function(data){
						if(data.status == 'success'){
							reset_form()
							get_tasks_active()
							$('#modal').modal('toggle')
						}
					}
				})
			})

			$(document).on('click', '.btn-finish', function(){
				const link = $(this).data('url')

				$.ajax({
					type: 'GET',
					url: link,
					success: function(){
						get_tasks_active()
						get_tasks_archive()
					}
				})
			})

			$(document).on('click', '.btn-archive', function(){
				const link = $(this).data('url')

				$.ajax({
					type: 'GET',
					url: link,
					success: function(){
						get_tasks_active()
						get_tasks_archive()
					}
				})
			})

			$(document).on('click', '.btn-restore', function(){
				const link = $(this).data('url')

				$.ajax({
					type: 'GET',
					url: link,
					success: function(){
						get_tasks_active()
						get_tasks_archive()
					}
				})
			})

			$(document).on('click', '.btn-delete', function(){
				const link = $(this).data('url')

				$.ajax({
					type: 'GET',
					url: link,
					success: function(){
						get_tasks_active()
						get_tasks_archive()
					}
				})
			})

			function get_tasks_active(){
				$.ajax({
					type: 'GET',
					url: 'get_task.php',
					success: function(data){
						$('tbody#task-active').html(data)
					}
				})
			}

			function get_tasks_archive(){
				$.ajax({
					type: 'GET',
					url: 'get_task_archive.php',
					success: function(data){
						$('tbody#task-archive').html(data)
					}
				})
			}

			function reset_form(){
				$('input').val('')
				$('textarea').val('')
			}
		})
	</script>
</body>
</html>