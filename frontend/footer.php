  </div>

<script type="text/javascript" src="../libs/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../libs/js/materialize.min.js"></script>
<script type="text/javascript" src="../libs/js/vue.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".button-collapse").sideNav();
    $('select').material_select();
  });
  var Logout = new Vue({
    el: "#logout",
    data: {
    },
    methods: {
      doLogout(event) {
        event.preventDefault();
        const me = this;
        $.ajax({
          url: "../backend/logout.php",
          method: "POST",
          dataType: "json",
          success(data) {
            location.assign("login.php");
          },
          error(args) {
            console.error(args.responseText);
          }
        });
      }
    },
  });
</script>
</body>
</html>
