<main role="main" >
<br>
<div class="container">
    <div class="row">
        	<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        <div class="card-header" style="background-color:#7f182b;color:white">
                            TABLA MONITORES <br>
                            Nombre y Cuestionario
                            </div>
                        <img class="card-img-top" src="<?php echo base_url().'assets/img/seguimiento.svg'; ?>" alt="Card image">
                        <div class="card-body">
                            <a href="<?php echo site_url('Seguimientomonitores/EstadoObservacionElectoral');?>" class="BOTON" role="button">Ver</a>
                        </div>
                    </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        <div class="card-header" style="background-color:#7f182b;color:white">
                            TABLA MONITORES <br>
                            Universidad Cuestionario
                            </div>
                        <img class="card-img-top" src="<?php echo base_url().'assets/img/universidad.svg'; ?>" alt="Card image">
                        <div class="card-body">
                            <a href="<?php echo site_url('Seguimientomonitores/EstadoObservacionElectoralXuniversidad');?>" class="BOTON" role="button">Ver</a>
                        </div>
                    </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                    <div class="card">
                        <div class="card-header" style="background-color:#7f182b;color:white">
                            TABLA MONITORES <br>
                            Depto Cuestionario
                        </div>
                        <img class="card-img-top" src="<?php echo base_url().'assets/img/departamento.svg'; ?>" alt="Card image">
                        <div class="card-body">
                            <a href="<?php echo site_url('Seguimientomonitores/CuestionariosPorDepartamentoUsuario');?>" class="BOTON" role="button">Ver</a>
                        </div>
                    </div>
        </div>
		<?php if($this->ion_auth->is_admin()): ?>
		<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
			<div class="card">
				<div class="card-header" style="background-color:#7f182b;color:white">
					TABLA MONITORES <br>
					Leyes
				</div>
				<img class="card-img-top" src="<?php echo base_url().'assets/img/departamento.svg'; ?>" alt="Card image">
				<div class="card-body">
					<a href="<?php echo site_url('Seguimientomonitores/leyesTabla/');?>" class="BOTON" role="button">
						Ver
					</a>
				</div>
			</div>
		</div>
		<?php endif; ?>

    </div>
</div>
</main>
