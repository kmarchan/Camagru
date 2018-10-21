<div class="header">
	<h1>Camagru</h1>
	<table>
		<tr>
			<td>
				<div>
					<a href="http://localhost:8080/Camagru/index.php">Home</a>
				</div>
			</td>
					<?php if (isset($_SESSION["username"])): ?>
							<p align="right" ><a href="index.php?logout='1'";>Log out</a></p>
							<p align="right"><a href="account.php">Account Settings</a></p>
              <p align="centre" >Welcome <strong><?php echo $_SESSION['username'] ?></strong></p>
          <?php endif?>
					<?php if (!isset($_SESSION["username"])): ?>
						<p align="right" ><a href="login.php" style="color: red;">Log in</a></p>
					<?php endif?>
			</td>
		</tr>
	</table>
</div>
