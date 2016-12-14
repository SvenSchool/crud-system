<?php
	include "connect.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$sql = "SELECT * FROM address_list WHERE id = '$id'";
		$query = mysqli_query($con, $sql);

		$row = mysqli_fetch_assoc($query);
	} else {
		$msg = urlencode(htmlspecialchars("Please click an entry you want to edit"));
		header("location:index.php?msg=$msg");
	}

	if (
		isset($_POST['submit']) &&
		!empty($_POST['name']) &&
		!empty($_POST['address']) &&
		!empty($_POST['postal']) &&
		!empty($_POST['city']) &&
		!empty($_POST['phone']) &&
		!empty($_POST['email'])
	) {
		$name = $_POST['name'];
		$name = ucfirst($name);
		$address = $_POST['address'];
		$postal = $_POST['postal'];
		$city = $_POST['city'];
		$city = ucfirst($city);
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		if (!strlen($phone) > 13 && strpos("@", $email) && strpos(".", $email)) {
			$sql = "UPDATE address_list SET 
				name = '$name', 
				address = '$address', 
				postal = '$postal', 
				city = '$city', 
				phone = '$phone', 
				email = '$email' 
				WHERE id = '$id'";
			$query = mysqli_query($con, $sql);

			header("location:index.php#$id");
		} else {
			$msg = urlencode(htmlspecialchars("Een of meerdere velden zijn fout ingevuld. Bekijk e-mail en telefoonnummer nog een keer"));
			header("location:index.php?msg=$msg");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit entry #<?php echo $id ?></title>
	<style type="text/css">
		label {width:150px;display:inline-block;}
		input {width:300px;}
		.submit {width:460px;}
	</style>
</head>
<body>
	<form action="#" method="post">
		<div class="form-group">
			<label for="name">Edit name:</label>
			<input type="text" name="name" value="<?php echo $row['name'] ?>">
		</div>

		<div class="form-group">
			<label for="adress">Edit adress:</label>
			<input type="text" name="address" value="<?php echo $row['address'] ?>">
		</div>

		<div class="form-group">
			<label for="postal">Edit postal code:</label>
			<input type="text" name="postal" value="<?php echo $row['postal'] ?>">
		</div>

		<div class="form-group">
			<label for="city">Edit city:</label>
			<input type="text" name="city" value="<?php echo $row['city'] ?>">
		</div>

		<div class="form-group">
			<label for="phone">Edit phone Nr:</label>
			<input type="text" name="phone" value="<?php echo $row['phone'] ?>">
		</div>

		<div class="form-group">
			<label for="email">Edit E-mail:</label>
			<input type="email" name="email" value="<?php echo $row['email'] ?>">
		</div>

		<input class="submit" type="submit" name="submit">
	</form>
</body>
</html>