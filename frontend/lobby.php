<?php
  session_start();

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    die();
  }

  include 'header.php';
?>

<div class="row" id="lobby">
  <h4>Meus Jogos</h4><br>
  <a class="btn blue-grey darken-2" href="newGame.php">Novo Jogo</a><br><br><hr><br>
  <div class="col s12 m4 l2">
  </div>
  <div class="col s12 m4 l8">
    <div class="card-panel z-depth-5">
      <div class="" v-if="myGames.length > 0 || friendsGames.length > 0 || gamesIAlreadyPlayed.length > 0 || gamesFinalized.length > 0">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Status</th>
              <th>Size</th>
              <th>Winner</th>
              <th>Join</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="jogo in myGames">
              <td>{{jogo[0]}}</td>
              <td>{{jogo[1]}}</td>
              <td v-if="jogo[5] == 0">Não finalizado</td>
              <td v-else>Finalizado</td>
              <td>{{jogo[4]}}</td>
              <td v-if="jogo[14] == null">nobody</td>
              <td v-else>{{jogo[14]}}</td>
              <td><a :href="`game.php?id=${jogo[0]}`">Go</a></td>
            </tr>
            <tr v-for="jogo in friendsGames">
              <td>{{jogo[0]}}</td>
              <td>{{jogo[1]}}</td>
              <td v-if="jogo[5] == 0">Não finalizado</td>
              <td v-else>Finalizado</td>
              <td>{{jogo[4]}}</td>
              <td v-if="jogo[14] == null">nobody</td>
              <td v-else>{{jogo[14]}}</td>
              <td><a :href="`game.php?id=${jogo[0]}`">Go</a></td>
            </tr>
            <tr v-for="jogo in gamesIAlreadyPlayed">
              <td>{{jogo[0]}}</td>
              <td>{{jogo[1]}}</td>
              <td v-if="jogo[5] == 0">Não finalizado</td>
              <td v-else>Finalizado</td>
              <td>{{jogo[4]}}</td>
              <td v-if="jogo[14] == null">nobody</td>
              <td v-else>{{jogo[14]}}</td>
              <td><a :href="`game.php?id=${jogo[0]}`">Go</a></td>
            </tr>
            <tr v-for="jogo in gamesFinalized">
              <td>{{jogo[0]}}</td>
              <td>{{jogo[1]}}</td>
              <td v-if="jogo[5] == 0">Não finalizado</td>
              <td v-else>Finalizado</td>
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
    myGames: [],
    friendsGames: [],
    gamesIAlreadyPlayed: [],
    gamesFinalized: []
  },
  mounted() {
    this.listGames();
  },
  methods: {
    listGames() {
      const me = this;
      $.ajax({
        url: '../backend/listGames.php',
        method: 'GET',
        dataType: 'json',
        success(data) {
          console.log(data);
          if (data[0].length > 0) {
            me.myGames = data[0][0];
          }
          if (data[1].length > 0) {
            me.friendsGames = data[1][0];
          }
          if (data[2].length > 0) {
            me.gamesIAlreadyPlayed = data[2][0];
          }
          if (data[3].length > 0) {
            me.gamesFinalized = data[3][0];
          }
        },
        error(args) {
          console.error(args);
        }
      });
    }
  },
});
</script>
