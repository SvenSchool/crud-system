<?php 
	include "connect.php"; 

	if (isset($_GET['rem'])) {
		$id = $_GET['rem'];
		$sql = "DELETE FROM address_list WHERE id = '$id'";
		$query = mysqli_query($con, $sql);

		$msg = urlencode(htmlspecialchars("Entry nummer $id succesvol verwijderd."));
		header("location:index.php?msg=$msg");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sven Luijten</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<style type="text/css">
		label {width:150px;}
	</style>
</head>
<body>
<div class="container">
	<h1>CRUD-systeem Sven Luijten</h1>
	<?php 
		if (isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			echo "<p class='text-danger'>$msg</p>";
		}
	?>

		<table>
			<thead>
				<th>Name</th>
				<th>Address</th>
				<th>Postal</th>
				<th>City</th>
				<th>E-mail</th>
				<th>Phone number</th>
				<th>Edit</th>
				<th>Delete</th>
			</thead>
			<tbody>
	<?php
		$sql = "SELECT * FROM address_list";
		$query = mysqli_query($con, $sql);

		while($row = mysqli_fetch_assoc($query)) {
			echo "<tr id='".$row['id']."'><td>".$row['name']."</td>";
			echo "<td>".$row['address']."</td>";
			echo "<td>".$row['postal']."</td>";
			echo "<td>".$row['city']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['phone']."</td>";
			echo "<td><a href='edit.php?id=".$row['id']."'>Edit</td>";
			echo "<td><a href='index.php?rem=".$row['id']."'>X</td>";
		}
	?>
			</tbody>
		</table>

	<form action="add.php" method="post">
		<div class="form-group">
			<label for="name">Your name:</label>
			<input type="text" name="name">
		</div>

		<div class="form-group">
			<label for="adress">Your adress:</label>
			<input type="text" name="address">
		</div>

		<div class="form-group">
			<label for="postal">Your postal code:</label>
			<input type="text" name="postal">
		</div>

		<div class="form-group">
			<label for="city">Your city:</label>
			<input type="text" name="city">
		</div>

		<div class="form-group">
			<label for="phone">Your phone Nr:</label>
			<input type="text" name="phone">
		</div>

		<div class="form-group">
			<label for="email">Your E-mail:</label>
			<input type="email" name="email">
		</div>

		<input type="submit" name="submit">
	</form>
</div>
</body>
</html>