<div class="header">
	<h1>Camagru</h1>
	<table>
		<tr>
			<td>
				<div>
					<a href="http://localhost:8080/Camagru/index.php">Home</a>
				</div>
				<div>
					<a href="http://localhost:8080/Camagru/login.php">Login</a>
				</div>
			</td>
					<?php if (isset($_SESSION["username"])): ?>
					<p align="right" ><a href="index.php?logout='1'" style="color: red;">Log out</a></p>
                    <p allign="centre" >Welcome <strong><?php echo $_SESSION['username'] ?></strong></p>
                <?php endif?>
			</td>
		</tr>
	</table>
</div>