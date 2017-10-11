
<?php include 'header.php';
session_start(); ?>

<div class="row">
	<div class="col s6 offset-s3">
		<div class="card-panel">
			<h4>Faça seu cadastro</h4>
			<?php
				if (isset($_SESSION["error"])) {
					$erro = $_SESSION["error"];
					?>
					<div class="section red lighten-4">
						<p><?php echo $erro; unset($_SESSION["error"]);?></p>
					</div>
					<?php
				}
			?>
			<form action="../backend/register.php" method="POST">
			  <div class="input-field">
			    <input type="text" name="name" id="name" />
			    <label for="name">Nome completo</label>
			  </div>
			  <div class="input-field">
			    <input type="email" name="email" id="email" />
			    <label for="email">E-mail</label>
			  </div>
			  <div class="input-field">
			    <input type="password" name="password" id="password" />
			    <label for="password">Senha</label>
			  </div>
			  <div class="input-field">
			    <input type="password" name="cpassword" id="cpassword" />
			    <label for="cpassword">Confirme a senha</label>
			  </div>
			  <div class="input-field">
			    <input type="submit" value="Cadastrar" class="btn blue-grey darken-2" />
			  </div>
			</form>
		</div>
	</div>
</dvi>

<?php include 'footer.php'; ?>
