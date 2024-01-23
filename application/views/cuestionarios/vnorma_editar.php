<main role="main" >
	<br><br>
	<div class="container" style="background-color:#EF9600;">
		<br>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<br>
				<div class="card">
					<div class="card-header">
						<h4>Editar Norma</h4>
					</div>
					<div class="card-body ">

						<div class="form-row">
							<div class="col-10">
								<label for="instanciaseguimiento" >
									Instancia de seguimiento:
								</label>
								<input class="form-control" type="text" id="instanciaseguimiento" name="instanciaseguimiento" class="form-control" disabled="true"
									   value="<?php echo $norma->instancia; ?>" >
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>


						<?php if($norma->idinsseg == 2 ): ?>
							<div class="form-row">
								<div class="col-10">
									<label for="instanciadepartamento" >
										Departamento:
									</label>
									<input class="form-control" type="text" id="instanciadepartamento" name="instanciadepartamento" class="form-control" disabled="true"
										   value="<?php echo $norma->nombre_departamento; ?>" >
								</div>
							</div>
							<div class="form-row">
								<div class="col">
									<hr>
								</div>
							</div>
						<?php elseif($norma->idinsseg == 3): ?>
							<div class="form-row">
								<div class="col-10">
									<label for="instanciamunicipio" >
										Municipio:
									</label>
									<input class="form-control" type="text" id="instanciamunicipio" name="instanciamunicipio" class="form-control" disabled="true"
										   value="<?php echo $norma->municipio_nombre; ?>" >
								</div>
							</div>
							<div class="form-row">
								<div class="col">
									<hr>
								</div>
							</div>
						<?php endif; ?>

						<?php if($norma->estado_norma == 'en_tratamiento'): ?>
							<div class="form-row">
								<div class="col-10">
									<label for="estadonorma">
										Estado de la norma:
									</label>
									<input type="text" id="estadonorma" name="estadonorma" class="form-control" value="Ley en tratamiento" disabled="true">
								</div>
								<div class="col-2">
									<button type="submit" data-toggle="modal" data-target="#normaestadomodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
										Cambiar Estado de la norma
									</button>
								</div>
							</div>
						<?php elseif ($norma->estado_norma == 'promulgada'): ?>
							<div class="form-row">
								<div class="col-10">
									<label for="estadonorma">
										Estado de la norma:
									</label>
									<input type="text" id="estadonorma" name="estadonorma" class="form-control" value="Ley promulgada" disabled="true">
								</div>
								<div class="col-2">
									<button type="submit" data-toggle="modal" data-target="#normaestadomodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
										Cambiar Estado de la norma
									</button>
								</div>
							</div>

						<?php endif; ?>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
						<?php if($norma->estado_norma == 'promulgada'): ?>
							<div class="form-row">
								<div class="col-10">
									<label for="fecha_norma_primer_envio" >
										Fecha del primer envio:
									</label>
									<input type="date" id="fecha_norma_primer_envio" name="fecha_norma_primer_envio" class="form-control" readonly
										   value="<?php
										   if($norma->fecha_primer_envio != 0){
											   echo mdate('%Y-%m-%d', $norma->fecha_primer_envio);
										   }
										   ?>" >
								</div>
								<div class="col-2">
									<button type="submit" data-toggle="modal" data-target="#normamodalfechaprimerenvio" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
										Cambiar Fecha del Primer Envio
									</button>
								</div>
							</div>




						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<?php endif; ?>





						<div class="form-row">
							<div class="col-10">
								<label for="fecha_norma" >
									Fecha de la norma:
								</label>
								<input type="date" id="fecha_norma" name="fecha_norma" class="form-control" disabled="true"
									   value="<?php echo mdate('%Y-%m-%d', $norma->fecha_norma);?>" >
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#normamodalprocedencia" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Datos Procedencia
								</button>
							</div>
						</div>


						<!--
						<div class="form-row">
							<div class="col-10">
								<label for="normaremitente" >
									Quién envía la norma para su tratamiento									:
								</label>
								<input class="form-control" id="normaremitente" name="normaremitente" value="<?php echo $norma->norma_remitente;?>" disabled="true">
							</div>
							<div class="col-2"></div>
							</div>

						<div class="form-row">
							<div class="col-10">
								<label for="normadestinatario" >
									A quién le llega la norma para su tratamiento:
								</label>
								<input class="form-control" id="normadestinatario" name="normadestinatario" value="<?php echo $norma->norma_destinatario;?>" disabled="true">
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="normasegundoenvio" >
									¿Existe un segundo envío/solicitud de la norma? En caso de ser así, registre quién y cuándo:
								</label>
								<textarea class="form-control" rows="4" id="normasegundoenvio" name="normasegundoenvio" disabled="true" ><?php echo $norma->norma_segundo_envio; ?></textarea>
							</div>
							<div class="col-2"></div>
						</div>-->
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
						




						<div class="form-row">
							<div class="col-10">
								<label for="normacodigo">
									Norma codigo:
								</label>
								<input class="form-control" id="normacodigo" name="normacodigo" disabled="true" value="<?php echo $norma->norma_codigo;  ?>">
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#datosnormamodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Datos Norma
								</button>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="normanombre" >
									Norma nombre:
								</label>
								<textarea class="form-control" rows="4" id="normanombre" name="normanombre" disabled="true" ><?php echo $norma->norma_nombre; ?></textarea>
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="normaobjeto" >
									Norma objeto:
								</label>
								<textarea class="form-control" rows="4" id="normaobjeto" name="normaobjeto" disabled="true" ><?php echo $norma->norma_objeto; ?></textarea>
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="normaobservaciones" >
									Norma observaciones:
								</label>
								<textarea class="form-control" rows="4" id="normaobservaciones" name="normaobservaciones" disabled="true" ><?php echo $norma->norma_observaciones; ?></textarea>
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<!--
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="proponente" >
										Proponente:
									</label>
									<?php // $prp = strtolower($norma->proponente); ?>
									<?php //if($prp == 'otros'): ?>
										<input class="form-control" type="text" id="proponente" name="proponente" disabled="true" value="<?php echo $prp;  ?>">
										<input class="form-control" type="text" id="notaproponente" name="notaproponente" disabled="true" value="<?php echo $otro_proponente->otro_descripcion;  ?>">
									<?php //else: ?>
										<input class="form-control" type="text" id="proponente" name="proponente" disabled="true" value="<?php echo $prp;  ?>">
									<?php //endif; ?>

								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#proponentemodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Proponente
								</button>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
									-->

						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="temanorma1" >
										Tema uno de la norma:
									</label>
									<?php if($tema1 == false): ?>
										<input class="form-control" type="text" id="temanorma1" name="temanorma1" disabled="true"
											   value="<?php
											   			if($otro_tema1 != null){
															echo $otro_tema1->descripcion_otrotema;
														}
											   			?>">
									<?php else: ?>
										<input class="form-control" type="text" id="temanorma1" name="temanorma1" disabled="true"
											   value="<?php echo $tema1->nombre_tema;  ?>">
									<?php endif; ?>
								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#normatema1modal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Tema uno
								</button>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="temanorma2" >
										Tema dos de la Norma:
									</label>
									<?php if($tema2 == false): ?>
										<input class="form-control" type="text" id="temanorma2" name="temanorma2" disabled="true"
											   value="<?php
											   			if($otro_tema2 != null){
															echo $otro_tema2->descripcion_otrotema;
														}
											   			?>">
									<?php else: ?>
										<input class="form-control" type="text" id="temanorma2" name="temanorma2" disabled="true"
											   value="<?php echo $tema2->nombre_tema;  ?>">
									<?php endif; ?>
								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#normatema2modal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Tema dos
								</button>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</main>


<!-- Cambiar datos de la plenaria -->
<div class="modal" id="normamodalprocedencia">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar procedencia de la norma</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNormaProcedencia/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="fechanorma">Fecha de la norma:</label>
					<input type="date" id="fechanorma" name="fechanorma" required
						   class="form-control"
						   value="<?php echo mdate('%Y-%m-%d', $norma->fecha_norma); ?>" >
				</div>

				<!--
				<div class="form-group">
					<label for="remitentenorma">Quién envía la norma para su tratamiento:</label>
					<textarea class="form-control" rows="4" id="remitentenorma" name="remitentenorma"><?php echo $norma->norma_remitente; ?> </textarea>
				</div>
				<div class="form-group">
					<label for="destinatarionorma">A quién le llega la norma para su tratamiento:</label>
					<textarea class="form-control" rows="4" id="destinatarionorma" name="destinatarionorma" ><?php echo $norma->norma_destinatario; ?></textarea>
				</div>
				<div class="form-group">
					<label for="segundoenvionorma" >¿Existe un segundo envío/solicitud de la norma? En caso de ser así, registre quién y cuándo:</label>
					<textarea class="form-control" rows="4" id="segundoenvionorma" name="segundoenvionorma"  ><?php echo $norma->norma_segundo_envio; ?></textarea>
				</div>
				-->

			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="1" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="datosnormamodal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Datos de la Norma</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNormaDatos/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="codigonorma">Norma codigo:</label>
					<input type="text" id="codigonorma" name="codigonorma" required
						   class="form-control"
						   value="<?php echo $norma->norma_codigo; ?>" >
				</div>
				<div class="form-group">
					<div class="form-group">
						<label for="nombrenorma" >Norma nombre: </label>
						<textarea class="form-control" rows="4" id="nombrenorma" name="nombrenorma"  ><?php echo $norma->norma_nombre; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="form-group">
						<label for="objetonorma" >Norma objeto: </label>
						<textarea class="form-control" rows="4" id="objetonorma" name="objetonorma"  ><?php echo $norma->norma_objeto; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="form-group">
						<label for="obsnorma" >Norma observaciones: </label>
						<textarea class="form-control" rows="4" id="obsnorma" name="obsnorma"  ><?php echo $norma->norma_observaciones; ?></textarea>
					</div>
				</div>


			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Continuar
				</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="proponentemodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Proponente de la Norma</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNormaProponente/'.$norma->idnormag);?>
			<div class="modal-body">
				<?php $proponente = strtolower($norma->proponente); ?>
				<?php if($proponente == 'oficialismo'): ?>
					<div class="form-group">
						<div class="custom-control custom-radio">
							<input id="proponente_norma_1" name="proponente_norma" type="radio" value="1" class="custom-control-input" checked>
							<label class="custom-control-label" for="proponente_norma_1">
								Oficialismo
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="proponente_norma_2" name="proponente_norma" type="radio" value="2" class="custom-control-input">
							<label class="custom-control-label" for="proponente_norma_2" >
								Oposición
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="proponente_norma_3" name="proponente_norma" type="radio" value="3" class="custom-control-input">
							<label class="custom-control-label" for="proponente_norma_3" >
								Otros
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="otroproponente">Otro proponente:</label>
						<input type="text" id="otroproponente" name="otroproponente"
							   class="form-control"
							   value="<?php
							   if($otro_proponente != false){
								   echo $otro_proponente->otro_descripcion;
							   }
							   ?>" >
						<input type="hidden" id="idotroproponente" name="idotroproponente" class="form-control"
							   value="<?php
							   if($otro_proponente != false){
								   echo $otro_proponente->idpropotro;
							   }
							   else{
								   echo '0';
							   }
							   ?>">
					</div>
				<?php elseif ($proponente == 'otros'): ?>
					<div class="form-group">
						<div class="custom-control custom-radio">
							<input id="proponente_norma_1" name="proponente_norma" type="radio" value="1" class="custom-control-input">
							<label class="custom-control-label" for="proponente_norma_1">
								Oficialismo
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="proponente_norma_2" name="proponente_norma" type="radio" value="2" class="custom-control-input">
							<label class="custom-control-label" for="proponente_norma_2" >
								Oposición
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="proponente_norma_3" name="proponente_norma" type="radio" value="3" class="custom-control-input" checked>
							<label class="custom-control-label" for="proponente_norma_3" >
								Otros
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="otroproponente">Otro proponente:</label>
						<input type="text" id="otroproponente" name="otroproponente"
							   class="form-control"
							   value="<?php
							   if($otro_proponente != false){
								   echo $otro_proponente->otro_descripcion;
							   }
							   ?>" >
						<input type="hidden" id="idotroproponente" name="idotroproponente" class="form-control"
							   value="<?php
							   if($otro_proponente != false){
								   echo $otro_proponente->idpropotro;
							   }
							   else{
								   echo '0';
							   }
							   ?>">
					</div>
				<?php else: ?>
					<div class="form-group">
						<div class="custom-control custom-radio">
							<input id="proponente_norma_1" name="proponente_norma" type="radio" value="1" class="custom-control-input">
							<label class="custom-control-label" for="proponente_norma_1">
								Oficialismo
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="proponente_norma_2" name="proponente_norma" type="radio" value="2" class="custom-control-input" checked>
							<label class="custom-control-label" for="proponente_norma_2" >
								Oposición
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="proponente_norma_3" name="proponente_norma" type="radio" value="3" class="custom-control-input">
							<label class="custom-control-label" for="proponente_norma_3" >
								Otros
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="otroproponente">Otro proponente:</label>
						<input type="text" id="otroproponente" name="otroproponente"
							   class="form-control"
							   value="<?php
							   if($otro_proponente != false){
							   		echo $otro_proponente->otro_descripcion;
							   }
							   ?>" >
						<input type="hidden" id="idotroproponente" name="idotroproponente" class="form-control"
							   value="<?php
							   if($otro_proponente != false){
								   echo $otro_proponente->idpropotro;
							   }
							   else{
							   		echo '0';
							   }
							   ?> ">

					</div>
				<?php endif; ?>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="3" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="normaestadomodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Estado de la Norma</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNormaEstado/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="estadonorma" >
					</label>
					<?php if($norma->estado_norma == 'en_tratamiento'): ?>
						<select class="form-control" id="estadonorma" name="estadonorma">
							<option selected value="1">Ley en tratamiento</option>
							<option value="2">Ley promulgada </option>
						</select>
					<?php else: ?>
						<select class="form-control" id="estadonorma" name="estadonorma">
							<option value="1">Ley en tratamiento</option>
							<option selected value="2">Ley promulgada </option>
						</select>
					<?php endif; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="3" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="normatema1modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Tema 1 de la Norma</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNormaTemaUno/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label>Escoge el tema:</label><br>
					<?php if($tema1 == false): ?>
						<!-- Otro tema registrado -->
						<?php foreach ($tema as $a):?>
							<div class="custom-control custom-radio">
								<input id="checktema1norma<?php echo $a['idtema']; ?>" name="idtema" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input" >
								<label class="custom-control-label" for="checktema1norma<?php echo $a['idtema']; ?>" >
									<?php echo $a['nombre_tema']; ?>
								</label>
							</div>
						<?php endforeach;?>
							<div class="custom-control custom-radio">
								<input id="checktema1norma0" name="idtema" type="radio" value="0" class="custom-control-input" checked >
								<label class="custom-control-label" for="checktema1norma0" >
									Otro
								</label>
							</div>
							<div id="otrotema1normadatosedit">
								<label for="otrotema1normaed">Otro tema:</label><br>
								<input type="text" id="otrotema1normaed" name="otrotema1normaed"  class="form-control"
									   value="<?php
									   			if($otro_tema1 != null){
													echo $otro_tema1->descripcion_otrotema;
												}
									   		?>" >
								<input type="hidden" id="idotrotema1" name="idotrotema1"
									   value="<?php
									   if($otro_tema1 != null){
										   echo $otro_tema1->idnotema;
									   }
									   ?>" >
								<input type="hidden" id="idrelacionaltema1" name="idrelacionaltema1"
									   value="<?php
									   if($tema1 != false){
										   echo $tema1->idntema;
									   }

									   ?>" >
							</div>
					<?php else: ?>
						<!-- tema registrado -->
						<div>Tema del listado</div>
						<?php foreach ($tema as $a): ?>
							<?php if($a['idtema'] == $tema1->idtema): ?>
							<div class="custom-control custom-radio">
								<input id="checktema1norma<?php echo $a['idtema']; ?>" name="idtema" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input" checked >
								<label class="custom-control-label" for="checktema1norma<?php echo $a['idtema']; ?>" >
									<?php echo $a['nombre_tema']; ?>
								</label>
							</div>
							<?php else: ?>
							<div class="custom-control custom-radio">
								<input id="checktema1norma<?php echo $a['idtema']; ?>" name="idtema" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input" >
								<label class="custom-control-label" for="checktema1norma<?php echo $a['idtema']; ?>" >
									<?php echo $a['nombre_tema']; ?>
								</label>
							</div>
							<?php endif; ?>
						<?php endforeach; ?>
							<div class="custom-control custom-radio">
								<input id="checktema1norma0" name="idtema" type="radio" value="0" class="custom-control-input" >
								<label class="custom-control-label" for="checktema1norma0" >
									Otro
								</label>
							</div>
							<div id="otrotema1normadatosedit">
								<label for="otrotema1normaed">Otro tema:</label><br>
								<input type="text" id="otrotema1normaed" name="otrotema1normaed"  class="form-control" value="" >
								<input type="hidden" id="idotrotema1" name="idotrotema1"
									   value="<?php
									   if($otro_tema1 != null){
										   echo $otro_tema1->idnotema;
									   }
									   ?>" >
								<input type="hidden" id="idrelacionaltema1" name="idrelacionaltema1"
									   value="<?php
									   if($tema1 != false){
										   echo $tema1->idntema;
									   }

									   ?>" >
							</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="3" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>



<div class="modal" id="normatema2modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Tema 2 de la Norma</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNormaTemaDos/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label>Escoge el tema:</label><br>
					<?php if($tema2 == false): ?>
						<!-- Otro tema registrado -->
						<?php foreach ($tema as $a):?>
							<div class="custom-control custom-radio">
								<input id="checktema2norma<?php echo $a['idtema']; ?>" name="idtema2" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input" >
								<label class="custom-control-label" for="checktema2norma<?php echo $a['idtema']; ?>" >
									<?php echo $a['nombre_tema']; ?>
								</label>
							</div>
						<?php endforeach;?>
						<div class="custom-control custom-radio">
							<input id="checktema2norma0" name="idtema2" type="radio" value="0" class="custom-control-input" checked >
							<label class="custom-control-label" for="checktema2norma0" >
								Otro
							</label>
						</div>
						<div id="otrotema2normadatosedit">
							<label for="otrotema2normaed">Otro tema:</label><br>
							<input type="text" id="otrotema2normaed" name="otrotema2normaed"  class="form-control"
								   value="<?php
								   if($otro_tema2 != null){
									   echo $otro_tema2->descripcion_otrotema;
								   }
								   ?>" >
							<input type="hidden" id="idotrotema2" name="idotrotema2"
								   value="<?php
								   if($otro_tema2 != null){
									   echo $otro_tema2->idnotema;
								   }
								   ?>" >
							<input type="hidden" id="idrelacionaltema2" name="idrelacionaltema2"
								   value="<?php
								   if($tema2 != false){
									   echo $tema2->idntema;
								   }

								   ?>" >
						</div>
					<?php else: ?>
						<!-- tema registrado -->
						<?php foreach ($tema as $a): ?>
							<?php if($a['idtema'] == $tema2->idtema): ?>
								<div class="custom-control custom-radio">
									<input id="checktema2norma<?php echo $a['idtema']; ?>" name="idtema2" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input" checked >
									<label class="custom-control-label" for="checktema2norma<?php echo $a['idtema']; ?>" >
										<?php echo $a['nombre_tema']; ?>
									</label>
								</div>
							<?php else: ?>
								<div class="custom-control custom-radio">
									<input id="checktema2norma<?php echo $a['idtema']; ?>" name="idtema2" type="radio" value="<?php echo $a['idtema']; ?>" class="custom-control-input" >
									<label class="custom-control-label" for="checktema2norma<?php echo $a['idtema']; ?>" >
										<?php echo $a['nombre_tema']; ?>
									</label>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						<div class="custom-control custom-radio">
							<input id="checktema2norma0" name="idtema2" type="radio" value="0" class="custom-control-input" >
							<label class="custom-control-label" for="checktema2norma0" >
								Otro
							</label>
						</div>
						<div id="otrotema2normadatosedit">
							<label for="otrotema2normaed">Otro tema:</label><br>
							<input type="text" id="otrotema2normaed" name="otrotema2normaed"  class="form-control" value="" >
							<input type="hidden" id="idotrotema2" name="idotrotema2"
								   value="<?php
								   if($otro_tema2 != null){
									   echo $otro_tema2->idnotema;
								   }
								   ?>" >
							<input type="hidden" id="idrelacionaltema2" name="idrelacionaltema2"
								   value="<?php
								   if($tema2 != false){
									   echo $tema2->idntema;
								   }

								   ?>" >
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="3" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="normamodalfechaprimerenvio">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Fecha del primer envio</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarFechaPrimerEnvio/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<?php if($norma->estado_norma == 'promulgada'): ?>

					<label for="fecha_primer_envio_pre">Fecha del primer envio:</label>
					<input type="date" id="fecha_primer_envio_pre" name="fecha_primer_envio_pre" class="form-control"
						   value="<?php
							   if($norma->fecha_primer_envio != 0){
								   echo mdate('%Y-%m-%d', $norma->fecha_primer_envio);
							   }
						   ?>" required >

					<?php endif; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="3" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
				<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>


</main>
