<!DOCTYPE html>
<html style="font-family: Verdana">
	
<head>
<title>Welcome to Brandon's website!</title>
	

	<link href="assets/css/bootstrap.css" rel="stylesheet"/>
		<link href="assets/css/bootstrap-theme.css" rel="stylesheet"/>
		<link href="assets/css/styles.css" rel="stylesheet"/>
	
</head>
	
<body>
		

		<nav class="navbar navbar-default navbar-fixed-top">
      <!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Welcome to Brandon's website!</a>
        </div>

		  
		<?php
		  
		  include("navigation.php");
		  
		?>
		  
		  

      </div>
    </nav>

	
	<?php
	// Contemt body of my index.php
	
	if (isset($_GET['page'])) {
	
	$page=$_GET['page'];
	
	switch($page) {
	
		case "work":
		include("work.php");
		break;

		case "school":
		include("school.php");
		break;
	
		case "hobbies":
		include("hobbies.php");
		break;
	
		case "login":
		include("login.php");
		break;
		
		case "contact":
		include("contact.php");
		break;

		case "results":
			include("results.php");
			break;
			
	
		default: // Will load if page is nothing or anything else
		include("home.php");
		break;
	
	} 
		
		
		
	} else
		include("home.php");
	
	?>


</body>
</html>