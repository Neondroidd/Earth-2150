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
                            // Display an error message if password is not valid
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
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

<!doctype html>
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
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="./public/main/index.js"></script>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary bg-blur" data-bs-theme="dark">
    <!-- Theme Changer START -->
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <div class="icon"><i class="bi bi-circle-half"></i></div>
        </button>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <i class="bi bi-sun-fill"></i> Light
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark"
                    aria-pressed="true">
                    <i class="bi bi-moon-stars-fill"></i> Dark
                </button>
            </li>
            <li>
                <button id="auto" type="button" class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="auto" aria-pressed="false">
                    <i class="bi bi-circle-half"></i> Auto
                </button>
            </li>
        </ul>
    </div>
    <!-- Theme Change END -->

    <main class="form-signin w-100 m-auto">
        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
            <img class="mb-4" src="./public/images/earth.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

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

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" name="submit">Login</button>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy;<span id="year"></span> <a class="text-body-primary"
                    href="https://www.instagram.com/heyy.orville/" target="_blank"
                    style="text-decoration: none;">Orville</a> | All Rights Reserved
            </span>
        </form>
    </main>

</body>

</html>