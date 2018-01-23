<?php
	header('Content-type: application/json');

	$servername = getenv("DATABASE_SERVICE_NAME") ? getenv(strtoupper(getenv("DATABASE_SERVICE_NAME"))."_SERVICE_HOST") : "127.0.0.1";
	$username = getenv("DATABASE_USER") ?: "root";
	$password = getenv("DATABASE_PASSWORD") ?: "";
	$dbname = getenv("DATABASE_NAME") ?: "sggeospatial";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}


	$sql = "SELECT * FROM mrtpoints2";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		echo '{';
		echo '"type": "FeatureCollection",';
		echo '"crs": {';
		echo '"type": "name",';
		echo '"properties": {';
		echo '  "name": "urn:ogc:def:crs:OGC:1.3:CRS84"';
		echo '}';
		echo '},';
		echo '"features": [';


		$isFirstRow = true;

		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			if(!$isFirstRow) {
				echo ',';
			}

			echo '{';
			echo '"type": "Feature",';
			echo '"properties": {';
			echo '"BUILDING_N": "' . $row["BUILDING_N"] . '",';
			echo '"STN_NO":"' . $row["STN_NO"] . '",';
			echo '"XCOORD":' . $row["XCOORD"] . ',';
			echo '"YCOORD":' . $row["YCOORD"];
			echo '},';
			echo '"geometry": {';
			echo '"type": "Point",';
			echo '"coordinates": [';
			echo $row["longitude"] . ',';
			echo $row["latitude"];
			echo ']';
			echo '}';
			echo '}';

			$isFirstRow = false;
		} // end while loop

		echo ']';
		echo '}';

	} else {
		echo "0 results";
	}

	mysqli_close($conn);
?>
