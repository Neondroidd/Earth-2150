<?php
session_start();
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

// Include the database connection file
include("db_connection.php");

// Initialize variables
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check input errors before checking the database
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect to the index page
                            header("location: index.php");
                        } else {
                            // Set login error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Set login error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./public/main/style.css">
    <title>Earth 2150 - LOGIN</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Bootstrap JS and Popper.js -->
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your custom scripts -->
    <script src="./public/main/index.js"></script>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary" data-bs-theme="dark">
    <main class="form-signin w-100 m-auto border border-light-subtle">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="loginForm">
            <img class="d-block mx-auto mb-4" src="./public/images/earth.png" alt="" width="72" height="72">
            <h1 class="d-block mx-5 mb-4 h3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="username" class="form-control" id="floatingInput" name="username" placeholder="username"
                    required>
                <label for="floatingInput">username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
                    required>
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="button" onclick="validateLoginForm()">Login</button>

            <!-- Display the login error alert when applicable -->
            <div id="loginAlert" class="alert alert-danger alert-dismissible fade my-3" role="alert" style="display: none;">
                Invalid username or password.
                <button type="button" class="btn-close" onclick="closeLoginAlert()"></button>
            </div>

            <span class="mb-3 mb-md- text-body-secondary">&copy;<span id="year"></span> <a class="text-body-primary"
                    href="https://www.instagram.com/heyy.orville/" target="_blank"
                    style="text-decoration: none;">Orville</a> | All Rights Reserved
            </span>
        </form>
    </main>

    <script>
        function validateLoginForm() {
            var form = document.getElementById('loginForm');
            form.submit();
        }

        function closeLoginAlert() {
            document.getElementById('loginAlert').style.display = 'none';
        }
    </script>
</body>

</html>
