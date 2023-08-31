<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="./img/admin.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    .profile-link {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav {
        background-color: #333;
        overflow: hidden;
    }

    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #04AA6D;
        color: black;
    }

    .topnav-right {
        float: right;
    }

    .chart-container {
        display: flex;
        flex-direction: row-reverse;
        align-items: flex-end;
        margin-right: 20px;
    }

    .chart {
        width: 300px;
        height: 300px;
        margin-bottom: 50px;
    }

    .container {
        display: flex;
        margin-top: 20px;

    }

    .task-card {
        flex: 1;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        text-align: center;
        color: #333;
        transition: background-color 0.3s, transform 0.3s;
        margin-right: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);

    }

    .task-card:hover {
        background-color: #f0f0f0;
    }

    .task-card h3 {
        margin-top: 0;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .task-card p {
        font-size: 16px;
        margin-bottom: 0;
    }

    .task-card a {
        text-decoration: none;
    }

    .charts-and-cards {
        flex: 2;
        display: flex;
        flex-direction: column;
    }

    .additional-cards {
        display: flex;
        flex-direction: column;
    }
    </style>
</head>

<body>
    <?php include "auth.php";
    include 'db_connect.php'; ?>
    <div class="topnav">
        <a href="./f_admin_view.php">Faculty Members</a>
        <a href="./std_view.php">Student Details</a>
        <a href="./admin_app_details.php">Appointment Details</a>
        <div class="topnav-right">
            <div class="profile-link">


                <?php 
                $sql = "SELECT Name from `faculty` where Email = '" . $_SESSION['email'] . "';";
                $result = mysqli_query($db_connection, $sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $name = $row['Name'];
                }
            echo $name; ?>
            </div>
            <a href="./logout_admin.php" class="logout-link">Log Out</a>
        </div>
    </div>

    <div class="container">
        <div class="task-card">
            <a href="./f_admin_view.php" class="widget card">
                <h3>Faculty Details</h3>
                <p>View and manage faculty members' information.</p>
            </a>
        </div>
        <div class="task-card">
            <a href="./std_view.php" class="widget card">
                <h3>Student Details</h3>
                <p>Access and manage student details.</p>
            </a>
        </div>
        <div class="task-card">
            <a href="./admin_app_details.php" class="widget card">
                <h3>Appointment Details</h3>
                <p>See appointment information and manage appointments.</p>
            </a>
        </div>
        <div class="charts-and-cards">
            <div class="chart-container">
                <div class="chart">
                    <canvas id="acceptedAppointmentsChart" width="150" height="150"></canvas>
                </div>
                <div class="chart">
                    <canvas id="attendanceChart" width="150" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>



    <script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php
        $sql = "SELECT COUNT(*) AS totalAppointments,
                       SUM(CASE WHEN Status = 'Accepted' THEN 1 ELSE 0 END) AS acceptedAppointments,
                       SUM(CASE WHEN Status = 'Declined' THEN 1 ELSE 0 END) AS declinedAppointments
                FROM appointment
                WHERE Faculty_Id = (SELECT Id FROM faculty WHERE Email = '" . $_SESSION['email'] . "');";
        $result = mysqli_query($db_connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $totalAppointments = $row['totalAppointments'];
        $acceptedAppointments = $row['acceptedAppointments'];
        $declinedAppointments = $row['declinedAppointments'];

        $pendingAppointments = $totalAppointments - $acceptedAppointments - $declinedAppointments;
    ?>
        var acceptedAppointmentsChart = new Chart(document.getElementById("acceptedAppointmentsChart"), {
            type: 'pie',
            data: {
                labels: ['Accepted', 'Rejected', 'Pending'],
                datasets: [{
                    data: [<?php echo $acceptedAppointments; ?>,
                        <?php echo $declinedAppointments; ?>,
                        <?php echo $pendingAppointments; ?>
                    ],
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56']
                }]
            }
        });
        <?php
$sql = "SELECT COUNT(*) AS totalAppointments,
               SUM(CASE WHEN attendance = 'Present' THEN 1 ELSE 0 END) AS presentAppointments,
               SUM(CASE WHEN attendance = 'Absent' THEN 1 ELSE 0 END) AS absentAppointments
        FROM appointment
        WHERE Status = 'Accepted'
        AND Faculty_Id = (SELECT Id FROM faculty WHERE Email = '" . $_SESSION['email'] . "');";
$result = mysqli_query($db_connection, $sql);
$row = mysqli_fetch_assoc($result);
$totalAppointments = $row['totalAppointments'];
$presentAppointments = $row['presentAppointments'];
$absentAppointments = $row['absentAppointments'];

?>
        var attendanceChart = new Chart(document.getElementById("attendanceChart"), {
            type: 'pie',
            data: {
                labels: ['Present', 'Absent'],
                datasets: [{
                    data: [<?php echo $presentAppointments; ?>,
                    <?php echo ($totalAppointments - $presentAppointments); ?>
                    ],
                    backgroundColor: ['#4CAF50', '#FF6384']
                }]
            }
        });
    });
    </script>

</body>

</html>