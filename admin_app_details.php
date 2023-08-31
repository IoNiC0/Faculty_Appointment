<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment Details</title>
    <link rel="icon" type="image/x-icon" href="./img/2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;

    }

    .form-group {
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        justify-content: center;
    }

    .form-group select[name="export_file"],
    .form-group button#exportButton {
        padding: 6px;
        font-size: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-left: 10px;
    }

    .form-group input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        display: block;
        margin: 0 auto;
        transition: background-color 0.3s ease;
    }

    .form-group input[type="submit"]:hover {
        background-color: #3e8e41;
    }

    table {
        width: 60%;
        margin: 0 auto;

        border-collapse: collapse;
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #ccc;
    }

    th.highlight {
        background-color: #E3E6DE;
    }


    .details {
        display: none;
        background-color: #f9f9f9;
    }


    tr.selected {
        background-color: #f9f9f9;
        cursor: pointer;
    }

    .edit-icon,
    .delete-icon {
        cursor: pointer;
        font-size: 18px;
        margin-right: 10px;
    }

    .form-group button#exportButton:hover {
        background-color: #b4b4b4;
    }
    </style>
</head>

<body>
    <div class="table-container">
        <h2 style="text-align: center;">Appointment Details</h2>
        <div class="form-group">
            <form action="export.php" method="POST">
                <select name="export_file" required>
                    <option value="">-- Select One Option --</option>
                    <option value="xlsx">xlsx</option>
                    <option value="csv">csv</option>
                </select>
                <button id="exportButton" name="export-btn" type="submit">Export</button>
            </form>
        </div>
        <table>
            <tr>
                <th>Student Name</th>
                <th>Edit</th>
                <th>Accept</th>
                <th>Decline</th>
                <th>Present</th>
                <th>Absent</th>
            </tr>
            <?php
            include 'auth.php';
            require 'db_connect.php';
            date_default_timezone_set('Asia/Kolkata');
            $sql = "SELECT u.Name, f.Name AS faculty_name, a.subject, a.Timing,a.sTime,a.Status,a.attendance,a.app_id, u.email AS student_roll
                FROM user_registration u
                JOIN appointment a ON u.email = a.email
                JOIN faculty f ON a.Faculty_Id = f.Id
                WHERE f.Email = '" . $_SESSION['email'] . "';";
            $result = mysqli_query($db_connection, $sql);
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['app_id'];
                if ($row['Status'] === "Pending") {
                    $currentDateTime = date("Y-m-d H:i:s");
                    $appointmentDateTime = $row['Timing'] . ' ' . $row['sTime'];
                    if ($appointmentDateTime < $currentDateTime) {
                        $declineSql = "UPDATE appointment SET Status = 'Declined' WHERE app_id = $id" ;
                        mysqli_query($db_connection, $declineSql);
                        $row['Status'] = "Declined";
                    }
                }
                echo '<tr onclick="toggleDetails(' . $i . ')" id="row-' . $i . '">';
                echo '<td>' . $row['Name'] . '</td>';
                echo '<td><a href="admin_edit.php?row_id=' . $id . '" class="edit-icon" target="_blank"><i class="fas fa-edit"></i></a></td>';
                if ($row['Status'] === "Accepted") {
                    echo '<td><i class="fas fa-check-circle"></i> Accepted</td>';
                    echo '<td></td>';
                    
                    if ($row['attendance'] === "Present") {
                        echo '<td><i class="fas fa-check"></i> Present</td>';
                        echo '<td></td>';
                    } else if ($row['attendance'] === "Absent") {
                        echo '<td></td>';
                        echo '<td><i class="fas fa-times"></i> Absent</td>';
                    } else {
                        echo '<td><button onclick="markPresent(' . $id . ')"><i class="fas fa-check"></i></button></td>';
                        echo '<td><button onclick="markAbsent(' . $id . ')"><i class="fas fa-times"></i></button></td>';
                    }
                }
             else if ($row['Status'] === "Declined") {
                    echo '<td></td>';
                    echo '<td><i class="fas fa-times-circle"></i> Declined</td>';
                } 
              
                else {
                    echo '<td><button onclick="acceptAppointment(' . $id . ')"><i class="fas fa-check"></i></button></td>';
                    echo '<td><button onclick="declineAppointment(' . $id . ')"><i class="fas fa-times"></i></button></td>';
                }
               
                echo '</tr>';
                echo '<tr class="details" style="display: none;">';
                echo '<td colspan="5">';
                echo '<strong>Additional Details:</strong><br>';
                echo '<strong>Appointment Id:</strong> ' . $row['app_id'] . '<br>';
                echo '<strong>Roll:</strong> ' . $row['student_roll'] . '<br>';
                echo '<strong>Subject:</strong> ' . $row['subject'] . '<br>';
                echo '<strong>Date:</strong> ' . $row['Timing'] . '<br>';
                echo '<strong>Time:</strong> ' . $row['sTime'] . '<br>';
                echo '</td>';
                echo '</tr>';
                $i++;
            }
            ?>
        </table>
    </div>
    <br><br>
    <div class="form-group">
        <a href='./panel.php'>
            <input type="submit" value="Back">
        </a>

    </div>

    <script>
    function toggleDetails(rowId) {
        const row = document.getElementById("row-" + rowId);
        const detailsRow = row.nextElementSibling;
        const isVisible = detailsRow.style.display === "table-row";
        detailsRow.style.display = isVisible ? "none" : "table-row";

        const rows = document.getElementsByTagName("tr");
        for (let i = 0; i < rows.length; i++) {
            rows[i].classList.remove("selected");
        }

        row.classList.add("selected");
    }

    function acceptAppointment(appointmentId) {
        window.location.href = "accept_appointment.php?appointment_id=" + encodeURIComponent(appointmentId);
    }

    function declineAppointment(appointmentId) {
        window.location.href = "decline_appointment.php?appointment_id=" + encodeURIComponent(appointmentId);
    }

    function markAbsent(appointmentId) {
        window.location.href = "absent.php?appointment_id=" + encodeURIComponent(appointmentId);
    }

    function markPresent(appointmentId) {
        window.location.href = "present.php?appointment_id=" + encodeURIComponent(appointmentId);
    }
    </script>

</body>

</html>