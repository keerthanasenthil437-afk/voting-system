<?php 
include 'db.php'; 
?>
<link rel="stylesheet" href="style.css"> 
<div class="container"> 
<h2>       Election Results</h2> 
<?php 
$total_q = $conn->query("SELECT COUNT(*) as total FROM vote"); 
$total = $total_q->fetch_assoc()['total']; 
$q = "SELECT c.name, c.party, COUNT(v.voter_id) as votes 
FROM candidate c 
LEFT JOIN vote v ON c.candidate_id = v.candidate_id 
GROUP BY c.candidate_id"; 
$res = $conn->query($q); 
$maxVotes = 0; 
$winner = ""; 
$data = []; 
while($row = $res->fetch_assoc()){ 
$data[] = $row; 
if($row['votes'] > $maxVotes){ 
$maxVotes = $row['votes']; 
$winner = $row['name']; 
}} 
foreach($data as $row){ 
$votes = $row['votes']; 
$percent = ($total > 0) ? round(($votes/$total)*100) : 0; 
$width = $percent * 3; 
$color = ($row['name'] == $winner) ? "gold" : "green"; 
echo "<p><b>{$row['name']} ({$row['party']})</b> - $votes votes ($percent%)</p>"; 
echo "<div class='bar' style='width:{$width}px; background:$color'> 
$percent% 
</div>"; 
}echo "<h3>     Winner: $winner</h3>"; 
?> 
<br> 
<a href="index.php">    Back</a> 
</div> 
