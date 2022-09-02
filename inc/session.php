<?php 
session_start();
include('inc/config.php');
if (isset($_SESSION['id'])) {


// session_start();
$user_check = $_SESSION['id'];

$ses_sql = mysqli_query($connect, "SELECT * FROM users WHERE id = '$user_check'");
$r = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$login_session = $r['id'];


$_SESSION['name'] = $r['name'];
		// $_SESSION['lastname'] = $row['lastname'];
$_SESSION['username'] = $r['username'];
		$login = $r['roles'];
$_SESSION['gender'] = $r['gender'];

 
$prv = mysqli_query($connect, "SELECT * FROM privileges WHERE role_id = '$login'");
$p =  mysqli_fetch_array($prv, MYSQLI_ASSOC);       


} 

#$c_ins = "INSERT INTO visitors (address, page, time, date) VALUES ('$ip', '$script', '$time', '$date')";
       
           # $set = mysqli_query($connect, $c_ins);

if (!isset($_SESSION['id'])) {
header("location:login.php");

}

     ?>