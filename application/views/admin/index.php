<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Exam system</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="card-header">
				<a class="btn btn-outline-info float-right" href="<?php echo base_url('question/create');?>">
					Create
				</a>
			</div>
			<div class="card-body">
				<?php if ($this->session->flashdata('success')) {?>
					<div class="alert alert-success">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } ?>

				<table class="table table-responsive table-bordered">
					<thead>
					<th>ID</th>
					<th>Title</th>
					<th>Action</th>
					</thead>
					<tbody>
					<?php foreach ($questions as $question): ?>
						<tr>
							<td><?= $question->id ?></td>
							<td><?= $question->title ?></td>
							<td>
								<a href="<?php echo base_url('question/edit/'.$question->id) ?>">Edit</a>
								<a href="<?php echo base_url('question/delete/'.$question->id) ?>">Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

				<?php echo $links; ?>
			</div>
		</div>
	</div>
</body>
</html>
