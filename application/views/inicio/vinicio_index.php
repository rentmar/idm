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
	<div class="container-fluid">
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
						<button type="button" class="BOTON" data-toggle="modal" data-target="#myModal">
							Agregar
						</button>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores table-responsive">
				<h4>Usuario: <?php echo $usuario->username; ?></h4>
				<table id="formresp-tabla" class="table">
					<thead class="thead-dark">
					<tr id="datos">
						<th>Id</th>
						<th>Cudad</th>
						<th>Zona</th>
						<th>Lugar</th>
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
							<td><?php echo $e->nombre_ciudad; ?></td>
							<td><?php echo $e->nombre_zona; ?></td>
							<td><?php echo $e->nombre_lugar; ?></td>
							<td><?php echo $e->nombre_del_lugar; ?></td>
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


<!-- The Modal -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Agregar Nuevo Formulario</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php echo form_open('formulario/procesarCrearFormulario') ?>
				<div class="form-group">
					<label for="idformulario">Formulario:</label>
					<select id="idformulario" name="idformulario" class="form-control">
						<?php foreach ($formularios_base as $f): ?>
							<option value="<?php echo $f->idformulario;  ?>">
								<?php echo $f->form_nombre?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="idciudad">Ciudad:</label>
					<select class="form-control " id="idciudad" name="idciudad" required>
						<option value="" >Seleccione una Ciudad</option>
						<?php foreach ($ciudad as $c): ?>
							<option value="<?php echo $c->idciudad; ?>">
								<?php echo $c->nombre_ciudad; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="idzona">Zona:</label>
					<select class="form-control " id="idzona" name="idzona" required>
						<option value="" >Seleccione una Zona</option>

					</select>
				</div>
				<div class="form-group">
					<label for="idlugar">Lugar:</label>
					<select class="form-control" id="idlugar" name="idlugar" required>
						<option value="" >Seleccione un lugar</option>
						<?php foreach ($lugar as $c): ?>
							<option value="<?php echo $c->idlugar; ?>">
								<?php echo $c->nombre_lugar; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="nombre_lugar">Nombre del Lugar:</label>
					<input type="text" class="form-control" id="nombre_lugar" name="nombre_lugar" placeholder="Escriba el nombre del lugar" required>
				</div>
				<div class="form-group">
					<label for="fecha_registro">Fecha:</label>
					<input type="date" class="form-control" id="fecha_registro" name="fecha_registro"  required>
				</div>
				<div>
					<input type="text" name="idusuario" id="idusuario" value="<?php echo $usuario->id;?>">
					<input type="text" name="latitud_f" id="latitud_f">
					<input type="text" name="longitud_f" id="longitud_f" >
				</div>

				<br><br>
				<input type="submit" id="BOTON" value="CREAR">
				<a href="<?php echo site_url('inicio/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
				<?php echo form_close(); ?>
			</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>







