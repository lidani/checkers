<?php include './headerGame.php' ?>

  <h5 class="blue-text" v-if="jogador == 'img/img2.png' &amp;&amp; !won()">Vez do jogador: Azul, Clicks: {{clicks}}</h5>
  <h5 class="red-text" v-else-if="jogador == 'img/img.png' &amp;&amp; !won()">Vez do jogador: Vermelho, Clicks: {{clicks}}</h5>
  <div v-if="!won()" class="score">
    <span class="red-text">{{pontosJogador1}}</span> X <span class="blue-text">{{pontosJogador2}}</span>
  </div>
  <div v-else class="score">
    <h5 v-if="vencedor == 1" class="red-text">Jogador Vermelho Venceu!</h5>
    <h5 v-if="vencedor == 2" class="blue-text">Jogador Azul Venceu!</h5>
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

<?php include './footer.php' ?>
