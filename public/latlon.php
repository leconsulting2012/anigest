<?php

$nomehost = "localhost";
$nomeuser = "root";
$password = "root";
$db_database = "antennew";

$con=mysqli_connect($nomehost, $nomeuser, $password, $db_database);
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM anagrafiche");

if (!$result) {
	die(mysqli_error($con));
}

while($row = mysqli_fetch_array($result)) {
	if (($row['lat'] == '0') or ($row['lat'] == NULL)) {
		$lat = 0;
		$lon = 0;

		$address =  $row['indirizzo1'] . " " . $row['indirizzo2'] . ", " . $row['citta'] . " (" . $row['provincia'] .")\n";
		//echo $address." <br>";
		$encoding_address = urlencode($address);
		$GoogleAPI = 'http://maps.google.com/maps/api/geocode/xml?address='.$encoding_address.'&sensor=false';

		$XMLresult = file_get_contents($GoogleAPI);

		$XMLobject = new SimpleXMLElement($XMLresult);
		if($XMLobject->status=='OK'){
			$lat = $XMLobject->result->geometry->location->lat;
			$lon = $XMLobject->result->geometry->location->lng;
		}
		else{	
			echo "on trovato indirizzo completo. provo con il nome paese.\n";
			$address =  $row['citta'] ;
			$encoding_address = urlencode($address);
			$GoogleAPI = 'http://maps.google.com/maps/api/geocode/xml?address='.$encoding_address.'&sensor=false';

			$XMLresult = file_get_contents($GoogleAPI);

			$XMLobject = new SimpleXMLElement($XMLresult);
			if($XMLobject->status=='OK'){
				$lat = $XMLobject->result->geometry->location->lat;
				$lon = $XMLobject->result->geometry->location->lng;
			}			
		}

		mysqli_query($con,"UPDATE anagrafiche SET lat=".$lat.", lon=".$lon." WHERE id='".$row['id']."'");
	}
}

mysqli_close($con);

?>








