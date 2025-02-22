<?php
session_start();
include 'db_connect.php'; // Include database connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #111;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .events-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .event-card {
            border: 1px solid #444;
            padding: 15px;
            border-radius: 8px;
            background: #222;
            width: 300px;
        }
        .event-card h3 {
            color: #ffcc00;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn:hover {
            background: #218838;
        }
        .sold-out {
            color: red;
            font-weight: bold;
        }
        .navbar {
            background: #222;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h2>Event Booking System</h2>
    <div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a> | <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <h2>Upcoming Events</h2>
    <div class="events-container">

        <?php
        $sql = "SELECT * FROM events ORDER BY date ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event-card'>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
                echo "<p><strong>Venue:</strong> " . htmlspecialchars($row['venue']) . "</p>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<p><strong>Available Seats:</strong> " . $row['available_seats'] . "</p>";

                if ($row['available_seats'] > 0) {
                    echo "<a href='book_event.php?event_id=" . $row['id'] . "' class='btn'>Book Now</a>";
                } else {
                    echo "<p class='sold-out'>Sold Out</p>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No events available.</p>";
        }

        $conn->close();
        ?>

    </div>
</div>

</body>
</html>
