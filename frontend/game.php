<?php
  session_start();
  include './headerGame.php';

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    die();
  }

  if (array_key_exists("id", $_GET)) {
    $_SESSION["gameId"] = $_GET["id"];

?>

<div v-if="exists">
  <h5 class="blue-text" v-if="jogador == jg2 &amp;&amp; winner_id == null &amp;&amp; winner != -1">Vez do jogador Azul</h5>
    <h5 class="red-text" v-else-if="jogador == jg1 &amp;&amp; winner_id == null &amp;&amp; winner != -1">Vez do jogador Vermelho</h5>
    <div v-if="winner_id == null &amp;&amp; winner != -1" class="score">
      <span class="red-text">{{pontosJogador1}}</span> X <span class="blue-text">{{pontosJogador2}}</span>
    </div>
    <div v-else class="score">
      <h5 v-if="winner == jg1" class="red-text">Jogador Vermelho Venceu!</h5>
      <h5 v-if="winner == jg2" class="blue-text">Jogador Azul Venceu!</h5>
      <h5 v-if="winner == -1" class="black-text">Empate</h5>
      <a class="btn blue-grey darken-2" href="lobby.php">Voltar ao lobby</a>
    </div>
    <div class="tabuleiro">
      <div v-for="campo, i in campos">
        <div v-if="i % 2 == 0">
          <span v-for="pos, j in campo">
            <span v-on:click="clicks = 0; remover()" class="casa par" v-if="j % 2 == 0 &amp;&amp; i % 2 == 0"><img :src="pos"></span>
            <span v-on:click="getIndex(i, j, this);" class="casa impar" v-else><img :src="pos"></span>
          </span>
        </div>
        <div v-else>
          <span v-for="pos, j in campo">
            <span v-on:click="getIndex(i, j, this);" class="casa impar" v-if="j % 2 == 0"><img :src="pos"></span>
            <span v-on:click="clicks = 0; remover();" class="casa par" v-else><img :src="pos"></span>
          </span>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<div v-else class="card red lighten-2">
  <div class="card-content">
    <h5 class="center">Jogo não encontrado</h5>
  </div>
</div>
<?php include './footerGame.php'; ?>
