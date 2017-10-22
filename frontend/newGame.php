<?php
	session_start();

	if (!isset($_SESSION["user"])) {
		header("Location: index.php");
		die();
	}
	include 'header.php';
?>

	<div class="row">
		<div class="card col s6 offset-s3">
			<div class="card-content">
				<h4>Criar novo jogo</h4>
				<form v-on:submit="sendData($event)">
				  <div class="input-field">
				    <input type="text" v-model="title" id="nome" required/>
				    <label for="nome">Título</label>
				  </div>
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
		title: '',
		wXh: 8,
		board: [],
		jg1: 'img/img.png',
    jg2: 'img/img2.png',
	},
	created() {
		this.geraTab();
	},
	methods: {
		sendData(event){
			event.preventDefault();
			const me = this;
			$.ajax({
				url: "../backend/NewGame.php",
				method: "POST",
				dataType: "json",
				data: {
					title: me.title,
					board: JSON.stringify(me.board),
					turn: me.jg1,
				},
				success(data) {
					console.log(data);
					toastr.success(data);
					setTimeout(function() { location.assign("lobby.php"); }, 500);
				},
				error(args) {
					toastr.error(args.responseText);
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
    },
	},
});
</script>
