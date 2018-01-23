<?php
	$servername = getenv("DATABASE_SERVICE_NAME") ? getenv(strtoupper(getenv("DATABASE_SERVICE_NAME"))."_SERVICE_HOST") : "127.0.0.1";
	$username = getenv("DATABASE_USER") ?: "root";
	$password = getenv("DATABASE_PASSWORD") ?: "";
	$dbname = getenv("DATABASE_NAME") ?: "sggeospatial";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "UPDATE mrtpoints2 SET BUILDING_N='" . $_GET["number"] . "' WHERE STN_NO='" . $_GET["stn"] . "'";

	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}

	mysqli_close($conn);
?>
