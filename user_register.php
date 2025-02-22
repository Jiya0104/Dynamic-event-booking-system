<?php
include 'server.php'; // Ensure correct database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email is already registered
    $check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $db->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists! Please use another email.";
    } else {
        // Hash password before storing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into the database
        $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $db->prepare($insert_query);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            // Redirect to sign_in.html after successful registration
            header("Location: sign_in.html");
            exit();
        } else {
            echo "Registration failed. Please try again.";
        }
    }
}
?>
