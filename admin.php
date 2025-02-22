<?php 

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header("location: login.php");
    exit();
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
    exit();
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events from the database
$sql = "SELECT * FROM events ORDER BY date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #111; color: #fff; text-align: center; }
        .container { max-width: 900px; margin: 20px auto; padding: 20px; background: #222; border-radius: 8px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        table, th, td { border: 1px solid #444; padding: 10px; }
        th { background: #ffcc00; color: black; }
        td { background: #333; }
        .btn { padding: 8px 12px; color: white; text-decoration: none; border-radius: 5px; margin: 5px; display: inline-block; }
        .btn-add { background: #28a745; }
        .btn-delete { background: #dc3545; }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Dashboard</h2>
    <a href="add_event.php" class="btn btn-add">+ Add Event</a>
    <a href="logout.php" class="btn btn-delete">Logout</a>
    <h3>All Events</h3>

    <table>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Seats</th>
            <th>Actions</th>
        </tr>
        <?php
        include 'server.php';
        $query = "SELECT * FROM events";
        $result = mysqli_query($db, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['venue']) . "</td>";
            echo "<td id='seats_" . $row['id'] . "'>" . htmlspecialchars($row['available_seats']) . "</td>"; // Unique ID for AJAX update
            echo "<td><a href='delete_event.php?id=" . $row['id'] . "' class='btn btn-delete' onclick='return confirm(\"Are you sure?\");'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<!-- AJAX to update seat availability every 5 seconds -->
<script>
    function updateSeats() {
        $.ajax({
            url: 'fetch_seats.php', // Fetches updated seat availability
            type: 'GET',
            success: function(data) {
                let seatData = JSON.parse(data);
                seatData.forEach(event => {
                    $("#seats_" + event.id).text(event.available_seats); // Update seat count
                });
            }
        });
    }

    setInterval(updateSeats, 5000); // Auto-refresh seats every 5 seconds
</script>

</body>
</html>
