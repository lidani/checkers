<?php
  session_start();
  include 'header.php';
?>

<?php
  if (array_key_exists("id", $_GET)) { $id = $_GET["id"]; ?>
    <div id="user_profile" class="row">
      <div class="col s12 m4 l2">
  		</div>
      <div class="card col s12 m4 l8" v-if="user.length > 0">
        <div class="card-content">
          <h5 class="left-align">Nome: {{user[1]}}</h5>
          <h5 class="left-align">E-mail: {{user[2]}}</h5>
          <h5 class="left-align">Vitórias: {{user[4]}}</h5>
        </div>
      </div>
      <div class="col s12 m4 l2">
  		</div>

<?php } else { ?>

      <div class="col s12 m4 l2">
      </div>
      <div v-else class="card col s12 m4 l8 red lighten-2">
        <div class="card-content">
          <h5>Usuário não encontrado</h5>
        </div>
      </div>
      <div class="col s12 m4 l2">
  		</div>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>

<script type="text/javascript">
  var kkeaemen = new Vue({
    el: "#user_profile",
    data: {
      user: [],
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
          me.user = data[0];
        },
        error(args) {
          console.error(args);
        }
      });
    }
  });
</script>
