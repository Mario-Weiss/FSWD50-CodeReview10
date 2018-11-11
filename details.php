<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<title>The Big Library</title>
</head>
<body class="bg-secondary">
	<?php 
	include "config.php"; 
	include "nav.php";

	$type = $_GET["type"] ?? '';
	$id = $_GET["id"] ?? '';
	$title = $_GET["title"] ?? '';
	$title = htmlspecialchars($title);
	if ($type == "author" || $type == "publisher") {
	?>
	<div class="container-fluid pt-5">
		<div class="row">
			<div class="col-12 text-center">
				<h2><?php echo $title; ?></h2>
				<table class="table table-bordered table-dark table-striped table-hover">
					<thead>
						<tr>
							<th>image</th>
							<th>title &nbsp;<a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=title asc"><i class="fas fa-chevron-up"></i></a><a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=title desc"><i class="fas fa-chevron-down"></i></a></th>
							<th>author &nbsp;<a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=author asc"><i class="fas fa-chevron-up"></i></a><a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=author desc"><i class="fas fa-chevron-down"></i></a></th>
							<th>ISBN &nbsp;<a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=ISBN asc"><i class="fas fa-chevron-up"></i></a><a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=ISBN desc"><i class="fas fa-chevron-down"></i></a></th>
							<th>short desc. &nbsp;<a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=short_desc asc"><i class="fas fa-chevron-up"></i></a><a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=short_desc desc"><i class="fas fa-chevron-down"></i></a></th>
							<th>publish date &nbsp;<a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=publish_date asc"><i class="fas fa-chevron-up"></i></a><a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=publish_date desc"><i class="fas fa-chevron-down"></i></a></th>
							<th>publisher &nbsp;<a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=publisher asc"><i class="fas fa-chevron-up"></i></a><a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=publisher desc"><i class="fas fa-chevron-down"></i></a></th>
							<th>type &nbsp;<a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=type asc"><i class="fas fa-chevron-up"></i></a><a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=type desc"><i class="fas fa-chevron-down"></i></a></th>
							<th>status &nbsp;<a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=status asc"><i class="fas fa-chevron-up"></i></a><a href="details.php?<?php echo "type=".$type."&id=".$id."&title=".$title; ?>&sort=status desc"><i class="fas fa-chevron-down"></i></a></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$table ="media m" ;
						$fields = array("m.id","img","title","CONCAT(a.name,' ',a.surname) as author","ISBN","short_desc","publish_date","p.name as publisher","type","status");
						$join = array("INNER JOIN author a ON m.author_id = a.id","INNER JOIN publisher p ON m.publisher_id = p.id");
						if ($type == "author") { 
							$where = "WHERE author_id = '".$id."'";
						} elseif ($type == "publisher") { 
							$where = "WHERE publisher_id = '".$id."'";
						}
						$orderby = isset($_GET["sort"]) ? "ORDER BY ".$_GET["sort"] : '';
						$rows = $obj->fetch_data($table,$fields,$join,$where,$orderby);
						foreach ($rows as $row) {
						?>
						<tr>
							<td><?php echo "<img src='".htmlspecialchars($row["img"])."'>" ?></td>
							<td><?php echo htmlspecialchars($row["title"]); ?></td>
							<td><?php echo htmlspecialchars($row["author"]); ?></td>
							<td><?php echo htmlspecialchars($row["ISBN"]); ?></td>
							<td><?php echo htmlspecialchars($row["short_desc"]); ?></td>
							<td><?php echo htmlspecialchars($row["publish_date"]); ?></td>
							<td><?php echo htmlspecialchars($row["publisher"]); ?></td>
							<td><?php echo htmlspecialchars($row["type"]); ?></td>
							<td><?php if ($row["status"] == 1) {echo "available";}else{echo "reserved";} ?></td>
							<td><a href="edit.php?media=1&edit=1&id=<?php echo $row["id"]; ?>" class="btn-sm btn btn-primary my-1">edit</a>
								<a href="index.php?delete=1&id=<?php echo $row["id"]; ?>" class="btn-sm btn btn-danger my-1">delete</a>
								<a href="details.php?type=media&id=<?php echo $row["id"]."&title=".$row["title"]; ?>" class="btn-sm btn btn-success my-1">details</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			</div>
		</div>


	<?php
	} elseif ($type == "media") {
		$table ="media m" ;
		$fields = array("m.id","img","title","a.id as author_id","CONCAT(a.name,' ',a.surname) as author","ISBN","short_desc","publish_date","p.id as publisher_id","p.name as publisher","p.adress as publisher_adress","type","status");
		$join = array("INNER JOIN author a ON m.author_id = a.id","INNER JOIN publisher p ON m.publisher_id = p.id");
		$orderby = isset($_GET["sort"]) ? "ORDER BY ".$_GET["sort"] : '';
		$where = "WHERE m.id = '".$id."'";
		$rows = $obj->fetch_data($table,$fields,$join,$where,$orderby);
	?>
	<div id="infobox" class="container rounded pt-3 pt-md-5">
		<div class="d-flex align-self-stretch infobox">
			<img src=<?php echo '"'.htmlspecialchars($rows[0]["img"]).'"'; ?>
			 alt="">
			<div class="lg-12 d-flex flex-column w-100 pl-3 pr-1">
				<h1><?php echo htmlspecialchars($rows[0]["title"]); ?></h1>
				<h6>release date: <?php echo htmlspecialchars($rows[0]["publish_date"]); ?></p>
				<h5>Genre: <small>placeholder</small></h5>
				<h5>Author</h5>
				<h5><?php echo '<a class="text-dark"  href="details.php?type=author&id='.$rows[0]["author_id"].'&title='.htmlspecialchars($rows[0]["author"]).'">'.htmlspecialchars($rows[0]["author"]).'</a>'; ?></h5>
				<h5>Publisher</h5>
				<h5><?php echo '<a class="text-dark"  href="details.php?type=publisher&id='.$rows[0]["publisher_id"].'&title='.htmlspecialchars($rows[0]["publisher"]).'">'.htmlspecialchars($rows[0]["publisher"]).'<br>'.htmlspecialchars($rows[0]["publisher_adress"]).'</a>'; ?></h5>
				<h5>ISBN: <small><?php echo htmlspecialchars($rows[0]["ISBN"]); ?></small></h5>
				<h5>Type: <small><?php echo htmlspecialchars($rows[0]["type"]); ?></small></h5>
			</div>
		</div>
		<div class="pt-3">
			<h4>short description</h4>
				<p><?php echo htmlspecialchars($rows[0]["short_desc"]); ?></p>
			
		</div>
	</div>

	<?php
	}
	?>

	
	


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>