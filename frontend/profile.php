<?php
  session_start();
  include 'header.php';
?>
<?php
  if (array_key_exists("id", $_GET)) { $id = $_GET["id"]; ?>
  <div class="" id="user_profile">
    <div class="" v-if="exists">
      <div class="col s12 m4 l2">
  		</div>
      <div class="card col s12 m4 l8">
        <div class="card-content">
          <h5 class="left-align">Nome: {{user[1]}}</h5>
          <h5 class="left-align">E-mail: {{user[2]}}</h5>
          <h5 class="left-align">Vitórias: {{user[4]}}</h5>
        </div>
      </div>
      <div class="col s12 m4 l2">
  		</div>
    </div>
    <div class="" v-else>
      <div class="col s12 m4 l2">
      </div>
      <div class="card col s12 m4 l8 red lighten-2">
        <div class="card-content">
          <h5 class="center">Usuário não encontrado</h5>
        </div>
      </div>
      <div class="col s12 m4 l2">
  		</div>
    </div>
  </div>

  <?php } else { ?>
    <div class="col s12 m4 l2">
    </div>
    <div class="card col s12 m4 l8 red lighten-2">
      <div class="card-content">
        <h5 class="center">Usuário não encontrado</h5>
      </div>
    </div>
    <div class="col s12 m4 l2">
    </div>
  <?php } ?>

<?php include 'footer.php'; ?>

<script type="text/javascript">
  var kkeaemen = new Vue({
    el: "#user_profile",
    data: {
      user: [],
      exists: false,
    },
    mounted() {
      const me = this;
      $.ajax({
        url: "../backend/getUserLogged.php",
        method: "GET",
        dataType: "json",
        data: {
          id: <?php echo $id; ?>
        },
        success(data) {
          console.log(data);
          if (data.length > 0) {
            me.exists = true;
            me.user = data[0];
          } else {
            me.exists = false;
          }
        },
        error(args) {
          console.error(args);
          me.exists = false;
        }
      });
    }
  });
</script>
