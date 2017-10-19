  </div>

<script type="text/javascript" src="../libs/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../libs/js/materialize.min.js"></script>
<script type="text/javascript" src="../js/toastr.min.js"></script>
<script type="text/javascript" src="../libs/js/vue.js"></script>
<script type="text/javascript">
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
            toastr.success(data);
            setTimeout(function() { location.assign("login.php"); }, 500);
          },
          error(args) {
            toastr.error(args.responseText);
          }
        });
      }
    },
  });
</script>
</body>
</html>
