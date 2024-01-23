<main role="main">

<!-- Interfaz Administrador -->
<?php if($this->ion_auth->in_group(1)): ?>

<?php endif; ?>
<!-- FIn Interfaz Administrador -->

<!-- Interfaz Supervisor -->
<?php if($this->ion_auth->in_group(2)): ?>

<?php endif; ?>
<!-- FIn Interfaz Supervisor -->

<!-- Interfaz Encuesta -->
<?php if($this->ion_auth->in_group(3)): ?>
	<br>
	<div class="container">
		<div class="row">
			<?php if(!empty($this->session->flashdata())): ?>
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" >

					<div id="mensaje-error">
						<div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
							<?php echo $this->session->flashdata('mensaje') ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">

			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('formulario/crearFormulario/');?>">
							<input type="submit" class="BOTON" value="Agregar">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores table-responsive">
				<h4>Usuario: <?php echo $usuario->username; ?></h4>
				<table id="formresp-tabla" class="table">
					<thead class="thead-dark">
					<tr id="datos">
						<th>Id</th>
						<th>Nombre Lugar</th>
						<th>Fecha</th>
						<th>Estado</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($form_abiertos as $e) {?>
						<tr>
							<td><?php echo $e->idformresp;?></td>
							<td><?php echo $e->nombre_lugar; ?></td>
							<td><?php echo $e->fecha_fc;?></td>

							<?php if($e->esta_abierto): ?>
								<td class="text-success">
									<p>Abierto</p>
								</td>
							<?php else: ?>
								<td class="text-danger">
									<p>Cerrado</p>
								</td>
							<?php endif; ?>
							<td>
								<a href="<?php echo site_url('formulario/formulariocmp/').$e->idformresp; ?>" class="btn" role="button">
									<i class="fas fa-edit"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<br>

<?php endif; ?>
<!-- FIn Interfaz Encuesta -->

</main>
