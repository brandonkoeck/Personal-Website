<?php

include("functions.php");

// Retrieve error message from query parameter, if any
$error_message = "";
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'invalidSID':
            $error_message = "Invalid session ID. Please log in again.";
            break;
        case 'missingSID':
            $error_message = "Session ID is missing. Please log in again.";
            break;
        case 'authError':
            $error_message = "Invalid username or password. Please try again.";
            break;
        default:
            $error_message = "";
    }
}

// Display login form
echo '<div class="container">';
echo '<div class="panel panel-primary">';
echo '<div class="panel-heading">';
echo '<h3 class="panel-title">Login</h3>';
echo '</div>';
echo '<div class="panel-body">';
echo '<h2>Please log in to continue:</h2>';

// Display the error message if it exists
if (!empty($error_message)) {
    echo "<div class='alert alert-danger'>$error_message</div>";
}

echo '<form method="post" action="">';
echo '<div class="form-group">';
echo '<label class="control-label">Username:</label>';
echo '<input name="username" type="text" class="form-control" required />';
echo '</div>';
echo '<div class="form-group">';
echo '<label class="control-label">Password:</label>';
echo '<input name="password" type="password" class="form-control" required />';
echo '</div>';
echo '<button class="btn btn-primary" type="submit" name="submit" value="submit">Login</button>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';

// Process login form submission
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        redirect("index.php?page=login&error=authError");
    }

    $dblink = db_connect('contact_data');

    // Sanitize username input
    $username = $dblink->real_escape_string($username);

    // Hash the password with the salt
    $salt = "CS4413fa24";
    $hash = hash('sha256', $username . $password . $salt);

    // Query to check username and password
    $sql = "SELECT `auto_id` FROM `accounts` WHERE `username` = '$username' AND `hash` = '$hash'";
    $result = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    if ($result->num_rows > 0) {
        // Successful login
        $data = $result->fetch_array(MYSQLI_ASSOC);

        // Generate session ID
        $SIDsalt = microtime(); // Randomized salt
        $sid = hash('sha256', $hash . $SIDsalt);

        // Update session ID in database
        $sql = "UPDATE `accounts` SET `session_id` = '$sid' WHERE `auto_id` = '{$data['auto_id']}'";
        $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

        // Redirect to results page
        redirect("index.php?page=results&sid=$sid");
    } else {
        // Failed login
        redirect("index.php?page=login&error=authError");
    }
}
?>

