<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="./img/admin.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #4CAF50;
            color: white;
        }

        .navbar a.active {
            background-color: #4CAF50;
            color: white;
        }

        .navbar {
            display: flex;
            justify-content: center;
        }

        .navbar a {
            margin: 0 10px;
        }


        .navbar a.active {
            border-bottom: 2px solid white;
        }

        @media screen and (max-width: 600px) {
            .navbar {
                flex-direction: column;
            }

            .navbar a {
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <?php include "authentication.php";
    include 'db_connect.php'; ?>
    <!-- Navbar -->
    <div class="navbar">
        <a href="./appointment.php">Book Appointment</a>
        <a href="./f_view.php">Faculty Members</a>
        <a href="./std_view.php">Student Details</a>
        <a href="./show_app.php">Appointment Details</a>
        <a href="./logout.php">Log Out</a>
    </div>
    <?php
    $sql = "SELECT Name from `user_registration` where Roll = '" . $_SESSION['roll'] . "';";
    $result = mysqli_query($db_connection, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
    }
    ?>
    <h1>Welcome
        <?php echo $name . "<br>Roll Number: (" . $_SESSION['roll'] . ")"; ?>
    </h1>


</body>

</html>