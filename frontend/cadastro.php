<?php include 'header.php';
session_start(); ?>

<div class="row">
	<div class="col s6 offset-s3">
		<div class="card-panel">
			<h4>Faça seu cadastro</h4>
			<form action="../backend/register.php" method="POST">
			  <div class="input-field">
			    <input type="text" name="name" id="name" required/>
			    <label for="name">Nome completo</label>
			  </div>
			  <div class="input-field">
			    <input type="email" name="email" id="email" required/>
			    <label for="email">E-mail</label>
			  </div>
			  <div class="input-field">
			    <input type="password" name="password" id="password" required/>
			    <label for="password">Senha</label>
			  </div>
			  <div class="input-field">
			    <input type="password" name="cpassword" id="cpassword" required/>
			    <label for="cpassword">Confirme a senha</label>
			  </div>
			  <div class="input-field">
			    <input type="submit" value="Cadastrar" class="btn blue-grey darken-2" />
          <a href="login.php" class="btn blue-grey darken-2">Login</a>
			  </div>
			</form>
		</div>
		<?php
			if (isset($_SESSION["errorCadastro"])) {
				$erro = $_SESSION["errorCadastro"];
				?>
				<div class="section red lighten-4">
					<p><?php echo $erro; unset($_SESSION["errorCadastro"]);?></p>
				</div>
				<?php
			}
		?>
	</div>
</dvi>

<?php include 'footer.php'; ?>
