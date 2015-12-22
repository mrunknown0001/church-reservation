<?php
/*
* Tarlac Cathedral Online Reservation and Scheduling
* Edit Announcement
*/

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;


/*
* Include the basepath file
* in the constant BASE
*/
	include "basepath.php";


/*
* Page redirection part to login if the admin is not logged in
* 
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		if($_SESSION['username'] != 'admin') {

			header ("Location: error_location.php");

		}	
		else {
			// Nothing to do here
		}

	}
	else {

		header ("Location: login.php");

	}


?>


<!DOCTYPE html>
<html class="" lang="en-US">
<head>
	<title>Edit Announcement - Admin Panel</title>

<?php
	
	include "includes/head_include.php";

?>

</head>
<body>
	<div class="container">

		<h1>Admin Pannel</h1>

		<h2>Edit Announcement Message</h2>
		
		<a href="index.php" title="Admin Home">Home</a><br/>
<!-- Announcmenet Function in Edit Announcement -->
<?php
	/*
	* Announcement Function
	*/
	
	// Include the connection string in "includes" directory !Important
	// This contains the $conn variable, containing the connection string
	require_once "includes/connect.php";

	// Check if the variable to save(New Announcement is not empty and set)
	if(isset($_POST['announce']) && !empty($_POST['announce'])) {
		// The new announcement to be post is set to variable $new_announcment
		$new_announcement = stripslashes($_POST['announce']);

		$update_announcement = "UPDATE announcement 
			SET atext = '$new_announcement'
			WHERE announcementID = 1
		";

		$query_update = $conn->query($update_announcement);
	}
	else {
	
	}
?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		
			<textarea cols="40" rows="5" name="announce" id="announce" placeholder="Enter Announcement Here"><?php 
					// Any Value From the Current Announcement
					
					$select_announcement = "SELECT atext FROM announcement";
					$sa_result = $conn->query($select_announcement);
					
					$old_announcement = "";
					
					if($sa_result->num_rows > 0) {
						
						while($row_sa_result = $sa_result->fetch_assoc()) {
							$old_announcement = $row_sa_result['atext'];
						}
					
					}
					// The old announcement will display in the textarea of the edit announcement page
					echo $old_announcement;
					
			?></textarea>
			
			<br/>
			
			<input type="submit" value="Save" />
			
			<input type="reset" value="Reset" />
		
		</form>

	</div>


<?php

	require "includes/footer.php";

?>