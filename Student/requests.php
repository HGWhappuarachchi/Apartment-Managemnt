<?php
    session_start();

    // Check if the user is logged in and if their role is Student
    if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Student') {
        // Redirect to login page or another appropriate page
        header('Location: ../access_denied.php');
        exit();
    }

    // Include the database connection here
    include '../ConnectionDB/DbConnection.php';

    // Fetch all requests made by the student
    $sql = "SELECT requests.*, place.title, place.description, place.price, place.latitude, place.longitude, place.image_path FROM requests JOIN place ON requests.place_id = place.place_id WHERE requests.student_id = ? AND requests.status = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['id']);
    $stmt->execute();
    $requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cancel Requests</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
    /* Navbar styling */
    .navbar {
        background-color: #fff;
        border-bottom: 1px solid #ddd;
        padding: 15px 0;
    }

    .navbar-brand {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .navbar-nav .nav-link {
        font-size: 18px;
        color: #333;
        margin-right: 15px;
    }

    /* Requests list styling */
    #requests {
        padding: 0;
    }

    #requests li {
        list-style: none;
        margin-bottom: 15px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 5px;
        border: 1px solid #ddd;
        display: flex; /* Align items horizontally */
        align-items: center; /* Center vertically */
    }

    #requests li:hover {
        background-color: #f0f0f0;
    }

    #requests li h5 {
        margin-bottom: 10px;
    }

    #requests li p {
        margin-bottom: 5px;
    }

    #requests li img {
        width: 20%;
        margin-left: auto; /* Align to the right */
    }

    /* Cancel button styling */
    .cancel-btn {
        margin-left: auto;
        border: none;
        border-radius: 5px;
        padding: 8px 16px;
        background-color: #dc3545;
        color: #fff;
        cursor: pointer;
    }

    .cancel-btn:hover {
        background-color: #c82333;
    }

    /* Alert box styling */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
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
                <h3>Your Requests</h3>
                <ul id="requests" class="list-group">
                    <?php foreach ($requests as $request): ?>
                        <li class="list-group-item" data-id="<?= $request['id'] ?>">
                            <h5><?= $request['title'] ?></h5>
                            <p><?= $request['description'] ?></p>
                            <p>Price: <?= $request['price'] ?></p>
                            
                            <img src="<?= $request['image_path'] ?>" alt="<?= $request['title'] ?>" style="width:20%;" class="ml-auto">
                            <button class="btn btn-danger cancel-btn">Cancel</button>
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
        $(document).ready(function() {
            $('.cancel-btn').click(function() {
                var requestId = $(this).closest('li').data('id');
                var $listItem = $(this).closest('li');

                $.post('cancel_request.php', {request_id: requestId}, function(data) {
                    var response = JSON.parse(data);
                    if (response.status === 'success') {
                        // Remove the list item from the page
                        $listItem.remove();
                        alert('Request cancelled successfully');

                        // Remove the corresponding marker from the map
                        // Assuming you have a way to map request IDs to markers
                        var markerToRemove = markers.find(marker => marker.requestId === requestId);
                        if (markerToRemove) {
                            markerToRemove.setMap(null);
                            markers = markers.filter(marker => marker.requestId !== requestId);
                        }
                    } else {
                        alert('Error cancelling request');
                    }
                });
            });
        });
    </script>
</body>
</html>
