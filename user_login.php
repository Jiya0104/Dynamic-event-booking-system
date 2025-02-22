<?php
include 'server.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from database
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; 
            $_SESSION['email'] = $user['email'];

            // Redirect to index.html after login
            header("Location: index.html");
            exit();
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "No user found with that email!";
    }
}
?>
