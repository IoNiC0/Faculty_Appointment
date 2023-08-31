<?php
include('db_connect.php');


$facultyQuery = "SELECT Name FROM faculty";
$facultyResult = $db_connection->query($facultyQuery);

$facultyNames = [];
if ($facultyResult->num_rows > 0) {
    while ($row = $facultyResult->fetch_assoc()) {
        $facultyNames[] = $row['Name'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Form</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="icon" type="image/x-icon" href="./img/2.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            /* max-height: 650px; */
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        form {
            display: grid;
            gap: 20px;
        }

        label {
            font-size: 16px;
            font-weight: 700;
        }

        input, select {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
     
        .form-group input[type="submit"] {
            width: 30%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-group input[type="submit"] {
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            background-color: #3e8e41;
        }
         h3 {
            text-align: center;
            margin-bottom: 30px;
        }
        #faculty
{
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
#scheduleTime
{
    
    border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
            font-size: 16px;

}

    </style>
</head>
<body>
    <?php include 'authentication.php'; ?>
    <?php
    $sql = "SELECT Name from `user_registration` where email = '" . $_SESSION['semail'] . "';";
    $result = mysqli_query($db_connection, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
    }
    ?>
    <div class="container">
        <h1>Appointment Form</h1>
        <form action="process_appointment.php" method="post" autocomplete="off" onsubmit="return validateDateTime();">
            <label for="faculty">Faculty Name:</label>
            <select id="faculty" name="faculty" required>
                <?php

                foreach ($facultyNames as $faculty) {
                    echo "<option value='" . $faculty . "'>" . $faculty . "</option>";
                }
                ?>
            </select>
            <label for="scheduleTime">Schedule Date:</label>
            <?php
            $today = date("Y-m-d");
            echo '<input type="date" id="scheduleTime" name="scheduleTime" value="' . $today . '" min="' . $today . '" required>';
            ?>
            <label for="Time">Schedule Time:</label>
            <input type="time" id="Time" name="Time" value="<?php echo date('H:i'); ?>" required>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
            <div class="form-group">
                <input type="submit" value="Book Appointment">
            </div>
        </form>
        <br><br>
        <div class="form-group">
        <a href='./admin.php'>
            <input type="submit" value="Back" id="back-btn">
        </a>
    </div>
    </div>
    <script>
       function validateDateTime() {
            const selectedTime = document.getElementById('Time').value;
            const selectedDate = document.getElementById('scheduleTime').value;
            const now = new Date();
            const selectedDateTime = new Date(`${selectedDate}T${selectedTime}`);
            const todayDate = now.toISOString().split('T')[0];

            const startTime = new Date(`${selectedDate}T09:00`);
            const endTime = new Date(`${selectedDate}T18:00`);

            if (selectedDateTime < now) {
                alert('You cannot select a date and time in the past.');
                return false;
            }

            if (selectedDate === todayDate && now.getHours() >= 18) {
                alert('You cannot select a time after 6:00 PM for today.');
                return false;
            }

            if (selectedDateTime < startTime || selectedDateTime > endTime) {
                alert('Appointments are only available between 9 AM and 6 PM.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
