<?php
  session_start();

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    die();
  }

  include 'header.php';
?>

<div class="row" id="lobby">
  <div class="col s6 offset-s3">
    <div class="card-panel z-depth-5">
      <h4>Meus Jogos</h4> <br />
      <a class="btn blue-grey darken-2" href="newGame.php">Novo Jogo</a><br><br>
      <div class="" v-if="jogos.length > 0">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Jogo</th>
              <th>Active</th>
              <th>Winner</th>
              <th>Entrar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="jogo in jogos">
              <td>{{jogo[0]}}</td>
              <td>{{jogo[1]}}</td>
              <td>{{jogo[10]}}</td>
              <td v-if="jogo[12] == null">nobody</td>
              <td v-else-if="jogo[12] == 'img/img.png'">Vermelho</td>
              <td v-else>Azul</td>
              <td><a :href="`game.php?id=${jogo[0]}`">Entrar</a></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="" v-else>
        <br />
        <h5>Você não possui nenhum jogo criado.</h5>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
var ListaDeJogos = new Vue({
  el: "#lobby",
  data: {
    jogos: [],
  },
  mounted() {
    this.ajax();
  },
  methods: {
    ajax() {
      const me = this;
      $.ajax({
        url: '../backend/listGames.php',
        method: 'GET',
        dataType: 'json',
        success(data) {
          me.jogos = data;
          console.log(data);
        },
        error(err) {
          console.warn(err);
        }
      });
    }
  },
});
</script>
