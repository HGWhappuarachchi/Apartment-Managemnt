<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <!-- Include the navigation bar here -->
    <?php include 'Navigation/Navigation.php'; ?>

    <!-- Create a bootstrap form to login -->
    <div class="container">
        <h2 style="color: #333; font-weight: bold; margin-bottom: 20px;">Login</h2>
        <?php
        // Check if the session variable is set and display the alert
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo $_SESSION['success'];
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            // Clear the session variable to prevent the alert from showing again on page reload
            unset($_SESSION['success']);
        } else if(isset($_SESSION['error'])){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo $_SESSION['error'];
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            // Clear the session variable to prevent the alert from showing again on page reload
            unset($_SESSION['error']);
        }
        ?>

        <form id="loginForm" method="post" action="">
            <div class="form-group">
                <label for="exampleInputEmail1" style="color: #333;">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" style="border-color: #ced4da;">
                <div id="emailError" class="text-danger" style="font-size: 14px;"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="color: #333;">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" style="border-color: #ced4da;">
                <div id="passwordError" class="text-danger" style="font-size: 14px;"></div>
            </div>

            <button type="submit" class="btn btn-primary" name="submit" style="background-color: #007bff; border-color: #007bff;">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Validate email field and password field -->
    <script>
        $(document).ready(function(){
            $("#loginForm").submit(function(e){
                var email = $("#exampleInputEmail1").val();
                var password = $("#exampleInputPassword1").val();
                var isValid = true;

                // Email validation
                if(email.length === 0){
                    $("#exampleInputEmail1").addClass('is-invalid');
                    $("#emailError").text("Email is required.");
                    isValid = false;
                } else if(email.indexOf('@') === -1 || email.indexOf('.') === -1){
                    $("#exampleInputEmail1").addClass('is-invalid');
                    $("#emailError").text("Please enter a valid email address.");
                    isValid = false;
                } else {
                    $("#exampleInputEmail1").removeClass('is-invalid');
                }

                // Password validation
                if(password.length < 8){
                    $("#exampleInputPassword1").addClass('is-invalid');
                    $("#passwordError").text("Password must be at least 8 characters long.");
                    isValid = false;
                } else {
                    $("#exampleInputPassword1").removeClass('is-invalid');
                }

                // Prevent form submission if any validation fails
                if(!isValid){
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
