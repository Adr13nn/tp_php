<?php 
$taches = $toTemplate["datas"];

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<a href="#" id="login-form-link">Se déconnecter</a>
						</div>
						<div class="col-xs-6">
							<a href="index.php?route=accueil" class="active" id="register-form-link">Accueil</a>
						</div>
					</div>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<form id="login-form" action="index.php?route=insertTache" method="POST" role="form" style="display: block;">
								<div class="form-group">
								<input type="text" placeholder="Tâche à réaliser" name="choixTache">
    							<label for="deadline">Avant le : </label>
    							<input type="date" name="choixDate" id="choixDate">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Valider">
										</div>
									</div>
								</div>
							</form>
							<form id="register-form" action="index.php?route=accueil" method="post" role="form" style="display: none;">
								<div class="form-group">
									<input type="text" name="pseudo" id="pseudo" tabindex="1" class="form-control" placeholder="pseudo" value="">
								</div>
								<div class="form-group">
									<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
								</div>
								<div class="form-group">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
								</div>
								<div class="form-group">
									<input type="password" name="confirm-password" id="confirmez votre mot de passe">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div>

			<p>Liste des tâches a effectuer :</p> 
	
				<hr style="background: blue;">
				<ul>
					<?php foreach($taches as $tache):?>
						<li><?= $tache->description ?><strong style="color: red;"> avant le :</strong> <?= $tache->date_limite ?></li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</div>