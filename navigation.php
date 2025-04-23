<?php

        echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">'; 
        echo '<ul class="nav navbar-nav">';

// Check if page is set, else default to an empty string- to avoid undefined array key "page" error
		if (isset($_GET['page']))
			$page = $_GET['page'];
		else
			$page = '';
		

		switch ($page) {
				
			case "work":
				echo '<li><a href="index.php">Home</a></li>';
				echo '<li class="active"><a href="index.php?page=work">Work</a></li>';
				echo '<li><a href="index.php?page=school">School</a></li>';
				echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
				echo '<li><a href="index.php?page=contact">Contact</a></li>';
				echo '<li><a href="index.php?page=login">Login</a></li>';
			break;
				
			case "school":
				echo '<li><a href="index.php">Home</a></li>';
				echo '<li><a href="index.php?page=work">Work</a></li>';
				echo '<li class="active"><a href="index.php?page=school">School</a></li>';
				echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
				echo '<li><a href="index.php?page=contact">Contact</a></li>';
				echo '<li><a href="index.php?page=login">Login</a></li>';

			break;
				
			case "hobbies":
				echo '<li><a href="index.php">Home</a></li>';
				echo '<li><a href="index.php?page=work">Work</a></li>';
				echo '<li><a href="index.php?page=school">School</a></li>';
				echo '<li class="active"><a href="index.php?page=hobbies">Hobbies</a></li>';
				echo '<li><a href="index.php?page=contact">Contact</a></li>';
				echo '<li><a href="index.php?page=login">Login</a></li>';

			break;
				
			case "contact":
				echo '<li><a href="index.php">Home</a></li>';
				echo '<li><a href="index.php?page=work">Work</a></li>';
				echo '<li><a href="index.php?page=school">School</a></li>';
				echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
				echo '<li class="active"><a href="index.php?page=contact">Contact</a></li>';
				echo '<li><a href="index.php?page=login">Login</a></li>';

			break;
				
			case "login": 
				echo '<li><a href="index.php">Home</a></li>';
				echo '<li><a href="index.php?page=work">Work</a></li>';
				echo '<li><a href="index.php?page=school">School</a></li>';
				echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
				echo '<li><a href="index.php?page=contact">Contact</a></li>';
				echo '<li class="active"><a href="index.php?page=login">Login</a></li>';


			break;
				
				
			default:
				echo '<li class="active"><a href="index.php">Home</a></li>';
				echo '<li><a href="index.php?page=work">Work</a></li>';
				echo '<li><a href="index.php?page=school">School</a></li>';
				echo '<li><a href="index.php?page=hobbies">Hobbies</a></li>';
				echo '<li><a href="index.php?page=contact">Contact</a></li>';
				echo '<li><a href="index.php?page=results">Results</a></li>';
				echo '<li><a href="index.php?page=login">Login</a></li>';


			break;
		
		}


        echo '</ul>';
        echo '</div>';

?>