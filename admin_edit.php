<?php
include 'auth.php';
require 'db_connect.php';

if (isset($_GET['row_id'])) {
    $RowId = $_GET['row_id'];
    $query = "SELECT * FROM appointment where app_id='$RowId';";
    $executed = mysqli_query($db_connection, $query);
    if ($row = mysqli_fetch_assoc($executed)) {
        $facultyId = $row['Faculty_Id'];
        $subject = $row['Subject'];
        $timing = $row['Timing'];
        $stiming = $row['sTime'];
    } else {
        echo '<script>';
        echo 'alert("No data found");';
        echo 'window.location="show_app.php";';
        echo '</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Appointment</title>
    <style>
         body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
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
    </style>
</head>
<body>
    <div class="container">
    <h1>Edit Application</h1>
    <form action="admin_edit_data.php" method="POST" onsubmit="return validateDateTime();">
       <input type="hidden" name="id" value=<?php echo $RowId; ?> readonly>
        
        <label for="subject">Subject:</label>
        <input type="text" name="newsubject" value="<?php echo $subject; ?>"><br>
        <label for="timing">Date:</label>
            <?php
            $today = date("Y-m-d");
            $minDate = $today;
            if ($timing < $minDate) {
                $minDate = $timing;
            }
            ?>
            <input type="date" name="timing" value="<?php echo $timing; ?>" min="<?php echo $minDate; ?>"><br>
        <label for="timing">Time:</label>
        <input type="time" name="newstiming" id="Time" value="<?php echo $stiming; ?>"><br>
        <input type="submit" value="Save Changes">
    </form>
    </div>
    <script>
       function validateDateTime() {
            const selectedTime = document.getElementById('Time').value;
            const selectedDate = document.getElementsByName('timing')[0].value;
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
