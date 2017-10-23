<?php
  session_start();

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    die();
  }

  include 'header.php';
?>

<div class="row" id="lobby">
  <h4>Meus Jogos</h4> <br />
  <div class="col s12 m4 l2">
  </div>
  <div class="col s12 m4 l8">
    <div class="card-panel z-depth-5">
      <a class="btn blue-grey darken-2" href="newGame.php">Novo Jogo</a><br><br><hr><br>
      <div class="" v-if="jogos.length > 0">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Size</th>
              <th>Winner</th>
              <th>Join</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="jogo in jogos">
              <td>{{jogo[0]}}</td>
              <td>{{jogo[1]}}</td>
              <td>{{jogo[4]}}</td>
              <td v-if="jogo[14] == null">nobody</td>
              <td v-else>{{jogo[14]}}</td>
              <td><a :href="`game.php?id=${jogo[0]}`">Go</a></td>
            </tr>
            <tr v-for="jogo in jogos2">
              <td>{{jogo[0]}}</td>
              <td>{{jogo[1]}}</td>
              <td>{{jogo[4]}}</td>
              <td v-if="jogo[14] == null">nobody</td>
              <td v-else>{{jogo[14]}}</td>
              <td><a :href="`game.php?id=${jogo[0]}`">Go</a></td>
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
  <div class="col s12 m4 l2">
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
var ListaDeJogos = new Vue({
  el: "#lobby",
  data: {
    jogos: [],
    jogos2: [],
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
          console.log(data);
          if (data.length > 0) {
            if (data[0].length > 0) {
              me.jogos = data[0][0];
              me.jogos2 = data[0][1];
              if (data[0][1].length >= data[0][0].length) {
                me.jogos = data[0][1];
              } else {
                me.jogos = data[0][0];
              }
              console.log(me.jogos);
            }
          }
        },
        error(err) {
          console.warn(err);
        }
      });
    }
  },
});
</script>
