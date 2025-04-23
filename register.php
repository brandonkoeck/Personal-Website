<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>
<link href="assets/css/bootstrap.css" rel="stylesheet"/>
</head>

<body>
    <?php
    include("functions.php");

    $error_message = ""; // Variable to hold error messages
    $success_message = ""; // Variable to hold success messages

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dblink = db_connect('contact_data');

        // Input validation
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (empty($username) || empty($password)) {
            $error_message = "Both username and password are required.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]{5,20}$/', $username)) {
            $error_message = "Username must be 5-20 characters long and contain only letters, numbers, and underscores.";
        } else {
            // Check for existing username
            $username = $dblink->real_escape_string($username);
            $query = "SELECT * FROM `accounts` WHERE `username` = '$username'";
            $result = $dblink->query($query);

            if ($result->num_rows > 0) {
                $error_message = "Username already exists. Please choose another.";
            } else {
                // Hash the password and insert into the database
                $salt = "CS4413fa24";
                $hash = hash('sha256', $username . $password . $salt);
                $insert_query = "INSERT INTO `accounts` (`username`, `hash`) VALUES ('$username', '$hash')";
                
                if ($dblink->query($insert_query)) {
                    $success_message = "Registration successful. Redirecting to login...";
                    echo "<script>setTimeout(() => { window.location.href = 'index.php?page=login'; }, 3000);</script>";
                } else {
                    $error_message = "Error: " . $dblink->error;
                }
            }
        }
    }

    // Display form
    if (!empty($error_message)) {
        echo "<div class='alert alert-danger'>$error_message</div>";
    }
    if (!empty($success_message)) {
        echo "<div class='alert alert-success'>$success_message</div>";
    }
    ?>

    <h2>Please fill out the following form:</h2>
    <form method="post" action="">
        <div class="form-group">
            <label class="control-label">Username:</label>
            <input name="username" type="text" class="form-control" required/>
            <div id="unFeedback"></div>
        </div>
        <div class="form-group">
            <label class="control-label">Password:</label>
            <input name="password" type="password" class="form-control" required/>
            <div id="pwFeedback"></div>
        </div>
        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
    </form>
</body>
</html>
