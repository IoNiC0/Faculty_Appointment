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

        /* tr.selected td {
            font-weight: bold;
        } */
        .edit-icon,
        .delete-icon {
            cursor: pointer;
            font-size: 18px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <table>
            <tr>
                <th>Faculty Name</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            include 'authentication.php';
            require 'db_connect.php';
            $sql = "SELECT u.Name, f.Name AS faculty_name, a.subject, a.Timing,a.sTime,a.Status,a.app_id, u.email AS student_roll
                FROM user_registration u
                JOIN appointment a ON u.email = a.email
                JOIN faculty f ON a.Faculty_Id = f.Id
                WHERE u.email = '" . $_SESSION['semail'] . "';";
            $result = mysqli_query($db_connection, $sql);
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['app_id'];
                date_default_timezone_set('Asia/Kolkata');
                $appointmentDateTime = $row['Timing'] . ' ' . $row['sTime'];
                $currentDateTime = date('Y-m-d H:i:s');
                if ($appointmentDateTime >= $currentDateTime) {
                    echo '<tr onclick="toggleDetails(' . $i . ')" id="row-' . $i . '">';
                    echo '<td>' . $row['faculty_name'] . '</td>';
                    echo '<td>' . $row['Status'] . '</td>';
                    echo "&nbsp"."&nbsp"."&nbsp";
                    echo '<td><a href="edit.php?row_id=' . $id . '" class="edit-icon"><i class="fas fa-edit"></i></a></td>';
                    echo '<td><a href="dlt_app.php?row_id=' . $id . '" class="delete-icon"><i class="fas fa-trash"></i></a></td>';
                    echo '</tr>';
                    echo '<tr class="details" style="display: none;">';
                    echo '<td colspan="5">';
                    echo '<strong>Additional Details:</strong><br>';
                    echo '<strong>Student Name:</strong> ' . $row['Name'] . '<br>';
                    echo '<strong>Appointment Id:</strong> ' . $row['app_id'] . '<br>';
                    echo '<strong>Email:</strong> ' . $row['student_roll'] . '<br>';
                    echo '<strong>Subject:</strong> ' . $row['subject'] . '<br>';
                    echo '<strong>Date:</strong> ' . $row['Timing'] . '<br>';
                    echo '<strong>Time:</strong> ' . $row['sTime'] . '<br>';
                    echo '</td>';
                    echo '</tr>';
                } else {
                    // $deleteQuery = "DELETE FROM appointment WHERE Std_Id='$id';";
                    // mysqli_query($db_connection, $deleteQuery);
                }
                $i++;
            }
            ?>
        </table>
    </div>
    <br><br>
    <div class="form-group">
        <a href='./admin.php'>
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
        document.addEventListener("DOMContentLoaded", function () {
            const editIcons = document.querySelectorAll(".edit-icon");
            const deleteIcons = document.querySelectorAll(".delete-icon");

            editIcons.forEach(icon => {
                icon.addEventListener("click", function (event) {
                    event.stopPropagation();
                });
            });

            deleteIcons.forEach(icon => {
                icon.addEventListener("click", function (event) {
                    event.stopPropagation();
                    if (!confirm("Are you sure you want to delete this appointment?")) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
</body>

</html>