

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Contact Info</h3>
            </div>

            <?php
            session_start();
			
			// Turn on php to expose all errors, never do this on production!!
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			
			error_reporting(E_ALL);

            // Initialize array for errors
            $errors = array();

            // Check if form is submitted
            if (isset($_POST['submit'])) {
                // Capture form inputs (post)
                $firstName = addslashes ($_POST['firstName']);
                $lastName = addslashes ($_POST['lastName']);
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $username = addslashes ($_POST['username']);
                $password = addslashes ($_POST['password']);
                $comments = addslashes ($_POST['comments']);

                //  Validate first name
                if (empty($firstName)) {
                    $errors['fnameErr'] = "First name cannot be empty!";
                } /*elseif (!preg_match("/^[a-zA-Z'’-]+$/", $firstName)) {
                    $errors['fnameErr'] = "First name has invalid characters!";
                } */else {
                    $_SESSION['firstName'] = $firstName;
                }

                // Validate last name
                if (empty($lastName)) {
                    $errors['lnameErr'] = "Last name cannot be empty!";
                } /* elseif (!preg_match("/^[a-zA-Z'’-]+$/", $lastName)) {
                    $errors['lnameErr'] = "Last name has invalid characters!";
                } */ else {
                    $_SESSION['lastName'] = $lastName;
                }

                //  Validate email
                if (empty($email)) {
                    $errors['emailErr'] = "Email cannot be empty!";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['emailErr'] = "Email format is invalid.";
                } else {
                    $_SESSION['email'] = $email;
                }

                // Validate phone number
                if (empty ($phone)) {
                    $errors['phoneErr'] = "Phone number can't be empty!";
                } elseif (!preg_match("/^\d+$/", $phone)) {
                    $errors['phoneErr'] = "Phone number must only contain digits!";
                } else {
                    $_SESSION['phone'] = $phone;
                }

                // Validate username
                if (empty ($username)) {
                    $errors['usernameErr'] = "Username cannot be empty!";
                } else {
                    $_SESSION['username'] = $username;
                }

                // Validate password
                if (empty ($password)) {
                    $errors['passwordErr'] = "Password cannot be empty!";
                } else {
                    $_SESSION['password'] = $password;
                }

                // Validate comments
                if (empty ($comments)) {
                    $errors['commentsErr'] = "Comments cannot be empty!";
                } else {
                    $_SESSION['comments'] = $comments;
                }

                // Output data if no errors exist
                if (empty ($errors)) { /*
                    echo "<div class='panel-body'><h2>Your contact info was submitted successfully.</h2>";
                    echo "<p>First Name: $firstName</p>";
                    echo "<p>Last Name: $lastName</p>";
                    echo "<p>Email: $email</p>";
                    echo "<p>Phone Number: $phone</p>";
                    echo "<p>Username: $username</p>";
                    echo "<p>Password: $password</p>";
                    echo "<p>Comments: $comments</p>";
                    echo "</div>";
					*/
					
					// In order to connect to a database we need: host, db_user, db_password, db_name
					
					include("functions.php");
					$dblink = db_connect("contact_data");
					
					// Set up the sql to insert data
					$sql = "Insert into `contact_info` (`first_name`,`last_name`,`email`,`phone`,`username`,`password`,`comments`) values ('$firstName','$lastName','$email','$phone','$username','$password','$comments')";
					// Call the query method for our mysqli object in $dblink or generate and error if the query was not successful
					$dblink->query($sql) or
						die("<h2>Something went wrong with $sql<br>".$dblink->error."</h2>");
					echo '<div class="section-title"><h2>Data sent to database!</h2></div>';
                }
				
            }

            // Display form is no errors exist
            if (!empty ($errors) || !isset($_POST['submit'])) { 
                echo '<div class="panel-body"><h2>Please fill out the contact form below</h2>';
                echo '<form id="contactForm" action="" method="post">';

                // Function to refill input fields with previous data
                function refill($field) {
                    return isset($_SESSION[$field]) ? $_SESSION[$field] : '';
                }

                // First name input field
                echo '<div class="form-group' . (isset($errors['fnameErr']) ? ' has-error' : '') . '">
                        <label for="firstName" class="control-label">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="' .refill('firstName') . '">
                        <span class="help-block">' . (isset($errors['fnameErr']) ? $errors['fnameErr'] : '') . '</span>
                    </div>';

                // Last name input field
                echo '<div class="form-group' . (isset($errors['lnameErr']) ? ' has-error' : '') . '">
                        <label for="lastName" class="control-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="'. refill('lastName') . '">
                        <span class="help-block">' . (isset($errors['lnameErr']) ? $errors['lnameErr'] :'') . '</span>
                    </div>';

                // Email input field
                echo '<div class="form-group' . (isset($errors['emailErr']) ? ' has-error' : '') . '">
                        <label for="email" class="control-label">Email Address:</label>
                        <input type="text" class="form-control" id="email" name="email" value="' .refill('email') . '">
                        <span class="help-block">' . (isset($errors['emailErr']) ? $errors['emailErr'] :'') . '</span>
                    </div>';

                // Phone input field
                echo '<div class="form-group' . (isset($errors['phoneErr']) ? ' has-error' : '') . '">
                        <label for="phone" class="control-label">Phone Number:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="' .refill('phone') . '">
                        <span class="help-block">' . (isset($errors['phoneErr']) ? $errors['phoneErr'] :'') . '</span>
                    </div>';

                // Username input field
                echo '<div class="form-group' . (isset($errors['usernameErr']) ? ' has-error' : '') . '">
                        <label for="username" class="control-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="'. refill('username') . '">
                        <span class="help-block">' . (isset($errors['usernameErr']) ? $errors['usernameErr']: '') . '</span>
                    </div>';

                // Password input field
                echo '<div class="form-group' . (isset($errors['passwordErr']) ? ' has-error' : '') . '">
                        <label for="password" class="control-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="' . refill('password') . '">
                        <span class="help-block">' . (isset($errors['passwordErr']) ? $errors['passwordErr'] :'') . '</span>
                    </div>';

                // Comment input field
                echo '<div class="form-group' . (isset($errors['commentsErr']) ? ' has-error' : '') .'">
                        <label for="comments" class="control-label">Comments:</label>
                        <textarea id="comments" class="form-control" name="comments">' . refill('comments') . '</textarea>
                        <span class="help-block">' . (isset($errors['commentsErr']) ? $errors['commentsErr'] : '') . '</span>
                    </div>';

                echo '<button class="btn btn-default" type="submit" name="submit" value="submit">Submit</button>';
                echo '</form>';
            }
			
            ?>
			
        </div>
    </div>


