<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'databaseConnection.php'; // Include database connection

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Prepare and execute the query
            $stmt = $conn->prepare("SELECT password FROM userlogin WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                // Verify password
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set session variables or redirect
                    session_start();
                    $_SESSION['email'] = $email;
                    header('Location: table.php'); // Redirect to a dashboard or home page
                    exit();
                } else {
                    echo "Invalid email or password.";
                }
            } else {
                echo "Invalid email or password.";
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>

    <div class="container">
        <div class="form-container contain">
            <p class="title">Welcome</p>
            <form class="form" action="login.php" method="post">
                <input type="email" class="input" name="email" placeholder="Email" required>
                <input type="password" class="input" name="password" placeholder="Password" required>
                <button type="submit" class="form-btn">Login</button>
                <a class="form-btn" href="SignUp.php"><span>Sign Up</span></a>
            </form>
        </div>
    </div>
</body>

</html>
