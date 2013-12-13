<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   WP_GCM
 * @author    Varun Srinivas <me@varun1505.com>
 * @license   GPL-2.0+
 * @link      http://varun1505.com
 * @copyright 2013 SudoSaints
 */
?>
<?php if(isset($_POST['submit'])){ 
	$apiKey = $_POST['api-key'];
	
	update_option('gcm_apikey', trim($apiKey));
}?>

<style>
.txt-area {
	width: 500px;
	resize: none;
}
</style>
<div class="wrap">
	
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<hr/>
	<h3>GCM API Details</h3>
	<form action="<?php echo admin_url('options-general.php?page=wp-gcm');?>" method="post">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="email">API Key <span class="description">(required)</span></label></th>
					<td><textarea name="api-key" id="api-key" class="txt-area" rows="5" cols="30"><?php echo get_option('gcm_apikey','');?></textarea></td>
				</tr>
			
				<!-- <tr>
					<th><label for="email">API Secret <span class="description">(required)</span></label></th>
					<td><textarea name="api-secret" id="api-secret" class="txt-area" rows="5" cols="30"></textarea></td>
				</tr> -->
				
				<tr>
					<th></th>
					<td><input type="submit" class="button-primary" name="submit" value="Save" /></td>
				</tr>
			</tbody>
		</table>
	</form>	
</div>
