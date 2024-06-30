<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', 0);
?>
<form action="show.php" method="get">
<button name="delete_all">delete_all</button>
<button name="return">return</button><br><br>
<input type="number" placeholder="enter the id" name="idfordelete"><br>
<textarea name="update" placeholder="enter your update text"></textarea><br>
<button name="updateid"> click to update</button>
<button name="deleteid">click to delete</button> <br>
<input type="checkbox" placeholder="confirm " name="confirmationbox"> confirm that you want to update or delete according to above detail
</form>
<?php

// Database connection parameters

// Create connection
$conn=new mysqli('localhost','root','','note');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve entries from the database
$sql = "SELECT * FROM notebook" ;
$result = $conn->query($sql);
$confirmation= $_GET['confirmationbox'];
if(isset($_GET['delete_all'])) {
    $sql = "DELETE FROM notebook";
    if ($conn->query($sql) === TRUE) {
        echo "<p>All entries deleted successfully.</p>";
        header("refresh:2;url=/note/main.html");
        $sql_reset = "ALTER TABLE notebook AUTO_INCREMENT = 1";
        if($conn->query($sql_reset)==true){
            echo "reset complete ";
        }

    }                               
}
if(isset($_GET['deleteid'])) {
    if(isset($confirmation)==true){
        $idd = $_GET['idfordelete'];
        $sql = "DELETE FROM notebook where id = $idd";
        header("refresh:1;url=/note/show.php");
        if ($conn->query($sql) === TRUE) {
            echo "<p> entrie is deleted successfully.</p>";
    }                               
}
}
if(isset($_GET['updateid'])) {
    if(isset($confirmation)==true){
        $idd = $_GET['idfordelete'];
        $update = $_GET['update'];
        $sql = "UPDATE notebook SET text='$update' where id=$idd ";
        header("refresh:1;url=/note/show.php");
        if ($conn->query($sql) === TRUE) {
            echo "<p> entrie is update successfully.</p>"; 
        }                               
}
}




   // $idd=$_GET['id'];
    // $sql = "DELETE FROM notebook where id=$idd";
    // if ($conn->query($sql) === TRUE) {
    //     echo "<p> entrie is deleted successfully.</p>";
    // }

if(isset($_GET['return'])){
    header(("refresh:2;url=/note/main.html"));
    echo "your going to main page.";
}
 
// Check if entries exist
if ($result->num_rows > 0) {
    // Output data of each row
    echo"<style>
    table {
        border-collapse: collapse;
        width: 50%;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {  
        background-color: #f2f2f2;
    }
  </style>";
    echo "<h2>All Entries:</h2>";
    echo "<table><tr><th>ID</th><th>text</th><th>time</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["text"]."</td><td>".$row["time"];
    }
    echo "</table>";
}




else {
    echo "No entries found.";
}

// Close connection
$conn->close();
?>