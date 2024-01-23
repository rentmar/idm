<main role="main">
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
				<div id="caja_boton">
					<div id="contenedor-submit">
<!--						<a href="<?php echo site_url('encuesta/crearSeccion');?>">
							<input type="submit" class="BOTON" value="ASIGNAR ENCUESTA" style="width:190px; height:47px">
						</a>
						<a href="<?php echo site_url('/');?>">
							<input type="submit" class="BOTONROJO" value="CANCELAR">
						</a>
-->					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<thead>
					<tr id="datos">
						<th>Nro</th>
						<th>Usuario</th>
						<th>Asignadas</th>
						<th>Realizadas</th>
						<th>Accion</th>

					</tr>
					</thead>
					<tbody>
					<?php foreach ($usuariose as $e) {?>
						<tr>
							<td><?php echo $e["id"];?></td>
							<td><?php echo $e["username"]; ?></td>
							<td><?php echo $e["numero_encuestas"];?></td>
							<td><?php echo $e["usadas"];?></td>
							<td>
								<a href="<?php echo site_url('encuesta/asignarEncuesta/'.$e["id"]);?>" data-toggle="tooltip" title="Asignar encuesta(s)" >
									<i class="fas fa-tasks"></i>
								</a>
								<a href="<?php echo site_url('encuesta/verEncuestasAsignadas/'.$e["id"]);?>" data-toggle="tooltip" title="Ver encuestas asignadas" >
									<i class="fas fa-clipboard-list"></i>
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
</main>


