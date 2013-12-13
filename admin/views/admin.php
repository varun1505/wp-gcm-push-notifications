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
	<form action="">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="email">API Key <span class="description">(required)</span></label></th>
					<td><textarea name="api-key" id="api-key" class="txt-area" rows="5" cols="30"></textarea></td>
				</tr>
			
				<tr>
					<th><label for="email">API Secret <span class="description">(required)</span></label></th>
					<td><textarea name="api-secret" id="api-secret" class="txt-area" rows="5" cols="30"></textarea></td>
				</tr>
				
				<tr>
					<th></th>
					<td><input type="submit" class="button-primary" value="Save" /></td>
				</tr>
			</tbody>
		</table>
	</form>
	<!-- <h3>Registered users</h3>
	<table class="widefat">
		<thead>
			<tr>
				<th>S.No.</th>
				<th>GCM ID</th>
				<th>User Email</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>1</th>
				<th>asdfasfwer234234sadfq3rqf3sd</th>
				<th>varun@sudosaints.com</th>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th>S.No.</th>
				<th>GCM ID</th>
				<th>User Email</th>
			</tr>
		</tfoot>
		
	</table> -->
	
</div>
