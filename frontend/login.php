<?php
	session_start();

	if (isset($_SESSION["user"])) {
		header("Location: index.php");
		die();
	}

	include 'header.php';
?>
<h4>Faça seu login</h4>
	<div class="row">
		<div class="col s12 m4 l2">
		</div>
		<div class="col s12 m4 l8">
			<div class="card-panel">
				<form v-on:submit="doLogin($event)">
	        <div class="input-field">
	          <input type="text" v-model="email" id="email" required/>
	          <label id="lbl" for="email">E-mail ou apelido</label>
	        </div>
		        <div class="input-field">
		          <input type="password" v-model="password" id="password" required/>
		          <label id="lbl" for="password">Senha</label>
		        </div>
	        <div class="input-field">
	          <input type="submit" value="Login" class="btn blue-grey darken-2" />
	        </div>
	      </form>
	    </div>
		</div>
		<div class="col s12 m4 l2">
		</div>
	</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
	var Login = new Vue({
		el: "#app",
		data: {
			email: '',
			password: '',
		},
		methods: {
			doLogin(event) {
				event.preventDefault();
				const me = this;
				$.ajax({
					url: "../backend/authentication.php",
					method: "POST",
					dataType: "json",
					data: {
						email: me.email,
						password: me.password,
					},
					success(data) {
						location.assign('index.php');
					},
					error(args) {
						console.error(args);
					}
				});
			},
		}
	});
</script>
