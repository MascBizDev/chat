

<?php

$servername = "localhost";
$username = "root";
$password="";
$dbname="chat";

// create connection

$db = mysqli_connect($servername, $username, $password, $dbname);




if($db->connect_error){
    die("connection failed: " .$db->connect_error);
}

$result= array();
$message= isset($_POST['message']) ? $_POST['message'] : null;
$from =isset($_POST['from']) ? $_POST['from'] : null;


if(!empty($message) && !empty($from)){

    $sql= "INSERT INTO `chat`(`message`, `from`) VALUES ('.$message','.$from')";
    $result['send_status'] = $db->query($sql);

}

//print messages

$start= isset($_GET['start']) ? intval($_GET['start']) : 0;


$items = $db->query("SELECT * FROM `chat` WHERE `id` >" . $start);
//$row1=mysqli_fetch_assoc($items);
//echo $row1['id'];

while($row = $items->fetch_assoc()){
    $result['items'][]= $row;
}

$db->close();

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

echo json_encode($result);

?>