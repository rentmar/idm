<main role="main" >
	<br>
	<div class="container">
		<div class="row">

			<?php if($this->ion_auth->is_admin()): ?>
				<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="card">
						<div class="card-header" style="background-color:#7f182b;color:white">
							<h4>Encuestas</h4>
						</div>
						<img class="card-img-top" src="<?php echo base_url().'assets/img/Administrarnoticias.svg'; ?>" alt="Card image">
						<div class="card-body">
							<a href="<?php echo site_url('encuesta/formulariosEncuesta');?>" class="BOTON" role="button">
								Ir
							</a>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if($this->ion_auth->is_admin()): ?>
				<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
					<div class="card">
						<div class="card-header" style="background-color:#7f182b;color:white">
							<h4>Asignar Encuesta</h4>
						</div>
						<img class="card-img-top" src="<?php echo base_url().'assets/img/Administrarnoticias.svg'; ?>" alt="Card image">
						<div class="card-body">
							<a href="<?php echo site_url('encuesta/encuestaAusuarios');?>" class="BOTON" role="button">
								Ir
							</a>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if($this->ion_auth->is_admin()): ?>
			<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
				<div class="card">
					<div class="card-header" style="background-color:#7f182b;color:white">
						<h4>Reportes Encuesta</h4>
					</div>
					<img class="card-img-top" src="<?php echo base_url().'assets/img/repcomp.svg'; ?>" alt="Card image">
					<div class="card-body">
						<a href="<?php echo site_url('encuesta/reportesEncuesta');?>" class="BOTON" role="button">
							Ir
						</a>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<br>
</main>


