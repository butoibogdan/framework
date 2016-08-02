<table cellpadding="2" cellspacing="0" border="1">
	<tr>
		<td>FirstName</td>
		<td>LastName</td>
	</tr>
	<?php foreach($vars['users'] as $user): ?>
	<tr>
		<td><?php echo $user['firstname']; ?></td>
		<td><?php echo $user['lastname']; ?></td>
	</tr>	
	<?php endforeach; ?>	
</table>