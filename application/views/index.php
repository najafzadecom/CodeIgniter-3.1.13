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

		<div class="card-body">
			<form action="<?php echo base_url('home/calculate');?>" method="POST">
			<?php if ($this->session->flashdata('success')) {?>
				<div class="alert alert-success">
					<?php echo $this->session->userdata('success'); ?>
				</div>
			<?php } ?>

			<?php foreach($questions as $question): ?>
				<div class="card">
					<div class="card-body">
						<h5><?php echo $question->title; ?></h5>
						<ul>
							<?php foreach ($this->answer->get($question->id) as $answer): ?>
								<li><input type="radio" value="1" name="answers[<?php echo $answer->id; ?>]" /><?php echo $answer->title; ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endforeach; ?>

				<button type="submit" class="btn btn-success">Cavabla</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>
