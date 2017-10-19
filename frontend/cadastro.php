<?php
	include 'header.php';
	session_start();
?>

<div class="row" id="register">
	<div class="col s6 offset-s3">
		<div class="card-panel">
			<h4>Faça seu cadastro</h4>
			<form v-on:submit="doRegister($event)">
			  <div class="input-field">
			    <input type="text" v-model="name" id="name" required/>
			    <label for="name">Nome completo</label>
			  </div>
			  <div class="input-field">
			    <input type="email" v-model="email" id="email" required/>
			    <label for="email">E-mail</label>
			  </div>
			  <div class="input-field">
			    <input type="password" v-model="password" id="password" required/>
			    <label for="password">Senha</label>
			  </div>
			  <div class="input-field">
			    <input type="password" v-model="cpassword" id="cpassword" required/>
			    <label for="cpassword">Confirme a senha</label>
			  </div>
			  <div class="input-field">
			    <input type="submit" value="Cadastrar" class="btn blue-grey darken-2" />
			  </div>
			</form>
		</div>
	</div>
</dvi>

<?php include 'footer.php'; ?>

<script type="text/javascript">
	var Register = new Vue({
		el: "#register",
		data: {
			name: '',
			email: '',
			password: '',
			cpassword: '',
		},
		methods: {
			doRegister(event) {
				event.preventDefault();
				const me = this;
				if (this.password === this.cpassword) {
					$.ajax({
						url: "../backend/register.php",
						method: "POST",
						dataType: "json",
						data: {
							name: this.name,
							email: this.email,
							password: this.password,
						},
						success(data) {
							toastr.success(data);
							setTimeout(function() { location.assign("login.php"); }, 500);
						},
						error(args) {
							console.error(args);
							toastr.error(data);
						},
					});
				} else {
					toastr.error("As senhas estão diferentes");
				}
			}
		}
	});
</script>
