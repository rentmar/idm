<div class="tab-content">
	<?php foreach ($modulos as $m): ?>
		<?php if($m->uiorden_modulo == $orden_mod_min): ?>
			<div id="<?php echo 'modulo'.$m->iduimodulo; ?>" class="container tab-pane active"><br>
				<h3><?php echo $m->uinombre_modulo; ?></h3>
				<div id="<?php echo 'contenedor'.$m->iduimodulo; ?>">

					<!-- Seccion -->
					<?php foreach ($secciones as $s): ?>
					<?php if($s->iduimodulo==$m->iduimodulo):  ?>
					<div class="card">
						<?php foreach ($preguntas as $p): ?>
						<?php if($p->iduiseccion==$s->iduiseccion): ?>
						<div class="card-header">
							<a class="card-link" data-toggle="collapse" href="#pregunta<?php echo $s->iduiseccion;?>" >
								<?php echo "(".$s->etiqueta_seccion.") "; ?><?php echo $p->uipregunta_nombre; ?>
								<?php if(isset($p->uipregunta_nota)): ?>
								<div>
									<p class="bg-success text-white">
										<?php echo $p->uipregunta_nota; ?>
									</p>
								</div>
								<?php endif; ?>
							</a>
						</div>
						<div id="pregunta<?php echo $s->iduiseccion;?>" class="collapse"  >
							<div class="card-body">
								<div class="form-group">
									<?php foreach ($respuestas as $r): ?>
										<?php $datos_pregunta['p'] = $p; ?>
										<?php $datos_pregunta['r'] = $r; ?>

										<?php if($p->iduitipopregunta == 1): ?>
											<?php $this->load->view('encuesta/svencuesta_plantilla_resp_selsimple', $datos_pregunta ); ?>
										<?php elseif ($p->iduitipopregunta == 2):  ?>
											<?php $this->load->view('encuesta/svencuesta_plantilla_resp_selmultiple', $datos_pregunta); ?>
										<?php elseif ($p->iduitipopregunta == 3):  ?>
											<?php $this->load->view('encuesta/svencuesta_plantilla_resp_abiertasimple', $datos_pregunta); ?>
										<?php elseif ($p->iduitipopregunta == 4):  ?>
											<?php $this->load->view('encuesta/svencuesta_plantilla_resp_selmultiple_otro_abierta', $datos_pregunta); ?>
										<?php elseif ($p->iduitipopregunta == 5):  ?>
											<?php $this->load->view('encuesta/svencuesta_plantilla_resp_multiple_cuantificada', $datos_pregunta); ?>

										<?php else: ?>
											Sin definicion
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
					<!-- Fin Seccion -->

				</div>
			</div>
		<?php else: ?>
			<div id="<?php echo 'modulo'.$m->iduimodulo; ?>" class="container tab-pane fade"><br>
				<h3><?php echo $m->uinombre_modulo; ?></h3>
				<div id="<?php echo 'contenedor'.$m->iduimodulo; ?>">

					<!-- Seccion -->
					<?php foreach ($secciones as $s): ?>
					<?php if($s->iduimodulo==$m->iduimodulo):  ?>
					<div class="card">
						<?php foreach ($preguntas as $p): ?>
						<?php if($p->iduiseccion==$s->iduiseccion): ?>
						<div class="card-header">
							<a class="card-link" data-toggle="collapse" href="#pregunta<?php echo $s->iduiseccion;?>" >
								<?php echo "(".$s->etiqueta_seccion.") "; ?><?php echo $p->uipregunta_nombre; ?>
							</a>
						</div>
						<div id="pregunta<?php echo $s->iduiseccion;?>" class="collapse"  >
							<div class="card-body">
								<div class="form-group">
									<?php foreach ($respuestas as $r): ?>
										<?php $datos_pregunta['p'] = $p; ?>
										<?php $datos_pregunta['r'] = $r; ?>
										<?php if($p->iduitipopregunta == 1): ?>
											<?php $this->load->view('encuesta/svencuesta_plantilla_resp_selsimple', $datos_pregunta ); ?>
										<?php elseif ($p->iduitipopregunta == 2):  ?>
											<?php $this->load->view('encuesta/svencuesta_plantilla_resp_selmultiple', $datos_pregunta); ?>
										<?php else: ?>
											Sin definicion
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
					<!-- Fin Seccion -->

				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
