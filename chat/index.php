
/*

This is the main page for the chat application. It given a username and chat room,
users can chat by entering text. Possible changes  include using a text file to store 
the chat, or using shared memory. For the database, processing of added entries needs 
to be improved, in particular to support non-ascii characters, formatting and emoji.
Also need to remove debug messages.
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

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>name</th><th>message</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
} 

$servername = "localhost";
$username = "mychatuser";
$password = "SQd9yqNcgLAk28Yq";
$dbname = "mychatDB";

// define variables and set to empty values
$comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $comment = test_input($_POST["comment"]);
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
  <br>
  Comment: <input name="comment" rows="5" cols="40">
  <input type="submit" value="Submit"> 
  <br>
</form>

<script>
 document.getElementById("myChat").onsubmit = function()
 {myFunction()};

</script>

<?php
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO " . $_SESSION["chat"] . "(name, message) VALUES ( '" . $_SESSION["name"] . "', '" .$comment . "')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully by " .$_SESSION["name"] . " with message " . $comment . "<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT name, message  FROM " . $_SESSION["chat"]);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>"; 


?>

<a href="http://ip.address/endchat/index.php">click to exit</a>

</body>
</html>
