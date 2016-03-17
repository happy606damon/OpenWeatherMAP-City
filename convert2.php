<?php
	//Merging two tables into one
	//Matched up tables by long and lat
	function test($claim, $message) {
		if($claim) {
			return true;
		} else {
			die($message);
		}
	};

	$db = new PDO("mysql:host=localhost;dbname=weather;charset=utf8", "root", "root");
	$q = "SELECT `cities`.`name`, `cities`.`city_id`, `zips`.`zip`, `zips`.`state`
		FROM `cities`, `zips`
		WHERE `cities`.`lat` = `zips`.`lat`
		AND `cities`.`lon` = `zips`.`lng`
		AND `cities`.`name` = `zips`.`city`";
	$result = $db->query($q);
	$resultObj = $result->fetchall(PDO::FETCH_OBJ);

	foreach($resultObj as $auto){
		$name = $auto->name;
		$city_id = $auto->city_id;
		$zipcode = $auto->zip;
		if($zipcode < 10000) {
			$zipcode = "0" . strval($zipcode);
		}
		$state = $auto->state;
		$statement = $db->prepare("INSERT INTO `auto` (`id`,`name`,`city_id`,`zipcode`,`state`) VALUES (NULL, :name, :city_id, :zipcode, :state)");
		$statement->bindParam(":name", $name);
		$statement->bindParam(":city_id", $city_id);
		$statement->bindParam(":zipcode", $zipcode);
		$statement->bindParam(":state", $state);
		$statement->execute();
	};

?>