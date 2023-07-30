<!DOCTYPE html>
<html lang="en">

<head>
    <title>Faculty Data</title>
    <link rel="icon" type="image/x-icon" href="./img/faculty.png">
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
            width: 100%;
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
            background-color: #f2f2f2;
        }

        .details {
            display: none;
            background-color: #f9f9f9;
        }
        td{
            cursor: pointer;
        }
 
        tr.selected {
            background-color: #BDC1B7;
            cursor: pointer;
        }

        tr.selected td {
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>Faculty Name</th>
            <!-- <th>Number</th>
            <th>Address</th> -->
        </tr>
        <?php
        include 'authentication.php';
        require 'db_connect.php';
        $sql = "SELECT * FROM `faculty`";
        $result = mysqli_query($db_connection, $sql);
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr onclick="toggleDetails(' . $i . ')" id="row-' . $i . '">';
            echo '<td>' . $row['Name'] . '</td>';
            // echo '<td>' . $row['Number'] . '</td>';
            // echo '<td>' . $row['Address'] . '</td>';
            echo '</tr>';

            echo '<tr class="details" style="display: none;">';
            echo '<td colspan="3">';
            echo '<strong>Additional Details:</strong><br>';
            echo '<strong>Number:</strong> ' . $row['Number'] . '<br>';
            echo '<strong>Address:</strong> ' . $row['Address'] . '<br>';
    
            echo '</td>';
            echo '</tr>';
            $i++;
        }
        ?>
    </table>
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
    </script>
</body>

</html>