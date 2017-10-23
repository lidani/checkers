<?php
	include 'header.php';
	session_start();
?>

<div class="row" id="register">
	<h4>Faça seu cadastro</h4>
	<div class="col s12 m4 l2">
	</div>
	<div class="col s12 m4 l8">
		<div class="card-panel">
			<form v-on:submit="doRegister($event)">
			  <div class="input-field">
			    <input type="text" v-model="name" id="name" required/>
			    <label id="lbl" for="name">Nome completo</label>
			  </div>
				<div class="input-field">
			    <input type="text" v-model="nickname" id="nickname" required/>
			    <label id="lbl" for="nickname">Apelido</label>
			  </div>
			  <div class="input-field">
			    <input type="email" v-model="email" id="email" required/>
			    <label id="lbl" for="email">E-mail</label>
			  </div>
			  <div class="input-field">
			    <input type="password" v-model="password" id="password" required/>
			    <label id="lbl" for="password">Senha</label>
			  </div>
			  <div class="input-field">
			    <input type="password" v-model="cpassword" id="cpassword" required/>
			    <label id="lbl" for="cpassword">Confirme a senha</label>
			  </div>
			  <div class="input-field">
			    <input type="submit" value="Cadastrar" class="btn blue-grey darken-2" />
			  </div>
			</form>
		</div>
	</div>
	<div class="col s12 m4 l2">
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
			nickname: '',
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
							nickname: this.nickname,
						},
						success(data) {
							toastr.success(data);
							setTimeout(function() { location.assign("login.php"); }, 500);
						},
						error(args) {
							console.error(args);
							toastr.error(args.responseText);
						},
					});
				} else {
					toastr.warn("Senhas diferentes");
				}
			}
		}
	});
</script>
