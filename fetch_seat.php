<?php
include 'server.php';

$query = "SELECT id, available_seats FROM events";
$result = mysqli_query($db, $query);

$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}

echo json_encode($events); // Convert to JSON format for AJAX
?>
