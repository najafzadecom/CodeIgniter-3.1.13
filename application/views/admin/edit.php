<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Exam system - Question Edit</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<h2 class="text-center mt-5 mb-3"><?php echo $title;?></h2>
	<div class="card">
		<div class="card-header">
			<a class="btn btn-outline-info float-right" href="<?php echo base_url('question');?>">
				View All Questions
			</a>
		</div>
		<div class="card-body">
			<?php if ($this->session->flashdata('errors')) {?>
				<div class="alert alert-danger">
					<?php echo $this->session->flashdata('errors'); ?>
				</div>
			<?php } ?>

			<form action="<?php echo base_url('question/update/' . $question->id);?>" method="POST">
				<input type="hidden" name="_method" value="PUT">
				<div class="form-group">
					<label for="name">Title</label>
					<input
						type="text"
						class="form-control"
						id="title"
						name="title"
						value="<?php echo $question->title;?>">
				</div>


				<div class="form-group">
					<label for="name">Answer</label>
					<?php foreach($answers as $answer): ?>
						<div class="row">
							<div class="col-10">
								<input type="text" class="form-control" name="answers[<?php echo $answer->id; ?>][title]" value="<?php echo $answer->title; ?>">
							</div>
							<div class="col-2">
								<input type="checkbox" name="answers[<?php echo $answer->id; ?>][correct]" <?php if($answer->correct) { ?>checked="checked" <?php } ?> />
							</div>
						</div>
						<br/>
					<?php endforeach; ?>
				<button type="submit" class="btn btn-outline-primary">Save</button>
			</form>

		</div>
	</div>
</div>
</body>
</html>
