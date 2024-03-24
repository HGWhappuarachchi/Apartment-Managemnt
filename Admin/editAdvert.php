<?php
    session_start();

    // Check if the user is logged in and if their role is Landlord
    if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
        // Redirect to login page or another appropriate page
        header('Location: ../access_denied.php'); // Replace 'login.php' with the path to your login page
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisements</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS */
        body {
            background-color: #f8f9fa; /* Set background color */
            color: #343a40; /* Set text color */
        }

        .container {
            margin-top: 50px; /* Add margin to the top of container */
        }

        h1 {
            color: #007bff; /* Set heading color */
            margin-bottom: 30px; /* Add margin to the bottom of heading */
        }

        th {
            background-color: #007bff; /* Set table header background color */
            color: #ffffff; /* Set table header text color */
        }

        .modal-title {
            color: #007bff; /* Set modal title color */
        }

        .modal-body {
            padding: 20px; /* Add padding to modal body */
        }

        .modal-footer {
            justify-content: space-between; /* Adjust modal footer alignment */
        }
    </style>
</head>
<body>
<?php include 'Navigation/Navigation.php'; ?>
    <div class="container">
        <h1>Advertisements</h1>
        <table class="table table-striped" id="advertisementsTable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Advertisements will be loaded here -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Modal for Editing/Removing Advertisements -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Advertisement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing advertisement will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="script.js"></script>
</body>
</html>
