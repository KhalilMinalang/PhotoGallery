<?php
	require_once("../../includes/initialize.php");

	// 
	if (!$session->is_logged_in()) { redirect_to('login.php'); }
?>

<?php include_layout_template('admin_header.php'); ?>
	<?php
		// create
		// $user = new User();
		// $user->username = 'johnsmith';
		// $user->password = 'abcd12345';
		// $user->first_name = 'John';
		// $user->last_name = 'Smith';
		// $user->create();

		// update
		// $user = User::find_by_id(2);
		// $user->password = "12345abcd";
		// $user->password = "12345wxyz";
		// $user->update();
		// update using save() method
		// $user->save();

		// delete
		// $user = User::find_by_id(2);
		// $user = User::find_by_id(3);
		// $user->delete();
		// echo $user->first_name , " was deleted";

		// new tests
		// create
		$user = new User();
		$user->username = 'princefalena';
		$user->password = 'secret';
		$user->first_name = 'Freyjadour';
		$user->last_name = 'Falenas';
		$user->save();

		// update
		$user = User::find_by_id(4);
		$user->password = "supersecret";
		// update using save() method
		$user->save();
	?>

	<!-- </div> -->
<?php include_layout_template('admin_footer.php'); ?>
