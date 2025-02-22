<?php
include 'project.php';

header('Content-Type: application/json');

$sql = "SELECT id, title, city, date, available_seats FROM events ORDER BY date ASC";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
?>
