
/*

This is the closing page to the chat application. It should remove a user 
from the chat and if all users are removed close the database.

*/

<?php
session_start();
?>

<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php

$servername = "localhost";
$username = "mychatuser";
$password = "mychatpasswd";
$dbname = "myChat";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<h2>PHP Chat Example</h2>
  <br>
  Exiting chat! 
  <br>
</form>


<?php

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM ". $_SESSION["chat"] . "users WHERE id=" . $_SESSION["id"]; 
    // use exec() because no results are returned
    $conn->exec($sql);
    echo $sql . " User record deleted successfully <br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage() . "<br>";
    }
$conn = null;

echo " Finding number of users in chat <br>";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT * FROM " . $_SESSION["chat"] . "users" );
    $count = $stmt->rowCount();
    echo "Goodbye, there are " . $count . " users left in the chat. <br>";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage() . "<br>";
    }
$conn = null;


if ( $count == 0)
{
 echo " Deleting chat database since no users left <br>";
 try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "DROP TABLE IF EXISTS " . $_SESSION["chat"] . "users";
     $conn->exec($sql);
     echo "All chat users deleted. <br>";
     }
     catch(PDOException $e)
     {
     echo "Error: " . $e->getMessage() . "<br>";
     }
     $conn = null;
}


if ( $count == 0)
{
 echo " Deleting user database since no users left <br>";
 try 
 {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "DROP TABLE IF EXISTS " . $_SESSION["chat"];
     $conn->exec($sql);
     echo "Chat deleted. <br>";
 }
 catch(PDOException $e)
 {
 echo "Error: " . $e->getMessage() . "<br>";
 }
 $conn = null;
}


?>

</body>
</html>
