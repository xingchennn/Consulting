<?php


$host = 'localhost:3306';     
$dbname = 'consulting';    

// database credentials
$username = 'xingchennn';
$password = 'Lxcbww--19950406';

$dsn = "mysql:host=$host;dbname=$dbname";
$db = "";

try 
{
   $db = new PDO($dsn, $username, $password);   
   // echo "<p>You are connected to the database</p>";
}
catch (PDOException $e)     
{
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

?>