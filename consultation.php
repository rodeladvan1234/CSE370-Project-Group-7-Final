<?php
require_once('DBconnect.php');

session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    echo "User ID: $user_id";

} else {
    echo "User ID not set in session.";
}

function fetchReviews($initial, $conn) { //agey parameter e $user_id nito, but $initial nite hobe

    //$sql = "SELECT ROUND(AVG(rating), 2) AS myReviews FROM feedback WHERE user_id = '$user_id'";
    $sql = "SELECT ROUND(AVG(rating), 2) AS myReviews FROM feedback WHERE initial = '$initial'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['myReviews'];
    } else {
        return "No reviews available.";
    }
}

function fetchTotalHours($initial, $conn) {
    $sql = "SELECT COUNT(*) AS total_rows FROM consultation WHERE consultant = '$initial'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_rows']; 
    } else {
        return "No data available.";
    }
}

$initialSQL = "SELECT initial FROM faculty WHERE user_id = $user_id";
$initialResult = mysqli_query($conn, $initialSQL);

if ($initialResult && mysqli_num_rows($initialResult) > 0) {
    $initialRow = mysqli_fetch_assoc($initialResult);
    $initial = $initialRow['initial'];
    $reviews = fetchReviews($initial, $conn);
    $totalHours = fetchTotalHours($initial, $conn);
} else {
    echo "Error fetching initial from the database.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Consulting Dashboard</title>
    <style>
        body {
            background-color: #e0f7fa; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff; 
            color: white;
            padding: 10px 20px;
        }

        .nav_logo h1 {
            margin: 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav_link {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav_link li {
            margin-right: 20px;
        }

        .Consulting_Dashboard {
            background-color: white;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .Previous {
            margin-bottom: 20px;
        }

        .reviews {
            background-color: #f0f0f0; 
            padding: 10px;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav_logo">
                <h1><a href="Faculty.html">Interactive Consultation System | ICS </a></h1>
            </div>
        </nav>
        
<div id='logout'>
    <form action="login.html" method="post">
        <button type="submit" class="btn-danger" name="logout">Logout</button>
    </form>
</div>

    </header>
    <main>
        <section class="Consulting Dashboard">
            <div class="Consulting_Dashboard">
                <form action="action_page.php" style="border:1px solid #ccc">
                    <div class="container">
                        <h1>Consultation Information</h1>
                        <p>Manage all your consultation here</p>
                        <hr><br>

                        <div class="Previous Consultations">
                            <a href="previous.html">Previous Consultations</a><br>
                            <a href="ongoingConso.html">Ongoing Consultations</a>
                            <br><br>

                            <p>My reviews: <?php echo $reviews;?></p><br>
                            <p>Total Consulted Hours: <?php echo $totalHours;?></p><br>

                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>