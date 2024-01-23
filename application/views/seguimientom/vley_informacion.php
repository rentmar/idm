<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					Ley Registrada
				</h3>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<div class="card">
					<div class="card-header cuest4">
						<h4 class="text-white">
							Datos de la Ley
						</h4>
					</div>
					<div class="card-body">
						<div class="list-group">
							<a href="#" class="list-group-item disabled">
								Fecha Registro:
								<?php echo ' '.mdate('%m-%d-%Y', $ley->fecha_registro); ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Fuente:
								<?php echo ' '.$ley_fuente->nombre_fuente; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Resumen:
								<?php echo ' '.$ley->resumen; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Usuario:
								<?php echo ' '.$ley->username; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Universidad:
								<?php echo ' '.$ley->nombre_universidad; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Departamento:
								<?php echo ' '.$ley->nombre_departamento; ?>
							</a>
						</div>
					</div>
				</div>
				<br>
				<div class="card">
					<div class="card-header cuest4">
						<h4 class="text-white">
							Estado de la Ley
						</h4>
					</div>
					<div class="card-body">
						<div class="list-group">
							<a href="#" class="list-group-item disabled">
								<h4>
									Avance en Porcentaje
									(<?php echo $ley_porcentaje->porcentaje; ?>%)
								</h4>
							</a>
							<a href="#" class="list-group-item disabled" >
							<?php if($ley_porcentaje->porcentaje == 100): ?>
								<div class="progress">
									<div class="progress-bar bprojooscuro " style="width:20%;" >
										<?php $estado = $ley_estados['tratamiento']; ?>
										<?php if(!empty($estado)): ?>
												<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bprojo" style="width:20%;" >
										<?php $estado = $ley_estados['sancionado']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bpamarillo" style="width:20%;" >
										<?php $estado = $ley_estados['aprobado']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bpverde" style="width:20%;" >
										<?php $estado = $ley_estados['modificacion']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bpverdeoscuro" style="width:20%;" >
										<?php $estado = $ley_estados['promulgada']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
								</div>

							<?php elseif ($ley_porcentaje->porcentaje == 80): ?>
								<div class="progress">
									<div class="progress-bar bprojooscuro " style="width:20%;" >
										<?php $estado = $ley_estados['tratamiento']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bprojo" style="width:20%;" >
										<?php $estado = $ley_estados['sancionado']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bpamarillo" style="width:20%;" >
										<?php $estado = $ley_estados['aprobado']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bpverde" style="width:20%;" >
										<?php $estado = $ley_estados['modificacion']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
								</div>


							<?php elseif ($ley_porcentaje->porcentaje == 60 ): ?>
								<div class="progress">
									<div class="progress-bar bprojooscuro " style="width:20%;" >
										<?php $estado = $ley_estados['tratamiento']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bprojo" style="width:20%;" >
										<?php $estado = $ley_estados['sancionado']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bpamarillo" style="width:20%;" >
										<?php $estado = $ley_estados['aprobado']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
								</div>


							<?php elseif ($ley_porcentaje->porcentaje == 40): ?>
								<div class="progress">
									<div class="progress-bar bprojooscuro " style="width:20%;" >
										<?php $estado = $ley_estados['tratamiento']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
									<div class="progress-bar bprojo" style="width:20%;" >
										<?php $estado = $ley_estados['sancionado']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
								</div>

							<?php elseif ($ley_porcentaje->porcentaje == 20): ?>
								<div class="progress">
									<div class="progress-bar bprojooscuro " style="width:20%;" >
										<?php $estado = $ley_estados['tratamiento']; ?>
										<?php if(!empty($estado)): ?>
											<?php echo ' '.$estado->codigo_ley; ?>
										<?php else: ?>
											S/N
										<?php endif; ?>
									</div>
								</div>

							<?php elseif ($ley_porcentaje->porcentaje == 0): ?>

							<?php else: ?>

							<?php endif; ?>

							</a>
							<br>
							<a href="#" class="list-group-item disabled">
								<h6>En Tratamiento</h6>
								<?php $estado = $ley_estados['tratamiento']; ?>
								<?php if(!empty($estado)): ?>
								<ul>
									<li>Fecha: <?php echo ' '.mdate('%m-%d-%Y', $estado->fecha_registro); ?> </li>
									<li>Codigo: <?php echo ' '.$estado->codigo_ley; ?> </li>
									<li>Descripcion: <?php echo ' '.$tratamiento_descripcion->nombre_ley; ?> </li>
									<li>URL: <?php echo ' '.$tratamiento_url->url_ley; ?> </li>
								</ul>
								<?php else: ?>
								<ul>
									<li>S/N</li>
								</ul>
								<?php endif; ?>

							</a>
							<a href="#" class="list-group-item disabled">
								<h6>Sancionada</h6>
								<?php $estado = $ley_estados['sancionado']; ?>
								<?php if(!empty($estado)): ?>
									<ul>
										<li>Fecha: <?php echo ' '.mdate('%m-%d-%Y', $estado->fecha_registro); ?> </li>
										<li>Codigo: <?php echo ' '.$estado->codigo_ley; ?> </li>
										<li>Descripcion: <?php echo ' '.$sancionada_descripcion->nombre_ley; ?> </li>
										<li>URL: <?php echo ' '.$sancionada_url->url_ley; ?> </li>
									</ul>
								<?php else: ?>
									<ul>
										<li>S/N</li>
									</ul>
								<?php endif; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								<h6>Aprobada</h6>
								<?php $estado = $ley_estados['aprobado']; ?>
								<?php if(!empty($estado)): ?>
									<ul>
										<li>Fecha: <?php echo ' '.mdate('%m-%d-%Y', $estado->fecha_registro); ?> </li>
										<li>Codigo: <?php echo ' '.$estado->codigo_ley; ?> </li>
										<li>Descripcion: <?php echo ' '.$aprobado_descripcion->nombre_ley; ?> </li>
										<li>URL: <?php echo ' '.$aprobado_url->url_ley; ?> </li>
									</ul>
								<?php else: ?>
									<ul>
										<li>S/N</li>
									</ul>
								<?php endif; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								<h6>Con Modificacion</h6>
								<?php $estado = $ley_estados['modificacion']; ?>
								<?php if(!empty($estado)): ?>
									<ul>
										<li>Fecha: <?php echo ' '.mdate('%m-%d-%Y', $estado->fecha_registro); ?> </li>
										<li>Codigo: <?php echo ' '.$estado->codigo_ley; ?> </li>
										<li>Descripcion: <?php echo ' '.$modificacion_descripcion->nombre_ley; ?> </li>
										<li>URL: <?php echo ' '.$modificacion_url->url_ley; ?> </li>
									</ul>
								<?php else: ?>
									<ul>
										<li>S/N</li>
									</ul>
								<?php endif; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								<h6>Promulgada</h6>
								<?php $estado = $ley_estados['promulgada']; ?>
								<?php if(!empty($estado)): ?>
									<ul>
										<li>Fecha: <?php echo ' '.mdate('%m-%d-%Y', $estado->fecha_registro); ?> </li>
										<li>Codigo: <?php echo ' '.$estado->codigo_ley; ?> </li>
										<li>Descripcion: <?php echo ' '.$promulgada_descripcion->nombre_ley; ?> </li>
										<li>URL: <?php echo ' '.$promulgada_url->url_ley; ?> </li>
									</ul>
								<?php else: ?>
									<ul>
										<li>S/N</li>
									</ul>
								<?php endif; ?>
							</a>
						</div>
					</div>

				</div>
				<br>
				<div class="card">
					<div class="card-header cuest4">
						<h4 class="text-white">
							Temas y Subtemas
						</h4>
					</div>
					<div class="card-body">
						<div class="list-group">

							<a href="#" class="list-group-item disabled">
								<h6>Temas</h6>
								<?php if(!empty($leyes_temas)): ?>
									<ul>
										<?php foreach ($leyes_temas as $lt): ?>
										<li> <?php echo ' '.$lt->nombre_tema; ?> </li>
										<?php endforeach; ?>
									</ul>
								<?php else: ?>
									<ul>
										<li>S/Temas</li>
									</ul>
								<?php endif; ?>

							</a>
							<a href="#" class="list-group-item disabled">
								<h6>Subtemas</h6>
								<?php if(!empty($leyes_stemas)): ?>
									<ul>
										<?php foreach ($leyes_stemas as $lt): ?>
											<li> <?php echo ' '.$lt->nombre_subtema.' (Tema: '.$lt->nombre_tema.')'; ?> </li>
										<?php endforeach; ?>
									</ul>
								<?php else: ?>
									<ul>
										<li>S/SubTemas</li>
									</ul>
								<?php endif; ?>

							</a>
							<a href="#" class="list-group-item disabled">
								<h6>Otros Temas</h6>
								<?php if(!empty($otema)): ?>
									<ul>
										<?php foreach ($otema as $ot): ?>
											<li> <?php echo ' '.$ot->nombre_otrotema; ?> </li>
										<?php endforeach; ?>
									</ul>
								<?php else: ?>
									<ul>
										<li>S/OtrosTemas</li>
									</ul>
								<?php endif; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								<h6>Otros Subtemas</h6>
								<?php if(!empty($ostema)): ?>
									<ul>
										<?php foreach ($ostema as $os): ?>
											<li> <?php echo ' '.$os->nombre_otrosubtema.' (Tema: '.$os->nombre_tema.')'; ?> </li>
										<?php endforeach; ?>
									</ul>
								<?php else: ?>
									<ul>
										<li>S/SubTemas</li>
									</ul>
								<?php endif; ?>
							</a>
						</div>
					</div>

				</div>
				<br>

				<div class="card float-right">
					<a href="<?php echo site_url('Seguimientomonitores/leyesTabla/');?>">
						<input type="button" class="BOTONROJO" value="SALIR">
					</a>
				</div>




			</div>
		</div>
	</div>
	<br>
</main>
