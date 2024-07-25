<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <hr>
    <h1 style="text-align:center">User <span style="color:red">Data</span></h1>
    <hr>
    <table width="100%" class="table table-bordered">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'databaseConnection.php';

            $sql = "SELECT * FROM userlogin";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$sno}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['password']}</td>
                        </tr>";
                    $sno++;
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <hr>
    <div class="buttonflow">
        <!-- Form to trigger Excel export -->
        <form method="post" action="export.php">
            <button type="submit" name="export" class="form-btn">Export To Excel</button>
        </form>
        <button><a href="SignUp.php" class="buttonflow">Back</a></button>
    </div>
</body>

</html>