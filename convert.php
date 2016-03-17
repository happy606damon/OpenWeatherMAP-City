<?php
	//Getting city.list.us.json into the database
	function test($claim, $message) {
		if($claim) {
			return true;
		} else {
			die($message);
		}
	};
	$myfile = fopen("city.list.us.json", "r");
	$db = new PDO("mysql:host=localhost;dbname=weather;charset=utf8", "root", "root");
	while(!feof($myfile)) {
		$someJSON = fgets($myfile);
		$someArray = json_decode($someJSON, true);
		// print_r($someArray);
		$city_id = $someArray["_id"];
		$name = $someArray["name"];
		$lon = $someArray["coord"]['lon'];
		$lat = $someArray["coord"]['lat'];
		$statement = $db->prepare("INSERT INTO `cities` (`id`,`city_id`,`name`,`lon`,`lat`) VALUES (NULL, :city_id, :name, :lon, :lat)");
		$statement->bindParam(":city_id", $city_id);
		$statement->bindParam(":name", $name);
		$statement->bindParam(":lon", $lon);
		$statement->bindParam(":lat", $lat);
		$statement->execute();
	}

?>