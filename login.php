<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>

	<style>
        body {
            background-image:url(background\ image.webp); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: rgba(26, 26, 26, 0.5); /* Increased transparency (0.5 opacity) */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(11, 231, 255, 0.2);
            width: 350px;
            text-align: center;
            backdrop-filter: blur(10px); /* Adds a blur effect to the background */
            border: 1px solid rgba(255, 255, 255, 0.1); /* Subtle border for depth */
        }
        .login-container h2 {
            color: #0be7ff;
            margin-bottom: 20px;
            font-size: 2rem;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #ccc;
            font-size: 0.9rem;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background-color: rgba(34, 34, 34, 0.7); /* Slightly more transparent input background */
            color: #ffffff;
            font-size: 1rem;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .input-group input:focus {
            outline: none;
            border-color: #0be7ff;
            box-shadow: 0px 0px 8px rgba(11, 231, 255, 0.6);
        }
        .btn {
            background-color: #0be7ff;
            border: none;
            color: #000;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            width: 100%;
            font-size: 1rem;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #05a5ad;
        }
        .footer-text {
            margin-top: 15px;
            color: #ccc;
            font-size: 0.9rem;
        }
        .footer-text a {
            color: #0be7ff;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }
        .footer-text a:hover {
            color: #05a5ad;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <?php include('errors.php'); ?>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="login_user">Login</button>
            </div>
            <p class="footer-text">
                Not yet a member? <a href="register.php">Sign up</a>
            </p>
        </form>
    </div>
</body>
</html>