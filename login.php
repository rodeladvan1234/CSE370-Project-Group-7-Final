<?php

require_once('DBconnect.php');
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    echo "User ID: $user_id";
} else {
    echo "User ID not set in session.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id']) && isset($_POST['password'])) {
	$_SESSION['user_id'] = $_POST['user_id'];
        // Retrieve form data
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        

    // Query to check if user exists
    $sql = "SELECT * FROM user_info WHERE user_id='$user_id' AND password='$password'";
    $result = mysqli_query($conn, $sql);
	
	// Determine user type based on user ID
            $firstChar = substr($user_id, 0, 1);
            if ($firstChar === '1') {
                $dashboard_url = "Faculty_Dashboard.php";
            } elseif ($firstChar === '2') {
                $dashboard_url = "Student_Dashboard.php";
            } elseif ($firstChar === '3') {
                $dashboard_url = "Student_tutor_Dashboard.php";
            } else {
                echo "Invalid user ID.";
                exit();
            }

    // If user exists, set session and redirect to dashboard
    if (mysqli_num_rows($result) != 0) {
        // Redirect to schedule page after successful signup
        header("Location: $dashboard_url.?user_id=$user_id");
        exit();
    } else {
        // Invalid credentials, display error message
        echo "Invalid email or password.";
    }

    mysqli_close($conn);
	}
}
?>
