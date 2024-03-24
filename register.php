<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <!-- import the navigation bar here -->
    <?php include 'Navigation/Navigation.php'; ?>
    <!-- create a bootstrap form to add a new user with roles including Student, Landloard, Warden, Admin -->
    <div class="container">
        <h2 style="color: #333; font-weight: bold; margin-bottom: 20px;">Add New User</h2>
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
        }
        ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="exampleInputUsername1" style="color: #333;">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="username" placeholder="Enter username" style="border-color: #ced4da;">
                <div id="usernameError" class="text-danger" style="font-size: 14px;"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style="color: #333;">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" style="border-color: #ced4da;">
                <div id="emailError" class="text-danger" style="font-size: 14px;"></div>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="color: #333;">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" style="border-color: #ced4da;">
                <div id="passwordError" class="text-danger" style="font-size: 14px;"></div>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword2" style="color: #333;">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword2" name="confirm_password" placeholder="Confirm Password" style="border-color: #ced4da;">
                <div id="confirmPasswordError" class="text-danger" style="font-size: 14px;"></div>
            </div>

            <button type="submit" class="btn btn-primary" name="submit" style="background-color: #007bff; border-color: #007bff;">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- validate email and username field -->
    <script>
    $(document).ready(function(){
        $("button[name='submit']").click(function(e){
            var username = $("#exampleInputUsername1").val();
            var email = $("#exampleInputEmail1").val();
            var password = $("#exampleInputPassword1").val();
            var confirmPassword = $("#exampleInputPassword2").val(); // Add this line to get the value of confirmPassword
            var isValid = true;


               // Username validation
            if(username.length < 3){
                $("#exampleInputUsername1").removeClass('is-valid');
                $("#exampleInputUsername1").addClass('is-invalid');
                $("#usernameError").text("Username must be at least 3 characters long.");
                isValid = false;
            } else {
                $("#exampleInputUsername1").removeClass('is-invalid');
                $("#exampleInputUsername1").addClass('is-valid');
            }

            // Email validation
            if(email.length > 0){
                if(email.indexOf('@') > 0 && email.indexOf('.') > 0){
                    $("#exampleInputEmail1").removeClass('is-invalid');
                    $("#exampleInputEmail1").addClass('is-valid');
                } else {
                    $("#exampleInputEmail1").removeClass('is-valid');
                    $("#exampleInputEmail1").addClass('is-invalid');
                    $("#emailError").text("Please enter a valid email address.");
                    isValid = false;
                }
            } else {
                $("#exampleInputEmail1").removeClass('is-valid');
                $("#exampleInputEmail1").removeClass('is-invalid');
                $("#emailError").text("Email is required.");
                isValid = false;
            }

            // Password validation
            if(password.length < 8){
                $("#exampleInputPassword1").removeClass('is-valid');
                $("#exampleInputPassword1").addClass('is-invalid');
                $("#passwordError").text("Password must be at least 8 characters long.");
                isValid = false;
            } else {
                $("#exampleInputPassword1").removeClass('is-invalid');
                $("#exampleInputPassword1").addClass('is-valid');
            }

            // Confirm Password validation
            if(confirmPassword !== password){
                $("#exampleInputPassword2").removeClass('is-valid');
                $("#exampleInputPassword2").addClass('is-invalid');
                $("#confirmPasswordError").text("Passwords do not match.");
                isValid = false;
            } else {
                $("#exampleInputPassword2").removeClass('is-invalid');
                $("#exampleInputPassword2").addClass('is-valid');
            }

            // Prevent form submission if any validation fails
            if(!isValid){
                e.preventDefault(); // Prevent form submission
            }
        });
    });
    </script>
</body>
</html>
// Compare this snippet from register.php:
// <?php
// include '../ConnectionDB/DbConnection.php';