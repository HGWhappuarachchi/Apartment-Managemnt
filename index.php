<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        /* Navigation */
        .navbar {
            background-color: #343a40; /* Dark background */
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important; /* White text */
        }

        /* Content */
        .container {
            margin-top: 50px; /* Space between navigation and content */
        }

        h1 {
            color: #343a40; /* Dark text */
            margin-bottom: 20px; /* Space below heading */
        }

        p {
            color: #555; /* Slightly darker text */
            font-size: 18px; /* Larger text */
            line-height: 1.6; /* Improved readability */
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include 'Navigation/Navigation.php'; ?>
    
    <!-- Content -->
    <div class="container">
        <h1>Welcome to our website!</h1>
        <p>This is a simple Bootstrap page with a navigation bar.</p>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
