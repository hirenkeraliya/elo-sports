<?php
// Check if status send.

$servername = "localhost";
$username = "elo_db_user_dev";
$password = "TeH_5Kt&I6Dt";
$dbname = "elo_sports_laravel_dev";
$status = isset( $_GET['status'] ) ? $_GET['status'] : false;
$elo_amount = isset($_GET[ 'elo_amount']) ? $_GET['elo_amount'] : 0;
$transaction_id = isset( $_GET['transaction_id']) ? $_GET['transaction_id'] : 0;
$usd_amount = isset( $_GET['usd_amount']) ? $_GET['usd_amount'] : 0;
$user_name = isset( $_GET['user_name']) ? $_GET['user_name'] : 0;

echo "username : ".$user_name;
echo "posts:".json_encode($_GET)."<br>";
echo "status:".$status."<br>";
echo "elo_amount:".$elo_amount."<br>";
echo "transaction_id:".$transaction_id."<br>";
echo "usd_amount:".$usd_amount."<br>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  
}


$sql = "INSERT INTO deposite (username,elo_amount, usd_amount, transaction_id,status,created_at,updated_at)
VALUES ('".$user_name."','".$elo_amount."', ".$usd_amount.", '".$transaction_id."','".$status."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";


if ($conn->query($sql) === TRUE) {

       if($status == 'COMPLETED'){
              $sql_update = "UPDATE user SET Elo_balance = elo_balance + $elo_amount WHERE Username = '".$user_name."'";
              $conn->query($sql_update);
              echo "Payment is successfully completed.";
       }
    else
              echo "Payment is on hold.";
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error . "<br>" . $_GET;
}

$conn->close();




// Check the value of status
if ( $status === 'COMPLETED' ) {


}

?>
