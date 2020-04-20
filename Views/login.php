<?php $title= "Se connecter / Admin";
	
?>
<?php ob_start(); ?>	
<section id="login" class="container mt-4">
	<div class="card card-container">
		<h2 class="card-header">Connexion</h2>
		<div class="card-body">
			<div class="login-form">
				<form action="?action=login" method="post">
					<div class="form-group">
						<label for="pseudo">Pseudo :</label>
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
</section>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
