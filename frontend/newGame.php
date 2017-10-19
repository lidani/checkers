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
			<form v-on:submit="sendData()">
			  <div class="input-field">
			    <input type="text" v-model="nome" id="nome" required/>
			    <label for="nome">Título</label>
			  </div>
				<select v-model="wXh">
				  <option disabled value="">Escolha um item</option>
				  <option>A</option>
				  <option>B</option>
				  <option>C</option>
				</select>
			  <div class="input-field">
			    <input type="submit" value="Cadastrar" class="btn blue-grey darken-2" />
			  </div>
			</form>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
var newGame = new Vue({
	el: "#app",
	data: {
		nome: '',
		tabuleiro: [],
		wXh: 8,
		jg1: 'img/img.png',
    jg2: 'img/img2.png',
	},
	mounted() {
		this.geraTab();
	},
	methods: {
		sendData(){
			const me = this;
			$.ajax({
				url: "../backend/NewGame.php",
				method: "POST",
				dataType: "json",
				data: {
					nome: me.nome,
					tabuleiro: JSON.stringify(me.tabuleiro),
					vez: "img/img.png",
				},
				success(data) {
					console.log(data);
				},
				error(args) {
					toastr.error("Erro");
					console.warn("erro", args);
				},
			});
		},
		geraTab() {
      for (var i = 0; i < this.wXh; i++) {
        var list = [];
        for (var j = 0; j < this.wXh; j++) {
          list.push("img/fundo.png");
        }
        this.tabuleiro.push(list);
      }
      for (var i = 0; i < this.tabuleiro.length; i++) {
        for (var j = 0; j < this.tabuleiro[i].length; j++) {
          if (this.tabuleiro.length == 10) {
            if (i == this.tabuleiro.length -4) {
              if (j % 2 != 0) {
                this.tabuleiro[i][j] = this.jg1;
              }
            }
            if (i == 3) {
              if (j % 2 == 0) {
                this.tabuleiro[i][j] = this.jg2;
              }
            }
          }
          if (i == 1) {
            if (j % 2 == 0) {
              this.tabuleiro[i][j] = this.jg2;
            }
          } else if (i == 0 || i == 2) {
            if (j % 2 != 0){
              this.tabuleiro[i][j] = this.jg2;
            }
          } else if (i == this.tabuleiro.length -2) {
            if (j % 2 != 0) {
              this.tabuleiro[i][j] = this.jg1;
            }
          } else if (i == this.tabuleiro.length -1 || i == this.tabuleiro.length -3) {
            if (j % 2 == 0) {
              this.tabuleiro[i][j] = this.jg1;
            }
          }
        }
      }
			console.log(this.tabuleiro);
    },
	},
});
</script>
