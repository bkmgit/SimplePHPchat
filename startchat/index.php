/*

This is the entry page to the chat application. It gets a username and chat room,
then creates a table for the chatroom in the database if that table does not already
exist. Once the room is created, one can go to the chat page. Possible changes 
include using a text file to store the chat, or using shared memory. For the database,
processing of added entries needs to be improved.

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
// define variables and set to empty values
$_SESSION["name"] = $_SESSION["chat"] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION["name"] = test_input($_POST["name"]);
  $_SESSION["chat"] = test_input($_POST["chat"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<h2>PHP Chat Example</h2>
<form id="myChat" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <br><br>
  Chat: <input type="text" name="chat">
  <input type="submit" value="Submit"> 
</form>

<script>
 document.getElementById("myChat").onsubmit = function()
 {myFunction()};

</script>

<?php
if( ($_SESSION["name"] != "")&& ($_SESSION["chat"] != "")){
echo "<h2>The chat:</h2>";
echo $_SESSION["name"] . "<br>";
echo $_SESSION["chat"] . "<br>";

// create table if needed
 $servername = "localhost";
 $username = "mychatuser";
 $password = "mychatpasswd";

try {
    $conn = new PDO("mysql:host=$servername;dbname=mychatDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br>";
    $conn = null; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// Create table
try {
    $conn = new PDO("mysql:host=$servername;dbname=mychatDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS " . $_SESSION["chat"] . " (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    message VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table created successfully <br>";
    $conn = null;
    // Go to chat window
    header("Location:http://ip.address/chat/index.php");
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

}
?>

</body>
</html>
