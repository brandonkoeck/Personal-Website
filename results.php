<script src="assets/js/jquery-3.5.1.js"></script>

<?php
include("functions.php");

// Check if session ID is present in the URL
if (isset($_GET['sid']) && !empty($_GET['sid'])) {
    $dblink = db_connect("contact_data");
    $sid = $dblink->real_escape_string($_GET['sid']);

    // Query to check if the session ID exists in the database
    $sql = "SELECT `auto_id` FROM `accounts` WHERE `session_id` = '$sid'";
    $result = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    if ($result->num_rows <= 0) {
        // Invalid session ID in the database
        redirect("index.php?page=login&error=invalidSID");
    } else {
        // Valid session ID found
        echo '<div class="container">';
        echo '<div class="panel panel-primary">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">Results</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        echo '<h2>Database Entries</h2>';
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Auto ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Username</th><th>Password</th><th>Comments</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody id="results">';
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    // Missing session ID in the URL
    redirect("index.php?page=login&error=missingSID");
}
?>

<script>
function refresh_data() {
    $.ajax({
        type: 'POST',
        url: 'https://ec2-3-20-221-45.us-east-2.compute.amazonaws.com/hw20/query_contacts.php',
        success: function(data) {
            $('#results').html(data);
        }
    });
}

// Update every 500 ms
setInterval(function() {
    refresh_data();
}, 500);
</script>
