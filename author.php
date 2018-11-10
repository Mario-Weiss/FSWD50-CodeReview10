<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<title>The Big Library</title>
</head>
<body>
	<?php 
	include "config.php"; 
	include "nav.php";

	If (isset($_GET["delete"]) && isset($_GET["id"])) {
		$condition["id"] = $_GET["id"];
		$obj->delete("author",$condition);
	}
	?>
	
	<div class="container-fluid pt-5">
		<div class="row justify-content-center">
			<div class="col-8 text-center">
				<h2>author overview</h2>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>first name</th>
							<th>last name</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$table ="author";
						$rows = $obj->fetch_data($table);
						foreach ($rows as $row) {
						?>
						<tr>
							<td><?php echo $row["name"]; ?></td>
							<td><?php echo $row["surname"]; ?></td>
							<td><a href="edit.php?author=1&edit=1&id=<?php echo $row["id"]; ?>" class="btn-sm btn btn-primary">edit</a>
								<a href="author.php?delete=1&id=<?php echo $row["id"]; ?>" class="btn-sm btn btn-danger">delete</a>
								<a href="author.php?show=1&id=<?php echo $row["id"]; ?>" class="btn-sm btn btn-success">show media</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			</div>
		</div>


	</div>
	
	


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>