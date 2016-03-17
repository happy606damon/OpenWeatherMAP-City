<?php
	$city = $_POST['city'];

	$db = new PDO("mysql:host=localhost;dbname=weather;charset=utf8", "root", "root");

	$q = "SELECT DISTINCT `name`, `state`, `city_id` FROM `auto` WHERE `name` IS NOT NULL AND `name` LIKE '%$city%' OR `zipcode` LIKE '%$city%' ORDER BY `name`, `state`";

	$result = $db->query($q);
	
	$resultObj = $result->fetchall(PDO::FETCH_OBJ);

	echo json_encode($resultObj); 
?>