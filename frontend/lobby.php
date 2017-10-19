<?php
  session_start();
  include 'header.php';
?>

<div class="row" id="lobby">
  <div class="col s6 offset-s3">
    <div class="card-panel">
      <h4>Meus Jogos</h4>
      <a class="btn blue-grey darken-2" href="newGame.php">Novo Jogo</a>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Jogo</th>
            <th>Entrar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="jogo in jogos">
            <td>{{jogo[0]}}</td>
            <td>{{jogo[1]}}</td>
            <td><a :href="`game.php?id=${jogo[0]}`">Entrar</a></td>
          </tr>
        </tbody>
      </table>
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
