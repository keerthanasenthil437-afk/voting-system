<?php 
session_start(); 
include 'db.php'; 
if(!isset($_SESSION['voter'])){ 
header("Location: index.php"); 
} 
$voter = $_SESSION['voter']; 
$election = 1; 
$check = $conn->query("SELECT * FROM vote WHERE voter_id='$voter' AND 
election_id='$election'"); 
if($check->num_rows > 0){ 
echo "<h3>    You already voted!</h3>"; 
echo "<a href='result.php'>View Results</a>"; 
 exit(); 
} 
?> 
<link rel="stylesheet" href="style.css"> 
<div class="container"> 
<h2>Choose Your Candidate</h2> 
<form method="post"> 
<?php 
$res = $conn->query("SELECT * FROM candidate"); 
while($row = $res->fetch_assoc()){ 
 echo "<input type='radio' name='cid' value='{$row['candidate_id']}' required> 
 {$row['name']} ({$row['party']})<br>"; 
} 
?> 
<br> 
<button name="vote">Submit Vote</button> 
</form> 
</div> 
<?php 
if(isset($_POST['vote'])){ 
 $cid = $_POST['cid']; 
 $conn->query("INSERT INTO vote VALUES('$voter','$cid','$election')"); 
 echo "<script>alert('    Vote Submitted Successfully!');</script>"; 
 echo "<script>window.location='result.php';</script>"; 
} 
?> 