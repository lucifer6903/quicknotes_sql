
<?php
$text=$_POST['text'];
//connection
$conn=new mysqli('localhost','root','','note');
if ($conn->connect_error){
  die('connection fail:'.$conn->connect_error);
}
else{
$stmt =$conn->prepare("INSERT INTO notebook(text) VALUES(?)");
$stmt->bind_param("s",$text);
$stmt->execute();
echo "sucessfully ";
$stmt->close(); 
$conn->close();
}
?>

