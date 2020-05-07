<?php

require("connect_db.php");

header('Access-Control-Allow-Origin: http://localhost:4200');
// header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');


// get the size of incoming data
$content_length = (int) $_SERVER['CONTENT_LENGTH'];




// retrieve data from the request
$postdata = file_get_contents("php://input");



// Process data
// (this example simply extracts the data and restructures them back)




// Extract json format to PHP array
$request = json_decode($postdata);




$data = [];
$data[0]['length'] = $content_length;

foreach($request as $k => $v) 
{
	$data[0]['post_'.$k] = $v;
}




$username = "momo";
$date = $data[0]["post_date"];
$startTime = $data[0]["post_startTime"];
$endTime = $data[0]["post_endTime"];
$aptNote = $data[0]["post_aptNote"];
$booked = $data[0]["post_booked"];
$bookedBy = $data[0]["post_bookedBy"];





add_apt($username, $date, $startTime, $endTime, $aptNote, $booked, $bookedBy);

echo json_encode(['content'=>$data]);


function add_apt($username, $date, $startTime, $endTime, $aptNote, $booked, $bookedBy) {
	global $db;
	$query = "INSERT INTO appointment (username, apt_date, start_time, end_time, note, booked, bookedBy) VALUES(:username, :date, :startTime, :endTime, :aptNote, :booked, :bookedBy)";

	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);

	$statement->bindValue(':date', $date);
	$statement->bindValue(':startTime', $startTime);
	$statement->bindValue(':endTime', $endTime);
	$statement->bindValue(':aptNote', $aptNote);
	$statement->bindValue(':booked', $booked);
	$statement->bindValue(':bookedBy', $bookedBy);

	$statement->execute();
	$statement->closeCursor();

}

?>

