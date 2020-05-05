<?php
	require_once("../../includes/initialize.php");

	if (!$session->is_logged_in()) { redirect_to('login.php'); }
?>

<?php include_layout_template('admin_header.php'); ?>
	<h2>Logs</h2>
	<!-- </div> -->
	<div 
		style="margin-bottom: 20px;" 
	>
		<?php echo nl2br(Logger::log_read()); ?>
	</div>

	<!-- 'logfileclear.php?clear=true' -->
	<a 
		href="#" 
		onclick="confirm('Are you sure to clear the log?') ? window.location = 'logfileclear.php?clear=true' : null"
	>Clear Log File</a>

	<script>
	</script>

<?php include_layout_template('admin_footer.php'); ?>
