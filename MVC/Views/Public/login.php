<?php $title= "Se connecter";
	
?>
<?php ob_start(); ?>	
<section id="login" class="pt-2 pb-4">
	<div class="container mt-4">
		<div class="card card-container">
			<h2 class="card-header">Connexion</h2>
			<div class="card-body">
				<div class="login-form">
					<form action="https://projetsls.fr/SPA-Chamalieres/Connection" method="post">
						<div class="form-group">
							<label for="pseudo">Pseudonyme :</label>
							<input name="name" type="text" id="name" class="form-control" required/>
						</div>
						<div class="form-group">
							<label for="password">Mot de Passe :</label>
							<input type="password" name="password" id="password" class="form-control" required/>
						</div>
						<input type="submit" name="connection" class="btn btn-primary" value="Connexion"/>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('MVC/Views/template.php'); ?>