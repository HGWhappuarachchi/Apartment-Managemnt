<?php
    session_start();

    // Check if the user is logged in and if their role is Landlord
    if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Landlord') {
        // Redirect to login page or another appropriate page
        header('Location: ../access_denied.php');
        exit();
    }

    // Include the database connection here
    include '../ConnectionDB/DbConnection.php';

    // Fetch all requests made to the places owned by the landlord
    $sql = "SELECT requests.*, place.title, place.description, place.price, place.latitude, place.longitude, place.image_path FROM requests JOIN place ON requests.place_id = place.place_id WHERE place.landlord = ? AND requests.status = '1'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['id']);
    $stmt->execute();
    $requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Professional Looking Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .list-group-item {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 15px;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .list-group-item h5 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .list-group-item p {
            margin-bottom: 5px;
        }

        .list-group-item img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }

        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <!-- Import the navigation bar here -->
    <?php include 'Navigation/Navigation.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Requests for Your Places</h3>
                <ul id="requests" class="list-group">
                    <?php foreach ($requests as $request): ?>
                        <li class="list-group-item" data-id="<?= $request['id'] ?>">
                            <h5><?= $request['title'] ?></h5>
                            <p><?= $request['description'] ?></p>
                            <p>Price: <?= $request['price'] ?></p>
                            <p>Message: <?= $request['message'] ?> </p>
                            <img src="<?= $request['image_path'] ?>" alt="<?= $request['title'] ?>">
                            <button class="btn btn-success accept-btn">Accept</button>
                            <button class="btn btn-danger cancel-request-btn">Cancel Request</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // JavaScript code for handling accept and cancel request buttons
        // Add your JavaScript code here
    </script>
</body>
</html>
