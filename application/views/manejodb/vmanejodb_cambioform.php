<main role="main" >
	<br>
	<div class="container">
		<div class="row">
			<?php //if(!empty($this->session->flashdata())): ?>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" >

				<div id="mensaje-error">
					<div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
						<?php echo $this->session->flashdata('mensaje') ?>
					</div>
				</div>
			</div>
			<?php //endif; ?>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<?php
					if($noticia->rel_idcuestionario == 1)
					{
						$clase = 'cuest1';
					}elseif ($noticia->rel_idcuestionario == 2){
						$clase = 'cuest2';
					}
					elseif ($noticia->rel_idcuestionario == 3){
						$clase = 'cuest3';
					}
					?>
					<div class="card-header <?php echo $clase; ?> " >
						<?php echo $cuestionario->nombre_cuestionario; ?>
					</div>
					<div class="card-body" >
						<div class="list-group">
							<a href="#" class="list-group-item disabled">
								Fecha Registro:
								<?php echo ' '.mdate('%m-%d-%Y', $noticia->fecha_registro); ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Fecha:
								<?php echo ' '.mdate('%m-%d-%Y', $noticia->fecha_noticia); ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Titular:
								<?php echo ' '.$noticia->titular; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Resumen:
								<?php echo ' '.$noticia->resumen; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								URL:
								<?php echo ' '.$noticia->url_noticia; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Medio:
								<?php echo $medio->nombre_medio; ?>
								<?php echo ' - '.$tipo_medio->nombre_tipo; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Actor:
								<ul>
									<?php foreach ($actores as $ac): ?>
										<li type="circle" ><?php echo $ac->nombre_actor; ?></li>
									<?php endforeach; ?>
								</ul>
							</a>
							<a href="#" class="list-group-item disabled">
								Tema:
								<ul>
									<?php foreach ($temas as $t): ?>
										<li type="circle" ><?php echo $t->nombre_tema; ?></li>
									<?php endforeach; ?>
								</ul>
								<?php if(isset($otrotema) && !empty($otrotema->nombre_otrotema) ): ?>
									<h7>Otro Tema:</h7>
									<p>
									<ul>
										<li type="circle" > <?php echo $otrotema->nombre_otrotema; ?> </li>
									</ul>
									</p>
								<?php endif; ?>

							</a>
							<a href="#" class="list-group-item disabled">
								Subtemas
								<ul>
									<?php foreach ($subtemas as $s): ?>
										<li type="circle" ><?php echo $s->nombre_subtema." (".$s->nombre_tema.")"; ?></li>
									<?php endforeach; ?>
								</ul>

								<?php if(isset($otrossubtemas)): ?>
									<h7>Otro Subtema:</h7>
									<p>
									<ul>
										<?php foreach ($otrossubtemas as $os): ?>
										<li type="circle" > <?php echo $os->nombre_otrosubtema." (".$os->nombre_tema.")"; ?>  </li>
										<?php endforeach; ?>
									</ul>
									</p>
								<?php endif; ?>


							</a>

						</div>

					</div>
					<div class="card-footer ml-auto " >

						<a href="#" class="btn btn-info" role="button" style="background-color:#474142;" data-toggle="modal" data-target="#cambiaform" >
							Cambiar Ambito
						</a>

						<?php if($formulario_cambiado): ?>
						<div class="btn-group">
							<button type="button" style="background-color:#474142;" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								Temas
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#cambiatemas">
									Ajustar Temas
								</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#cambiaotrotema" >
									Ajustar Otro Tema
								</a>
							</div>
						</div>
						<?php endif; ?>

						<?php if($temas_ajustados): ?>
						<div class="btn-group">
							<button type="button" style="background-color:#474142;" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								SubTemas
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#cambiasubtemas">
									Ajustar SubTemas</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#cambiaotrosubtema" >
									Ajustar Otro SubTemas
								</a>
							</div>
						</div>
						<?php endif; ?>

						<?php if($subtemas_ajustados && $temas_ajustados): ?>
						<a href="#" class="btn btn-info" role="button" style="background-color:#474142;" data-toggle="modal" data-target="#confirmarcambio" >
							Aplicar Cambios
						</a>
						<?php endif; ?>

						<a href="<?php echo site_url('manejoDB/cancelarCambioFormulario/'); ?>" class="btn btn-info" role="button" style="background-color:#474142;" >
							Cancelar
						</a>

					</div>

				</div>
			</div>


			<?php if($formulario_cambiado): ?>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<br>
				<div class="card">
					<?php
					if($nuevo_idcuestionario == 1)
					{
						$clase1 = 'cuest1';
					}elseif ($nuevo_idcuestionario == 2){
						$clase1 = 'cuest2';
					}
					elseif ($nuevo_idcuestionario == 3){
						$clase1 = 'cuest3';
					}
					?>
					<div class="card-header <?php echo $clase1; ?> " >
						Cambio a: <?php echo $nuevo_cuestionario->nombre_cuestionario;  ?>
					</div>
					<div class="card-body">
						<div class="list-group">

							<a href="#" class="list-group-item disabled">
								Tema:
								<ul>
									<?php if(isset($temas_n)): ?>
									<?php foreach ($temas_n as $t): ?>
										<li type="circle" ><?php echo $t['nombre_tema']; ?></li>
									<?php endforeach; ?>
									<?php endif; ?>

								</ul>
								<?php if(isset($otrotema_n) ): ?>
									<h7>Otro Tema:</h7>
									<p>
									<ul>
										<li type="circle" > <?php echo $otrotema_n; ?> </li>
									</ul>
									</p>
								<?php endif; ?>

							</a>
							<a href="#" class="list-group-item disabled">
								Subtemas
								<ul>
									<?php if(isset($subtemas_n)): ?>
									<?php foreach ($subtemas_n as $s): ?>
										<li type="circle" ><?php echo $s->nombre_subtema." (".$s->nombre_tema.")"; ?></li>
									<?php endforeach; ?>
									<?php endif; ?>
								</ul>

								<?php if(isset($otrossubtemas_n)): ?>
									<h7>Otro Subtema:</h7>
									<p>
									<?php foreach ($otrossubtemas_n as $ost): ?>
									<ul>
										<li type="circle" >
											<?php echo $ost;?>
										</li>
									</ul>
									<?php endforeach; ?>
									</p>
								<?php endif; ?>


							</a>

						</div>

					</div>
					<div class="card-footer ml-auto " >

					</div>
				</div>
			</div>
			<?php endif; ?>

		</div>
	</div>
	<br>
</main>


<!-- Modal para el cambio de formulario -->
<div class="modal fade" id="cambiaform">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Cambiar Ambito</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php echo form_open('manejoDB/cambiarAmbito/'); ?>

				<div class="form-group">
					<label for="idcuestionario"></label>
					<select id="idcuestionario" name="idcuestionario" class="form-control simple" required  >
						<option value="" >Seleccione el Nuevo Ambito</option>
						<?php foreach ($forms as $fm): ?>
							<?php if($fm->idcuestionario != 4 && $fm->idcuestionario != $noticia->rel_idcuestionario ): ?>
								<option value="<?php echo $fm->idcuestionario; ?>" >
									<?php echo $fm->nombre_cuestionario; ?>
								</option>
							<?php endif; ?>
						<?php endforeach;  ?>
					</select>
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" style="background-color:#474142;" class="btn btn-secondary" >
					Cambiar
				</button>
				<?php echo form_close(); ?>
				<button type="button" style="background-color:#474142;" class="btn btn-secondary" data-dismiss="modal">
					Cancelar
				</button>
			</div>

		</div>
	</div>
</div>


<!-- Modal para el cambio de temas -->
<div class="modal fade" id="cambiatemas">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Cambiar: Temas</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php
				/** @noinspection PhpLanguageLevelInspection */
				$attibs = [
						'id' => 'nuevos_temas',
					];
				?>
				<?php echo form_open('manejoDB/cambiarTemas/', $attibs); ?>
				<div class="card">
					<div class="card-header">
						<h4>
							TEMAS
						</h4>
					</div>
					<div class="card-body">
						<label>Escoge el tema al que está referido la nota :</label><br>
						<?php foreach ($temas_nuevos as $a): ?>
							<div class="form-check">
								<label class="form-check-label">
									<input id="checktema" name="idtema[]" type="checkbox" class="form-check-input"
										   value="<?php echo $a['idtema']; ?>"   >
									<?php echo $a['nombre_tema']; ?>
								</label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" style="background-color:#474142;" class="btn btn-secondary" >
					Cambiar
				</button>
				<?php echo form_close(); ?>
				<button type="button" style="background-color:#474142;" class="btn btn-secondary" data-dismiss="modal">
					Cancelar
				</button>
			</div>

		</div>
	</div>
</div>


<!-- Modal para el cambio de temas -->
<div class="modal fade" id="cambiaotrotema">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Cambia: Otro Tema</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php echo form_open('manejoDB/cambiarOtroTema/'); ?>
				<div class="form-group">
					<label for="otrotema">Otro Tema:</label>
					<input id="otrotema" name="otrotema" type="text" class="form-control" placeholder="Otro tema" required>
				</div>


			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" style="background-color:#474142;" class="btn btn-secondary" >
					Cambiar
				</button>
				<?php echo form_close(); ?>
				<button type="button" style="background-color:#474142;" class="btn btn-secondary" data-dismiss="modal">
					Cancelar
				</button>
			</div>

		</div>
	</div>
</div>




<!-- The Modal de alerta TEMAS SIN SELECCIONAR -->
<div class="modal fade" id="temasinseleccionar">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header bg-warning">
				<h4 class="modal-title text-white ">Alerta</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				Seleccionar por lo menos un tema
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="BOTON" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>

		</div>
	</div>
</div>


<!-- Modal para el cambio de subtemas -->
<div class="modal fade" id="cambiasubtemas">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Cambiar: Subtemas</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php
				/** @noinspection PhpLanguageLevelInspection */
				$attibs = [
					'id' => 'nuevos_temas',
				];
				?>
				<?php echo form_open('manejoDB/cambiarSubtemas/', $attibs); ?>
				<?php if (isset($temas_n)): ?>
				<?php foreach ($temas_n as $tm): ?>
					<div class="card">
						<div class="card-header">
							<h4>
								<?php echo $tm['nombre_tema'] ?>
							</h4>
						</div>
						<div class="card-body">
							<?php foreach ($subtemas_sel as $st): ?>
								<?php if($st['idtema'] == $tm['idtema'] ): ?>
									<div class="form-check">
										<label class="form-check-label">
											<input id="checkstema" name=" <?php echo "tema".$tm['idtema']."[]";?>" type="checkbox" class="form-check-input"
												   value="<?php echo $st['idsubtema']; ?>"   >
											<?php echo $st['nombre_subtema']; ?>
										</label>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>


						</div>
					</div>
					<br>


				<?php endforeach;?>
				<?php endif; ?>





			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" style="background-color:#474142;" class="btn btn-secondary" >
					Cambiar
				</button>
				<?php echo form_close(); ?>
				<button type="button" style="background-color:#474142;" class="btn btn-secondary" data-dismiss="modal">
					Cancelar
				</button>
			</div>

		</div>
	</div>
</div>


<!-- Modal para el cambio de temas -->
<div class="modal fade" id="cambiaotrosubtema">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Cambia: Otros Subtema</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php
				/** @noinspection PhpLanguageLevelInspection */
				$attibst = [
					'id' => 'nuevos_otrosubtemas',
				];

				?>
				<?php echo form_open('manejoDB/cambiarOtroSubtema/', $attibst); ?>

				<?php if (isset($temas_n)): ?>
					<?php foreach ($temas_n as $tm): ?>
						<div class="card">
							<div class="card-header">
								<h4>
									<?php echo $tm['nombre_tema'] ?>
								</h4>
							</div>
							<div class="card-body">
								<div class="form-group">
									<input type="text" id="<?php echo "otrosubtema".$tm['idtema'];?>"
										   name="<?php echo "otrosubtema".$tm['idtema']; ?>"
										   placeholder="Otro subtema" class="form-control"
									>
								</div>

							</div>
						</div>
						<br>
					<?php endforeach;?>
				<?php endif; ?>


			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" style="background-color:#474142;" class="btn btn-secondary" >
					Cambiar
				</button>
				<?php echo form_close(); ?>
				<button type="button" style="background-color:#474142;" class="btn btn-secondary" data-dismiss="modal">
					Cancelar
				</button>
			</div>

		</div>
	</div>
</div>

<!-- Modal para Aplicar cambio de formulario -->
<div class="modal fade" id="confirmarcambio">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header alert alert-danger">
				<h4 class="modal-title">Confirmar Cambio</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">

				<?php echo form_open('manejoDB/aplicarCambios/'); ?>
				El cambio de ambito es irreversible, esta seguro?



			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" style="background-color:#474142;" class="btn btn-secondary" >
					SI
				</button>
				<?php echo form_close(); ?>
				<button type="button" style="background-color:#474142;" class="btn btn-secondary" data-dismiss="modal">
					NO
				</button>
			</div>

		</div>
	</div>
</div>


