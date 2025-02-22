<?php
include 'project.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

if ($event_id <= 0) {
    die("Invalid event.");
}

// Check if user has already booked this event
$check_sql = "SELECT * FROM bookings WHERE user_id = ? AND event_id = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("ii", $user_id, $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("You have already booked this event.");
}

// Check available seats
$seat_sql = "SELECT available_seats FROM events WHERE id = ?";
$stmt = $conn->prepare($seat_sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['available_seats'] <= 0) {
    die("This event is sold out.");
}

// Book event
$book_sql = "INSERT INTO bookings (user_id, event_id, booking_date) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($book_sql);
$stmt->bind_param("ii", $user_id, $event_id);
$stmt->execute();

// Decrease seat count
$update_sql = "UPDATE events SET available_seats = available_seats - 1 WHERE id = ?";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();

echo "Booking successful! <a href='event.php'>Go back</a>";
?>
