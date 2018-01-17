<?php
	header('Content-type: application/json');

	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "sggeospatial";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT data FROM mrtpoints";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo $row["data"];
		}
	} else {
		echo "0 results";
	}

	mysqli_close($conn);
?>