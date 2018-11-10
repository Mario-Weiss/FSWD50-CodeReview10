<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<title>The Big Library</title>
</head>
<body>
	<?php 
	include "config.php"; 
	include "nav.php";
	
	$type = '';
	if (isset($_GET["media"]))
	{ 	
		$pagetype= "media";
		if (isset($_GET["id"]) && ($_GET["id"]) != ''){
			$id = $_GET["id"] ?? '';
			$condition["id"] = $id;
			$fields = $obj::mediafields();
			$row = $obj->getData($pagetype,$fields,$condition);
			$title = $row[0]["title"] ?? '';
			$img = $row[0]["img"] ?? '';
			$author_id = $row[0]["author_id"] ?? '';
			$ISBN = $row[0]["ISBN"] ?? '';
			$short_desc = $row[0]["short_desc"] ?? '';
			$pub_date = $row[0]["publish_date"] ?? '';
			$publisher_id = $row[0]["publisher_id"] ?? '';
			$type = $row[0]["type"] ?? '';
			$status = $row[0]["status"] ?? '';
		} else {
			$id = $_POST["id"] ?? '';;
			$title = $_POST["title"] ?? '';
			$img = $_POST["img"] ?? '';
			$author_id = $_POST["author_id"] ?? '';
			$ISBN = $_POST["ISBN"] ?? '';
			$short_desc = $_POST["short_desc"] ?? '';
			$pub_date = $_POST["pub_date"] ?? '';
			$publisher_id = $_POST["publisher_id"] ?? '';
			$type = $_POST["type"] ?? '';
			$status = $_POST["status"] ?? '';
		}
	?>

	<div class="container-fluid pt-5">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="card">
					<div class=<?php if ($id !='') { echo'"bg-warning text-dark ';} else {echo '"bg-primary text-white';} ?> card-header">
						enter media details
					</div>
					<div class="card-body">
						<form method="post" <?php echo 'action="edit.php?'.$pagetype.'=1">'; ?>
							<input type="hidden" name="id" value=<?php echo '"'.$id.'"'; ?>>
							<table class="table table-hover  card-text">
								<tr>
									<td>title</td>
									<td><input type="text" class="form-control"  name="title" placeholder="Enter title" value=<?php echo '"'.$title.'"'; ?>></td>
								</tr>
								<tr>
									<td>image</td>
									<td><input type="text" class="form-control"  name="img" placeholder="Enter image-url" value=<?php echo '"'.$img.'"'; ?>></td>
								</tr>
								<tr>
									<td>author</td>
									<td><select class="form-control" name="author_id" value=<?php echo '"'.$author_id.'"'; ?> required>
										<option value="" hidden>Select an author...</option>
										<?php
											$table="author";
											$fields= array("id","CONCAT(name,' ',surname) as name");
											$rows = $obj->fetch_data($table,$fields);
											foreach ($rows as $row) {
										?>	
										<?php if ($row['id'] == $author_id) {
											echo"<option value='".$row['id']."' selected>".$row['name'];
										} else { 
											echo"<option value='".$row['id']."'>".$row['name'];
										}
										?>
										</option>
										<?php
										}
										?>
									</select></td>
								</tr>
								<tr>
									<td>ISBN</td>
									<td><input type="text" class="form-control"  name="ISBN" placeholder="Enter ISBN" value=<?php echo '"'.$ISBN.'"'; ?>></td>
								</tr>
								<tr>
									<td>short description</td>
									<td><input type="text" class="form-control"  name="short_desc" placeholder="Enter short description" value=<?php echo '"'.$short_desc.'"'; ?>></td>
								</tr>
								<tr>
									<td>publish date</td>
									<td><input type="date" class="form-control"  name="pub_date" placeholder="Enter publish date" value=<?php echo '"'.$pub_date.'"'; ?>></td>
								</tr>
								<tr>
									<td>publisher</td>
									<td><select class="form-control" name="publisher_id" value=<?php echo '"'.$publisher_id.'"'; ?> required>
										<option value="" hidden>Select a publisher...</option>
										<?php
											$table="publisher";
											$fields= array("id","name");
											$rows = $obj->fetch_data($table,$fields);
											foreach ($rows as $row) {
										?>	
										<?php if ($row['id'] == $publisher_id) {
											echo"<option value='".$row['id']."' selected>".$row['name'];
										} else { 
											echo"<option value='".$row['id']."'>".$row['name'];
										}
										?>
										</option>
										<?php
										}
										?>
									</select></td>
								</tr>
								<tr>
									<td>type</td>
									<td><input type="text" class="form-control"  name="type" placeholder="Enter type" value=<?php echo '"'.$type.'"'; ?>></td>
								</tr>
								<tr>
									<td>status</td>
									<td><select class="form-control" name="status"><option value="1" >available</option><option value="0" <?php if ($status ==='0'){echo "selected";} ?>>reserved</option></td>
								</tr>
								<tr>
									<td colspan="2" class="text-center"><input type="submit" class=<?php if ($id !='') { echo'"btn-warning ';} else {echo '"btn-primary ';} ?>btn " name=<?php echo'"submit_'.$pagetype.'" '; ?>value=<?php if ($id !='') { echo'"update ';} else {echo '"insert ';} ?>media"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php

	}
	if (isset($_GET["author"]))
	{ 
		$pagetype="author";
		if (isset($_GET["id"]) && ($_GET["id"]) != ''){
			$id = $_GET["id"] ?? '';
			$condition["id"] = $id;
			$fields = $obj::authorfields();
			$row = $obj->getData($pagetype,$fields,$condition);
			$name = $row[0]["name"] ?? '';
			$surname = $row[0]["surname"] ?? '';
		} else {
			$id = $_POST["id"] ?? '';
			$name = $_POST["name"] ?? '';
			$surname = $_POST["surname"] ?? '';
		}
	?>
	<div class="container-fluid pt-5">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="card">
					<div class=<?php if ($id !='') { echo'"bg-warning text-dark ';} else {echo '"bg-primary text-white';} ?> card-header">
						<?php if ($id != ''){echo "enter";}else{echo "edit";} ?> author details
					</div>
					<div class="card-body">
						<form method="post" <?php echo 'action="edit.php?'.$pagetype.'=1">'; ?>
							<input type="hidden" name="id" value=<?php echo '"'.$id.'"'; ?>>
							<table class="table table-hover  card-text">
								<tr>
									<td>name</td>
									<td><input type="text" class="form-control"  name="name" placeholder="Enter name" value=<?php echo '"'.$name.'"'; ?>></td>
								</tr>
								<tr>
									<td>surname</td>
									<td><input type="text" class="form-control"  name="surname" placeholder="Enter surname" value=<?php echo '"'.$surname.'"'; ?>></td>
								</tr>
								<tr>
									<td colspan="2" class="text-center"><input type="submit" class=<?php if ($id !='') { echo'"btn-warning ';} else {echo '"btn-primary ';} ?> btn" name=<?php echo'"submit_'.$pagetype.'" '; ?>value=<?php if ($id !='') { echo'"update ';} else {echo '"insert ';} ?> author"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php

	}
	if (isset($_GET["publisher"]))
	{ 
		$pagetype="publisher";
		if (isset($_GET["id"]) && ($_GET["id"]) != ''){
			$id = $_GET["id"] ?? '';
			$condition["id"] = $id;
			$fields = $obj::publisherfields();
			$row = $obj->getData($pagetype,$fields,$condition);
			$name = $row[0]["name"] ?? '';
			$adress = $row[0]["adress"] ?? '';
			$size = $row[0]["size"] ?? '';
		} else {
			$id = $_POST["id"] ?? '';
			$name = $_POST["name"] ?? '';
			$adress = $_POST["adress"] ?? '';
			$size = $_POST["size"] ?? '';
		}
	?>

	<div class="container-fluid pt-5">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="card">
					<div class=<?php if ($id !='') { echo'"bg-warning text-dark ';} else {echo '"bg-primary text-white';} ?> card-header">
						enter publisher details
					</div>
					<div class="card-body">
						<form method="post" <?php echo 'action="edit.php?'.$pagetype.'=1">'; ?>
							<input type="hidden" name="id" value=<?php echo '"'.$id.'"'; ?>>
							<table class="table table-hover  card-text">
								<tr>
									<td>name</td>
									<td><input type="text" class="form-control"  name="name" placeholder="Enter name" value=<?php echo '"'.$name.'"'; ?>></td>
								</tr>
								<tr>
									<td>adress</td>
									<td><input type="text" class="form-control"  name="adress" placeholder="Enter adress" value=<?php echo '"'.$adress.'"'; ?>></td>
								</tr>
								<tr>
									<td>size</td>
									<td><input type="text" class="form-control"  name="size" placeholder="Enter size" value=<?php echo '"'.$size.'"'; ?>></td>
								</tr>
								<tr>
									<td colspan="2" class="text-center"><input type="submit" class=<?php if ($id !='') { echo'"btn-warning ';} else {echo '"btn-primary ';} ?> btn" name=<?php echo'"submit_'.$pagetype.'" '; ?>value=<?php if ($id !='') { echo'"update ';} else {echo '"insert ';} ?> pubisher"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php

	}

	?>
	
	
	<?php 
	if (isset($_POST["submit_media"])){
		if ($title == '') {
			echo ("<script>swal('Title not entered!', 'You need to enter a title!', 'error');</script>");
		} elseif ($img == '') {
			echo ("<script>swal('image url not entered!', 'You need to enter an image url!', 'error');</script>");
		} elseif ($author_id == '') {
			echo ("<script>swal('Author not entered!', 'You need to enter an author!', 'error');</script>");
		} elseif ($ISBN == '') {
			echo ("<script>swal('ISBN not entered!', 'You need to enter an ISBN!', 'error');</script>");
		} elseif ($short_desc == '') {
			echo ("<script>swal('Short description not entered!', 'You need to enter a short description!', 'error');</script>");
		} elseif ($pub_date == '') {
			echo ("<script>swal('Publish date not entered!', 'You need to enter a publish date!', 'error');</script>");
		} elseif ($publisher_id == '') {
			echo ("<script>swal('Publisher not entered!', 'You need to enter a publisher!', 'error');</script>");
		} elseif ($type == '') {
			echo ("<script>swal('Type not entered!', 'You need to enter an type!', 'error');</script>");
		} elseif ($status == '') {
			echo ("<script>swal('Status not entered!', 'You need to enter an status!', 'error');</script>");
		} else {
			$table=$pagetype;
			$fields=$obj::mediafields();
			$values=array($id,$title,$img,$author_id,$ISBN,$short_desc,$pub_date,$publisher_id,$type,$status);
			if ($id != ''){
				$condition["id"] = $id;
				$set = [];
				foreach ($fields as $key => $value) {
					$set[$value] = $values[$key];
				}
				$obj->update($table,$set,$condition);
				echo("<script>swal('Good job!', 'media updated successully!', 'success').then((value) => { window.location.href='index.php';});</script>");
			}else {
				$obj->insert($table,$fields,$values);
				echo("<script>swal('Good job!', 'media created successully!', 'success').then((value) => {var a = window.location.href; window.location.href=a;});</script>");
			}
		}
    }

    if (isset($_POST["submit_author"])){
    	if ($name == '') {
			echo ("<script>swal('Name not entered!', 'You need to enter a name!', 'error');</script>");
		} elseif ($surname == '') {
			echo ("<script>swal('Surname not entered!', 'You need to enter a surename!', 'error');</script>");
		} else {
			$table=$pagetype;
			$fields=$obj::authorfields();
			$values=array($id,$name,$surname);
			if ($id != ''){
				$condition["id"] = $id;
				$set = [];
				foreach ($fields as $key => $value) {
					$set[$value] = $values[$key];
				}
				$obj->update($table,$set,$condition);
				echo("<script>swal('Good job!', 'author updated successully!', 'success').then((value) => { window.location.href='author.php';});</script>");
			} else {
				$obj->insert($table,$fields,$values);
				echo("<script>swal('Good job!', 'author created successully!', 'success').then((value) => {var a = window.location.href; window.location.href=a;});</script>");
			}
		}
	}
	if (isset($_POST["submit_publisher"])){
    	if ($name == '') {
			echo ("<script>swal('Name not entered!', 'You need to enter a name!', 'error');</script>");
		} elseif ($adress == '') {
			echo ("<script>swal('Adress not entered!', 'You need to enter a adress!', 'error');</script>");
		} elseif ($size == '') {
			echo ("<script>swal('Size not entered!', 'You need to enter a size!', 'error');</script>");
		} else {
			$table=$pagetype;
			$fields=$obj::publisherfields();
			$values=array($id,$name,$adress,$size);
			if ($id != ''){
				$condition["id"] = $id;
				$set = [];
				foreach ($fields as $key => $value) {
					$set[$value] = $values[$key];
				}
				$obj->update($table,$set,$condition);
				echo("<script>swal('Good job!', 'publisher updated successully!', 'success').then((value) => { window.location.href='publisher.php';});</script>");
			} else {
				$obj->insert($table,$fields,$values);
				echo("<script>swal('Good job!', 'publisher created successully!', 'success').then((value) => {var a = window.location.href; window.location.href=a;});</script>");
			}
		}
	}
     ?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>