<?php
	// require_once("../../includes/functions.php");
	// require_once("../../includes/session.php");
	// require_once("../../includes/database.php");
	// require_once("../../includes/user.php");
	require_once("../../includes/initialize.php");

	$message = "";

	if ($session->is_logged_in()) {
		redirect_to('index.php');
	}

	// Remember to give your form't submit tag a name="submit" attribute!
	if (isset($_POST['submit'])) { // For has been submitted.
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		// Check database to see if username/password exist.
		$found_user = User::authenticate($username, $password);
		var_dump($found_user);

		if ($found_user != false) {
			// echo "test";
			$session->login($found_user);
			redirect_to('index.php');
		} else {
			// username/password combo was not found in the database
			$message = "Username/password combination incorrect";
		}

	} else { // Form has not been submitted.
		$username = "";
		$password = "";
	}

?>
<?php include_layout_template('admin_header.php'); ?>

			<h2>Staff Login</h2>
			<?php echo output_message($message); ?>

			<form action="login.php" method="post">
				<table>
					<tr>
						<td>Username:</td>
						<td>
							<input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
							<input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Login" />
						</td>
					</tr>
				</table>
			</form>

		<!-- </div> -->
<?php include_layout_template('admin_footer.php'); ?>