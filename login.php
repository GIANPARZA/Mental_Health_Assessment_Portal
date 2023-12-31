<?php
include('assessment_db.php');
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sr_code = $_POST['sr_code'];
    $password = $_POST['password'];

   
    $sql = "SELECT * FROM account WHERE sr_code = '$sr_code' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        
        session_start();
        $_SESSION['sr_code'] = $sr_code;
        header("Location: terms_condition.php"); 
        exit; 
    } else {
        
        $errorMessage = "Invalid SR-CODE or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap/font/bootstrap-icons.min.css">
    
    <title>Login</title>
</head>
<style>

    span {
	color:orange;
	font-size: 50px;
}
h1 {
    color: white;
    font-size: 50px; 
}
.navbar {
	background-image: url('assets/header.png');
	background-size:cover;
	background-repeat:no-repeat;
	background-position: center;
}
.bg-body {
	background-image: url('assets/home.png');
	background-size:cover;
	background-repeat:no-repeat;
	background-position: center;
    height: 100vh;
}
.navbar-brand {
    display: flex;
    align-items: center;
}
.navbar-brand h6 {
	color:#ffffff;
    margin:10px; 
}
.transparent-container {
	background-color: transparent;
}
.card {
	background-color: transparent;
	border: none;
	box-shadow: none;
}
.form-control {
    background-color: transparent !important;
	color:#fff;
	border-radius: 50px;
	border-width: 3px;
        }
.form-control::placeholder {
    color: white;
}
.form-control:focus {
    color: white; 
    background-color: transparent !important;
    border-color: transparent; 
}
.form-control:active {
	
}
.btn-primary {
	border-radius: 20px;
	width: 100px;
}
.btn-primary:active {
    background-color: transparent;
}
.input-with-icon {
    position: relative;
}

.input-with-icon input[type="password"] {
    padding-right: 30px; 
}

.input-with-icon i {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 10px; 
    cursor: pointer;
}
.fa-eye, .fa-eye-slash {
    color: white !important;
}
</style>
<body class="bg-body">
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/logo_bsu.png" alt="logo" width="40" height="40" class="inline-block align-text-top me-2">
                <h6 class="text-sm">BATANGAS STATE UNIVERSITY - TNEU <br>MENTAL HEALTH ASSESSMENT PORTAL</h6>
            </a>
        </div>
    </nav>
    <br><br><br><br>
    <div class="container mt-5 transparent-container">
        <div class="row justify-content-left">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1> A <span>MIND</span>ful day, Red Spartan! Welcome</h1>

                        <form id="loginForm" action="login.php" method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="sr_code" name="sr_code" placeholder="SR-CODE" required autocomplete="off" pattern="^\d{2}-\d{5}$">
                            </div>

                            <div class="mb-3 input-with-icon">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <i class="bi bi-eye-slash-fill text-white" id="togglePassword" onclick="togglePasswordField()"></i>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="assessmentButton" class="btn btn-primary">Login</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="forgot_password.php">Forgot Password?</a>
                            </div>
                        </form>

                        
                        <?php if (!empty($errorMessage)) : ?>
                            <div class="modal" id="errorModal" style="display: block;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Login Error</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p id="errorMessage"><?php echo $errorMessage; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        
        $(document).ready(function() {
    $("#togglePassword").click(function() {
        var passwordField = $("#password");
        var icon = $(this).find("i");

        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
            icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
        } else {
            passwordField.attr("type", "password");
            icon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
        }
    });
});

$(document).ready(function() {
        
        function closeModal() {
            $('#errorModal').modal('hide');
        }

    
        $('#errorModal .modal-footer .btn-primary').click(function() {
            closeModal();
        });

     
        $('#errorModal').click(function(event) {
            if ($(event.target).hasClass('modal')) {
                closeModal();
            }
        });
    });
    </script>
    

</body>
</html>
