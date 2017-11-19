<?php
  session_start();

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    die();
  }

  include 'header.php';
?>

<div class="row" id="lobby">
  <h4 class="center">Meus Jogos</h4><br>
  <div class="center">
    <a class="btn blue-grey darken-2" href="newGame.php">Novo Jogo</a><br><br><hr><br>
    <a class="btn blue-grey darken-2 modal-trigger" href="#myGames">My games</a>
    <a class="btn blue-grey darken-2 modal-trigger" href="#gamesFinalized">Jogos finalizados</a>
    <a class="btn blue-grey darken-2 modal-trigger" href="#friendsGames">Friends</a>
    <a class="btn blue-grey darken-2 modal-trigger" href="#friendsFinalized">Friends Finalized</a>
  </div>
  <div class="col s12 m4 l2">
  </div>
  <div class="col s12 m4 l8">
    <div id="myGames" class="modal">
      <div v-if="myGames.length > 0" class="modal-content">
        <ul class="collapsible" data-collapsible="accordion">
          <li v-for="game in myGames">
            <div class="collapsible-header"><i class="material-icons">games</i>{{game[1]}}</div>
            <div class="collapsible-body">
              <span>
                <a class="btn blue-grey darken-2" :href="`game.php?id=${game[0]}`">Entrar na partida</a><br><br>
                <span v-if="game[5] == 0">Status: Não finalizado</span>
                <span v-else-if="game[5] == 1">Status: Finalizado</span>
                <span v-else-if="game[5] == 2">Status: Empate</span>
                <br><span>Tamanho: {{game[4]}}</span><br>
                <span v-if="game[14] == null">Vencedor: ninguém</span>
                <span v-else>Vencedor: {{game[14]}}</span>
              </span>
            </div>
          </li>
        </ul>
      </div>
      <div v-else class="modal-content">
        <h5>Você não possui nenhum jogo criado</h5>
      </div>
    </div>

    <div id="friendsGames" class="modal">
      <div v-if="friendsGames.length > 0" class="modal-content">
        <ul class="collapsible" data-collapsible="accordion">
          <li v-for="game in friendsGames">
            <div class="collapsible-header"><i class="material-icons">games</i>{{game[1]}}</div>
            <div class="collapsible-body">
              <span>
                <a class="btn blue-grey darken-2" :href="`game.php?id=${game[0]}`">Entrar na partida</a><br><br>
                <span v-if="game[5] == 0">Status: Não finalizado</span>
                <span v-else-if="game[5] == 1">Status: Empate</span>
                <span v-else-if="game[5] == 2">Status: Finalizado</span>
                <br><span>Tamanho: {{game[4]}}</span><br>
                <span v-if="game[14] == null">Vencedor: ninguém</span>
                <span v-else>Vencedor: {{game[14]}}</span>
              </span>
            </div>
          </li>
        </ul>
      </div>
      <div v-else class="modal-content">
        <h5>Seus amigos não possuem jogos prontos para jogar</h5>
      </div>
    </div>

    <div id="friendsFinalized" class="modal">
      <div v-if="gamesIAlreadyPlayed.length > 0" class="modal-content">
        <ul class="collapsible" data-collapsible="accordion">
          <li v-for="game in gamesIAlreadyPlayed">
            <div class="collapsible-header"><i class="material-icons">games</i>{{game[1]}}</div>
            <div class="collapsible-body">
              <span>
                <a class="btn blue-grey darken-2" :href="`game.php?id=${game[0]}`">Entrar na partida</a><br><br>
                <span v-if="game[5] == 0">Status: Não finalizado</span>
                <span v-else-if="game[5] == 1">Status: Empate</span>
                <span v-else-if="game[5] == 2">Status: Finalizado</span>
                <br><span>Tamanho: {{game[4]}}</span><br>
                <span v-if="game[14] == null">Vencedor: ninguém</span>
                <span v-else>Vencedor: {{game[14]}}</span>
              </span>
            </div>
          </li>
        </ul>
      </div>
      <div v-else class="modal-content">
        <h5>Nenhum jogo amigo jogado anteriormente</h5>
      </div>
    </div>

    <div id="gamesFinalized" class="modal">
      <div v-if="gamesFinalized.length > 0" class="modal-content">
        <ul class="collapsible" data-collapsible="accordion">
          <li v-for="game in gamesFinalized">
            <div class="collapsible-header"><i class="material-icons">games</i>{{game[1]}}</div>
            <div class="collapsible-body">
              <span>
                <a class="btn blue-grey darken-2" :href="`game.php?id=${game[0]}`">Entrar na partida</a><br><br>
                <span v-if="game[5] == 0">Status: Não finalizado</span>
                <span v-else-if="game[5] == 1">Status: Empate</span>
                <span v-else-if="game[5] == 2">Status: Finalizado</span>
                <br><span>Tamanho: {{game[4]}}</span><br>
                <span v-if="game[14] == null">Vencedor: ninguém</span>
                <span v-else>Vencedor: {{game[14]}}</span>
              </span>
            </div>
          </li>
        </ul>
      </div>
      <div v-else class="modal-content">
        <h5>Você não possui nenhum jogo finalizado</h5>
      </div>
    </div>

  </div>
  <div class="col s12 m4 l2">
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
$(document).ready(function(){
  $('.collapsible').collapsible();
  $('.modal').modal();
});
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
