<?php 
	include "connect.php";

	if (	
		isset($_POST['submit']) && 
		!empty($_POST['name']) &&
		!empty($_POST['address']) &&
		!empty($_POST['postal']) &&
		!empty($_POST['city']) &&
		!empty($_POST['phone']) &&
		!empty($_POST['email'])
	) {

		$name 		= ucfirst(htmlspecialchars(mysqli_real_escape_string($con, $_POST['name'])));
		$address 	= htmlspecialchars(mysqli_real_escape_string($con, $_POST['address']));
		$postal		= htmlspecialchars(mysqli_real_escape_string($con, $_POST['postal']));
		$city 		= ucfirst(htmlspecialchars(mysqli_real_escape_string($con, $_POST['city'])));
		$phone		= htmlspecialchars(mysqli_real_escape_string($con, $_POST['phone']));
		

		$email 		= mysqli_real_escape_string($con, $_POST['email']);

		if (strlen($phone) >= 13) {
			$msg = urlencode(htmlspecialchars("Uw telefoonnummer mag maximaal 13 tekens bevatten"));
			header("location:index.php?msg=$msg");
		} else {
			if (strpos("@", $email) && !strpos(".", $email)) {
				$sql 		= 	"INSERT INTO address_list (name, address, postal, city, email, phone) VALUES ('$name','$address','$postal','$city','$email','$phone')";
				$query 	= 	mysqli_query($con, $sql);

				$msg = urlencode(htmlspecialchars("Alles succesvol ingevoerd!"));
				header("location:index.php?msg=$msg");
			} else {
				$msg = urlencode(htmlspecialchars("Dat is geen goed e-mail adres!"));
				header("location:index.php?msg=$msg");
			}
		}
	} else {
		$msg = urlencode(htmlspecialchars("Please fill in all the fields!"));
		header("location:index.php?msg=$msg");
	}

	filter_var($email, VALIDATE_EMAIL)

?>