<?php
include 'databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO userlogin (username, email, password) VALUES (?, ?, ?)");

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <p class="title">Welcome To Registration Page</p>
            <form class="form" method="post" action="SignUp.php">
                <input type="text" class="input" placeholder="Username" name="username" required>
                <input type="email" class="input" placeholder="Email" name="email" required>
                <input type="password" class="input" placeholder="Password" name="password" required>
                <p class="page-link">
                    <span class="page-link-label">Forgot Password?</span>
                </p>
                <button type="submit" name="signup" value="signup" class="form-btn">Sign Up</button>
                <a href="login.php" style="text-decoration:none;color:white" class="form-btn"><span>Back</span></a>
            </form>
        </div>
    </div>
</body>

</html>
