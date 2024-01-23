<main role="main">
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<div class="contenedor">
					<div id="caja_boton">
						<div id="contenedor-submit">
							<a href="<?php echo site_url('encuesta/exportarExcel'); ?>">
								<input type="" class="BOTON" value="Excel">
							</a>
						</div>
						<div id="contenedor-submit">
							<a href="<?php echo site_url('encuesta/exportarExcelCodificado');?>">
								<input type="" class="BOTON" value="Excel/Cod" style="padding: 12px;" >
							</a>
						</div>
						<div id="contenedor-submit">
							<a href="<?php echo site_url('encuesta/exportarExcelDepartamentos');?>">
								<input type="" class="BOTON" value="Excel/Dep" style="padding: 12px;" >
							</a>
						</div>
						<div id="contenedor-submit">
							<a href="<?php echo site_url('encuesta/encuestaInicio');?>">
								<input type="" class="BOTONROJO" value="CANCELAR" >
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					Resultados de la encuesta: <?php echo $encuesta_nombre->uinombre_encuesta; ?>
				</h3>
				<?php if($edad_inicial!=0 && $edad_final !=0): ?>
				<p>
					Rango de edad: <?php echo $edad_inicial.' a '.$edad_final; ?>
				</p>
				<?php endif; ?>

				<?php if($consulta->sexo): ?>
				<p>
						Sexo: <?php echo $sexo; ?>
				</p>
				<?php endif;?>
				<?php if($consulta->area): ?>
				<p>
					Area: <?php echo $area; ?>
				</p>
				<?php endif; ?>
				<?php if($consulta->iddepartamento): ?>
				<p>
					Departamento: <?php echo $departamento->nombre_departamento; ?>
				</p>
				<?php endif; ?>

			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores ">
				<div class="table-responsive">
					<table id="encuestas-tabla" class="table table-striped table-hoover">
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

