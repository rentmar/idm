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
						<a href="<?php echo site_url('encuesta/encuestaAusuarios');?>">
							<input type="submit" class="BOTONROJO" value="SALIR">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<h4>Usuario: <?php echo $usuario->username; ?></h4>
				<table>
					<thead>
					<tr id="datos">
						<th>Nro</th>
						<th>Encuesta</th>
						<th>URL</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($encuestas as $e) {?>
						<tr>
							<td><?php echo $e->idencuesta;?></td>
							<td><?php echo $e->uinombre_encuesta; ?></td>
							<?php if(!$e->usado): ?>
								<td class="text-success">
									<?php echo site_url('read/url/'.$e->hash_text); ?>
								</td>
							<?php else: ?>
								<td class="text-danger">
									<?php echo site_url('read/url/'.$e->hash_text); ?>
								</td>
							<?php endif; ?>
							<?php if(!$e->usado): ?>
								<td>
									<a href="<?php echo site_url('encuesta/reasignarEncuesta/'.$e->idencuesta);?>" data-toggle="tooltip" title="Reasignar encuesta" >
										<i class="fas fa-exchange-alt"></i>
									</a>

								</td>
							<?php else: ?>
								<td>

								</td>
							<?php endif; ?>

						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<br>
</main>

