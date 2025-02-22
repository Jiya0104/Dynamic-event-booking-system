<?php 
include ('server.php'); // Connect to the database

// Check if admin is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: admin.php');
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $venue = mysqli_real_escape_string($db, $_POST['venue']);
    $seats = intval($_POST['seats']); // Convert to integer

    // Insert event into the database
    $query = "INSERT INTO events (title, date, venue, available_seats) VALUES ('$title', '$date', '$venue', '$seats')";
    if (mysqli_query($db, $query)) {
        $_SESSION['success'] = "Event added successfully!";
        header("Location: admin.php"); // Redirect back to admin dashboard
        exit();
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <style>
        body { font-family: Arial, sans-serif; background: #111; color: #fff; text-align: center; }
        .container { max-width: 500px; margin: 50px auto; padding: 20px; background: #222; border-radius: 8px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background: #218838; }
        a { color: #ffcc00; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Event</h2>
    <form action="add_event.php" method="post">
        <input type="text" name="title" placeholder="Event Title" required>
        <input type="date" name="date" required>
        <input type="text" name="venue" placeholder="Venue" required>
        <input type="number" name="seats" placeholder="Available Seats" required>
        <button type="submit">Add Event</button>
    </form>
    <a href="admin.php">Back to Dashboard</a>
</div>

</body>
</html>
