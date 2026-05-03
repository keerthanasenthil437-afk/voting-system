<?php 
session_start(); 
include 'db.php'; 
$id = $_POST['voter_id']; 
$q = "SELECT * FROM voter WHERE voter_id='$id'"; 
$res = $conn->query($q); 
if($res->num_rows > 0){ 
$_SESSION['voter'] = $id; 
header("Location: vote.php"); 
} else { 
echo "Invalid Voter!"; 
} 
?>