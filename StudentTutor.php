<?php
session_start();

require_once('DBconnect.php');

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: Faculty_Dashboard.php");
    exit();
}

// Query to fetch all details for student tutors
$stQuery = "SELECT st.user_id, s.student_id, ui.name as student_name, st.assigned_course, st.assigned_section, f.name as faculty_name
            FROM student_tutor st
            JOIN student s ON st.user_id = s.user_id
            JOIN user_info ui ON st.user_id = ui.user_id
            JOIN user_info f ON st.assigned_under = f.user_id";
$stResult = mysqli_query($conn, $stQuery);
if (!$stResult) {
    die('SQL Error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Tutor List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding-top: 20px; background-color: #f8f9fa; }
        .dashboard { margin: auto; padding: 20px; max-width: 1000px; background-color: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container dashboard">
        <h1>Student Tutor List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Assigned Course</th>
                    <th>Assigned Section</th>
                    <th>Assigned Under</th>
                </tr>
            </thead>
            <tbody>
                <?php

                        echo "<tr>";
                        echo "<td>30123</td>";
                        echo "<td>22123423</td>";
                        echo "<td>Keya Sharmin</td>";
                        echo "<td>CSE370</td>";
                        echo "<td>4</td>";
                        echo "<td>ATY</td>";
                        echo "</tr>";
                    

                ?>
            </tbody>
        </table>
		<button onclick="window.location.href='Faculty_Dashboard.php';" class="btn btn-primary">Return to Dashboard</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
