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
  </div>

  <div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div v-if="myGames.length > 0" class="col s12 m4 l8">
      <h5 class="center">Meus jogos</h5>
      <ul class="collapsible" data-collapsible="accordion">
        <li v-for="game in myGames">
          <div class="collapsible-header"><i class="material-icons">games</i>{{game[1]}}</div>
          <div class="collapsible-body">
            <span>
              <a class="btn blue-grey darken-2" :href="`game.php?id=${game[0]}`">Entrar na partida</a><br><br>
              <span v-if="game[5] == 0">Status: Sem ganhador</span>
              <span v-else-if="game[5] == 1">Status: Finalizado</span>
              <span v-else-if="game[5] == 2">Status: Empate</span>
              <br><span>Tamanho: {{game[4]}}</span><br>
              <span>Ativo: {{game[10]}}</span><br>
              <span v-if="game[14] == null">Vencedor: ninguém</span>
              <span v-else>Vencedor: {{game[14]}}</span>
            </span>
          </div>
        </li>
      </ul>
    </div>
    <div class="col s12 m4 l8" v-else>
      <h5 class="center">Você nao possui jogos criados</h5>
    </div>
    <div class="col s12 m4 l2">
    </div>
  </div>
  <br><hr><br>

  <div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div v-if="friendsGames.length > 0" class="col s12 m4 l8">
      <h5 class="center">Jogos dos amigos</h5>
      <ul class="collapsible" data-collapsible="accordion">
        <li v-for="game in friendsGames">
          <div class="collapsible-header"><i class="material-icons">games</i>{{game[1]}}</div>
          <div class="collapsible-body">
            <span>
              <a class="btn blue-grey darken-2" :href="`game.php?id=${game[0]}`">Entrar na partida</a><br><br>
              <span v-if="game[5] == 0">Status: Não finalizado</span>
              <span v-else-if="game[5] == 1">Status: Finalizado</span>
              <span v-else-if="game[5] == 2">Status: Empate</span>
              <br><span>Tamanho: {{game[4]}}</span><br>
              <span>Ativo: {{game[10]}}</span><br>
              <span v-if="game[14] == null">Vencedor: ninguém</span>
              <span v-else>Vencedor: {{game[14]}}</span>
            </span>
          </div>
        </li>
      </ul>
    </div>
    <div class="col s12 m4 l8" v-else>
      <h5 class="center">Nenhum amigo possui jogos criados</h5>
    </div>
    <div class="col s12 m4 l2">
    </div>
  </div>
  <br><hr><br>

  <div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div v-if="gamesFinalized.length > 0" class="col s12 m4 l8">
      <h5 class="center">Meus jogos finalizados</h5>
      <ul class="collapsible" data-collapsible="accordion">
        <li v-for="game in gamesFinalized">
          <div class="collapsible-header"><i class="material-icons">games</i>{{game[1]}}</div>
          <div class="collapsible-body">
            <span>
              <a class="btn blue-grey darken-2" :href="`game.php?id=${game[0]}`">Entrar na partida</a><br><br>
              <span v-if="game[5] == 0">Status: Não finalizado</span>
              <span v-else-if="game[5] == 1">Status: Finalizado</span>
              <span v-else-if="game[5] == 2">Status: Empate</span>
              <br><span>Tamanho: {{game[4]}}</span><br>
              <span>Ativo: {{game[10]}}</span><br>
              <span v-if="game[14] == null">Vencedor: ninguém</span>
              <span v-else>Vencedor: {{game[14]}}</span>
            </span>
          </div>
        </li>
      </ul>
    </div>
    <div class="col s12 m4 l8" v-else>
      <h5 class="center">Você não possui jogos finalizados</h5>
    </div>
    <div class="col s12 m4 l2">
    </div>
  </div>
  <br><hr><br>

  <div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div v-if="gamesIAlreadyPlayed.length > 0" class="col s12 m4 l8">
      <h5 class="center">Jogos dos amigos que já joguei</h5>
      <ul class="collapsible" data-collapsible="accordion">
        <li v-for="game in gamesIAlreadyPlayed">
          <div class="collapsible-header"><i class="material-icons">games</i>{{game[1]}}</div>
          <div class="collapsible-body">
            <span>
              <a class="btn blue-grey darken-2" :href="`game.php?id=${game[0]}`">Entrar na partida</a><br><br>
              <span v-if="game[5] == 0">Status: Não finalizado</span>
              <span v-else-if="game[5] == 1">Status: Finalizado</span>
              <span v-else-if="game[5] == 2">Status: Empate</span>
              <br><span>Tamanho: {{game[4]}}</span><br>
              <span>Ativo: {{game[10]}}</span><br>
              <span v-if="game[14] == null">Vencedor: ninguém</span>
              <span v-else>Vencedor: {{game[14]}}</span>
            </span>
          </div>
        </li>
      </ul>
    </div>
    <div class="col s12 m4 l8" v-else>
      <h5 class="center">Nenhum amigo possui jogos que você jogou</h5>
    </div>
    <div class="col s12 m4 l2">
    </div>
  </div>
  <br><hr><br>
</div>

<?php include 'footer.php'; ?>

<script>
$(document).ready(function(){
  $('.collapsible').collapsible();
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
  updated() {
    $('.collapsible').collapsible();
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
          setTimeout(function() { me.listGames() }, 3000);
        },
        error(args) {
          console.error(args);
        }
      });
    }
  },
});
</script>
