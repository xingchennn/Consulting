<?php
require("connect_db.php");


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    // get all the mentors information and list them in the list page
   $mentors = getAllMentors();
   include('list.php');       
}
?>


<?php


    function getAllMentors() {
        global $db;
        $query = "SELECT * FROM mentor";
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closecursor(); 
        return $results;

    }

?>