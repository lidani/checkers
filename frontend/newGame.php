<?php
session_start();
if (!isset($_SESSION["id"])) {
	header("Location: index.php");
	die();
}
include 'header.php';
?>

<div class="row">
	<div class="col s6 offset-s3">
		<div class="card-panel">
			<h4>Criar novo jogo</h4>
			<?php
				if (array_key_exists("erro", $_GET)) {
					$erro = $_GET['erro'];
					?>
					<div class="section red lighten-4">
						<p><?php echo $erro; ?></p>
					</div>
					<?php
				}
			?>
			<form action="../backend/newGame.php" method="POST">
			  <div class="input-field">
			    <input type="text" name="nome" id="nome" />
			    <label for="nome">Título</label>
			  </div>
			  <div class="input-field">
			    <input type="submit" value="Cadastrar" class="btn" />
			  </div>
			</form>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
