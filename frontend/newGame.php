<?php
	session_start();

	if (!isset($_SESSION["user"])) {
		header("Location: index.php");
		die();
	}
	include 'header.php';
?>

<h4>Criar novo jogo</h4>
	<div class="row">
		<div class="col s12 m4 l2">
		</div>
		<div class="col s12 m4 l8">
			<div class="card-panel">
				<form v-on:submit="sendData($event)">
				  <div class="input-field">
				    <input type="text" v-model="title" id="nome" required/>
				    <label id="lbl" for="nome">Título</label>
				  </div>
					<div class="input-field">
				    <select id="casas">
				      <option value="" disabled selected>Board size</option>
				      <option value="8">64 casas</option>
				      <option value="10">100 casas</option>
				    </select>
  				</div>
				  <div class="input-field">
				    <input type="submit" value="Cadastrar" class="btn blue-grey darken-2" />
				  </div>
				</form>
			</div>
		</div>
		<div class="col s12 m4 l2">
		</div>
	</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
var newGame = new Vue({
	el: "#app",
	data: {
		title: '',
		board: [],
		jg1: 'img/img.png',
    jg2: 'img/img2.png',
	},
	methods: {
		sendData(event){
			event.preventDefault();
			const me = this;
			wXh = $("#casas option:selected" ).val();
			board = [];
			board = this.geraTab();
			$.ajax({
				url: "../backend/NewGame.php",
				method: "POST",
				dataType: "json",
				data: {
					title: me.title,
					board: JSON.stringify(board),
					turn: me.jg1,
					size: wXh,
				},
				success(data) {
					location.assign("lobby.php");
				},
				error(args) {
					console.error(args);
				},
			});
		},
		geraTab() {
			this.board = [];
			var wXh = $("#casas option:selected" ).val();
      for (var i = 0; i < wXh; i++) {
        var list = [];
        for (var j = 0; j < wXh; j++) {
          list.push("img/fundo.png");
        }
        this.board.push(list);
      }
      for (var i = 0; i < this.board.length; i++) {
        for (var j = 0; j < this.board[i].length; j++) {
          if (this.board.length == 10) {
            if (i == this.board.length -4) {
              if (j % 2 != 0) {
                this.board[i][j] = this.jg1;
              }
            }
            if (i == 3) {
              if (j % 2 == 0) {
                this.board[i][j] = this.jg2;
              }
            }
          }
          if (i == 1) {
            if (j % 2 == 0) {
              this.board[i][j] = this.jg2;
            }
          } else if (i == 0 || i == 2) {
            if (j % 2 != 0){
              this.board[i][j] = this.jg2;
            }
          } else if (i == this.board.length -2) {
            if (j % 2 != 0) {
              this.board[i][j] = this.jg1;
            }
          } else if (i == this.board.length -1 || i == this.board.length -3) {
            if (j % 2 == 0) {
              this.board[i][j] = this.jg1;
            }
          }
        }
      }
			return this.board;
    },
	},
});
</script>
