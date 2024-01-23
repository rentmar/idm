<main role="main">
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<div class="contenedor">
					<div id="caja_boton">
						<!--<div id="contenedor-submit">
							<a href="<?php /*echo site_url('encuesta/exportarExcel') */?>"><input type="" class="BOTON" value="Excel">
							</a>
						</div><br>
						<div id="contenedor-submit">
							<a href="<?php /*echo site_url('encuesta/encuestaInicio');*/?>"><input type="" class="BOTONROJO" value="CANCELAR"></a>
						</div>-->
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<p><h3 class="text-center" >Administrar Encuesta</h3></p>
				<p class="text-right">
					<a href="<?php echo site_url('encuesta/finalizarAdministrador'); ?>" class="BOTONROJO" >Finalizar</a>
				</p>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<hr>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores ">
				<div class="table-responsive">
					<table id="encuestas-tabla" class="table table-striped table-hoover" >
						<thead>
						<tr id="datos">
							<th>No</th>
							<th>Fecha</th>
							<th>Cod</th>
							<th>Usr</th>
							<th>Lat</th>
							<th>Lon</th>
							<th>Ed</th>
							<th>Sx</th>
							<th>Area</th>
							<th>Ciu</th>
							<th>Zn</th>
							<th>Dur.[min]</th>
							<th>Est</th>
							<th>Acc</th>
						</tr>
						</thead>
						<tbody>
						<?php if(isset($encuesta_datos_generales)): ?>
							<?php foreach ($encuesta_datos_generales as $n): ?>
								<tr>
									<td><?php echo $n->idformcomp; ?></td>
									<td><?php echo mdate('%m-%d-%Y', $n->fecha_fc); ?></td>
									<td><?php echo $n->hash_fc; ?></td>
									<td><?php echo $n->username; ?></td>
									<td><?php echo number_format($n->latidud_fc,3, ",",""); ?></td>
									<td><?php echo number_format($n->longitud_fc, 3, ",", ""); ?></td>
									<td><?php echo $n->edad; ?></td>
									<td><?php echo $n->sexo; ?></td>
									<td><?php echo $n->area; ?></td>
									<td><?php echo $n->ciudad; ?></td>
									<td><?php echo $n->zona ?></td>
									<td><?php echo $n->tiempo ?></td>

									<?php if($n->es_valida ):?>
										<td class="table-info" >Activa</td>
									<?php else: ?>
										<td class="table-danger" >Inactiva</td>
									<?php endif; ?>

									<td>
										<?php if($n->es_valida): ?>
											<a href="<?php echo site_url('encuesta/cambiarEstadoRegistro/'.$n->idformcomp);?>" data-toggle="tooltip" title="Activa/Desactiva">
												<i class="fas fa-toggle-on"></i>
											</a>
										<?php else: ?>
											<a href="<?php echo site_url('encuesta/cambiarEstadoRegistro/'.$n->idformcomp);?>" data-toggle="tooltip" title="Activa/Desactiva" >
												<i class="fas fa-toggle-off"></i>
											</a>
										<?php endif; ?>

										<a href="<?php echo site_url('encuesta/editarRegistroEncuesta/'.$n->idformcomp); ?>" data-toggle="tooltip" title="Editar registro"  >
											<i class="fas fa-edit"></i>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
	<br>
</main>
