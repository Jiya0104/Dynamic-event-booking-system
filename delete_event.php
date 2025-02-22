<?php 
include 'server.php'; // Database connection

// Check if admin is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: admin.php');
    exit();
}

// Check if event ID is provided
if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']); // Convert to integer to prevent SQL injection

    // Delete event query
    $query = "DELETE FROM events WHERE id = $event_id";
    if (mysqli_query($db, $query)) {
        $_SESSION['success'] = "Event deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting event: " . mysqli_error($db);
    }
}

// Redirect back to admin dashboard
header("Location: admin.php");
exit();
?>
