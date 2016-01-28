<div id="login_view">
	<form action='<?php echo base_url(); ?>admin/login' method='POST'>
		<h1>Panel de Administración</h1>
		<table>
			<tr>
				<td>Usuario:</td>
				<td><input type="text" name="user" id="user"><br></td>
			</tr>
			<tr>
				<td>Clave:</td>
				<td><input type="password" name="pass" id="pass"></td>
			</tr>
			<tr>
				<td colspan=2 class="centrado"><input type="submit" value="Ingresar"></td>
			</tr>
        </table> 

</form>

</div>
