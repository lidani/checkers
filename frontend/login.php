<?php
session_start();
if (isset($_SESSION["id"])) {
	header("Location: index.php");
	die();
}

include 'header.php';
?>
<div class="row">
	<div class="col s6 offset-s3">
		<div class="card-panel">
			<h4>Faça seu login</h4>
			<form action="../backend/authentication.php" method="POST">
        <div class="input-field">
          <input type="email" name="email" id="email" />
          <label for="email">E-mail</label>
        </div>
	        <div class="input-field">
	          <input type="password" name="password" id="password" />
	          <label for="password">Senha</label>
	        </div>
        <div class="input-field">
          <input type="submit" value="Login" class="btn blue-grey darken-2" />
          <a href="cadastro.php" class="btn blue-grey darken-2">Cadastro</a>
        </div>
      </form><br />
      <?php
				if (isset($_SESSION["logout"])) {
					$logout = $_SESSION["logout"];
					?>
					<div class="section green lighten-3">
						<p><?php echo $logout; unset($_SESSION["logout"]); ?></p>
					</div>
					<?php
				}
				if (isset($_SESSION["errorLogin"])) {
					$erro = $_SESSION["errorLogin"];
					?>
					<div class="section red lighten-4">
						<p><?php echo $erro; unset($_SESSION["errorLogin"]); ?></p>
					</div>
					<?php
				}
			?>
    </div>
	</div>
</div>

<?php include 'footer.php'; ?>
