<main role="main">
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

						<div class="form-row">
							<div class="col-10">
								<label for="codigo" >
									Codigo:
								</label>
								<input class="form-control" type="text" id="codigo" name="codigo" readonly
									   value="<?php
									   	if( isset($norma->norma_codigo)){
									   		echo $norma->norma_codigo;
										}
									   ?>" >
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#normamodaldatosgenerales" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Datos Generales del proyecto de ley
								</button>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="objetonorma" >
									Nombre de la norma:
								</label>
								<textarea readonly class="form-control" id="objetonorma" name="objetonorma"  rows="3"><?php if(isset($norma->norma_nombre)){echo $norma->norma_nombre;} ?></textarea>

							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="objetonorma" >
									Objeto de la norma:
								</label>
								<textarea readonly class="form-control" id="objetonorma" name="objetonorma"  rows="3"><?php if(isset($norma->norma_objeto)){echo $norma->norma_objeto;} ?></textarea>

							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
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
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="proponente" >
										Proponente:
									</label>
									<?php $prp = strtolower($norma->proponente); ?>
									<?php if($prp == 'otros'): ?>
										<input class="form-control" type="text" id="proponente" name="proponente" disabled="true" value="<?php echo $prp;  ?>">
										<input class="form-control" type="text" id="notaproponente" name="notaproponente" disabled="true" value="<?php echo $otro_proponente->otro_descripcion;  ?>">
									<?php else: ?>
										<input class="form-control" type="text" id="proponente" name="proponente" disabled="true" value="<?php echo $prp;  ?>">
									<?php endif; ?>

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
						<div class="form-row">
							<div class="col-10">
								<label for="fecha_norma_primer_envio" >
									Fecha de presentacion:
								</label>
								<input type="date" id="fecha_norma_primer_envio" name="fecha_norma_primer_envio" class="form-control" readonly
									   value="<?php
									    	if(isset($norma->fecha_norma)){
												if($norma->fecha_norma!=0){
													echo mdate('%Y-%m-%d', $norma->fecha_norma);
												}else{
													echo '';
												}
												
											}
										?>" >
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#normamodalpresentacion" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Editar presentacion del proyecto de ley
								</button>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="normaremitente" >
									Quien presenta el proyecto de ley:									:
								</label>
								<input class="form-control" id="normaremitente" name="normaremitente" value="<?php if(isset($norma->norma_remitente)){echo $norma->norma_remitente;} ?>" readonly>
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="normadest" >
									A quien se presenta el proyecto de ley:
								</label>
								<input class="form-control" id="normaremitente" name="normaremitente" value="<?php if(isset($norma->norma_destinatario)){echo $norma->norma_destinatario;} ?>" readonly>
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="fechasol" >
									Fecha de solicitud de reposicion:
								</label>
								<input class="form-control" id="fechasol" type="date" name="fechasol" 
								value="
								<?php
									    	if(isset($norma->fecha_sol_repo)){
												if($norma->fecha_sol_repo != 0){
													echo mdate('%Y-%m-%d', $norma->fecha_sol_repo);
												}else{
													echo '';
												}
												
											}
										?>


								<?php 
								//if(isset($norma->fecha_sol_repo))
								//{echo mdate('%Y-%m-%d', $norma->fecha_sol_repo);} ?>
								
								" readonly>

							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#normamodalreposicion" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Editar ultima reposicion del proyecto de ley
								</button>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="destsol" >
									A quien se presenta solicitud de reposicion:
								</label>
								<input class="form-control" id="destsol" name="destsol" value="<?php if(isset($norma->destinatario_solrepo)){echo $norma->destinatario_solrepo;} ?>" readonly>
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="reposicionsol">
									Quien presenta solicitud de reposicion:
								</label>
								<input class="form-control" id="reposicionsol" name="reposicionsol" readonly value="<?php if(isset($norma->proponente_solrepo)){echo $norma->proponente_solrepo;}   ?>">
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="observaciones">
									Observaciones
								</label>
								<textarea readonly class="form-control" id="observaciones" name="observaciones"><?php if(isset($norma->norma_observaciones)){echo $norma->norma_observaciones;}   ?></textarea>

							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#normamodalotros" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Editar otros
								</button>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="enlace" >
									Enlace
								</label>
								<input class="form-control" id="enlace" type="text" name="enlace" value="<?php if(isset($norma->enlace)){echo $norma->enlace;} ?>" readonly>
							</div>
							<div class="col-2"></div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<label for="obsmet" >
									Observaciones metodologicas
								</label>
								<textarea readonly class="form-control" id="obsmet" name="obsmet"><?php if(isset($norma->obs_metodologicas)){echo $norma->obs_metodologicas;} ?></textarea>
							</div>
							<div class="col-2"></div>
						</div>







					</div>

				</div>

			</div>
		</div>
	</div>
</main>


<div class="modal" id="normamodaldatosgenerales">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar datos generales</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNmplDatos/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="codigonorma">Codigo:</label>
					<input type="text" class="form-control" id="codigonorma" name="codigonorma"
						   value="<?php
							   if( isset($norma->norma_codigo)){
								   echo $norma->norma_codigo;
							   }
						   ?>">
				</div>
				<div class="form-group">
					<label for="nombrenorma">Nombre de la norma:</label>
					<textarea class="form-control" rows="3" id="nombrenorma" name="nombrenorma"><?php if(isset($norma->norma_nombre)){echo $norma->norma_nombre;} ?></textarea>
				</div>
				<div class="form-group">
					<label for="objetonorma">Objeto de la norma:</label>
					<textarea class="form-control" id="objetonorma" name="objetonorma"  rows="3"><?php if(isset($norma->norma_objeto)){echo $norma->norma_objeto;} ?></textarea>
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

<div class="modal" id="normamodalpresentacion">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar presentacion del proyecto de ley:</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNmpPresentacion/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="fechapresentacion">Fecha de presentacion:</label>
					<input type="date" class="form-control" id="fechapresentacion" name="fechapresentacion"
						   value="<?php
									    	if(isset($norma->fecha_norma)){
												if($norma->fecha_norma!=0){
													echo mdate('%Y-%m-%d', $norma->fecha_norma);
												}else{
													echo '';
												}
												
											}
										?>">
				</div>
				<div class="form-group">
					<label for="normaremitente">Quien presenta el proyecto de ley:</label>
					<input class="form-control" id="normaremitente" name="normaremitente" value="<?php if(isset($norma->norma_remitente)){echo $norma->norma_remitente;} ?>">
				</div>
				<div class="form-group">
					<label for="normadestinatario">A quien se presenta el proyecto de ley:</label>
					<input class="form-control" id="normadestinatario" name="normadestinatario" value="<?php if(isset($norma->norma_destinatario)){echo $norma->norma_destinatario;} ?>" >
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

<div class="modal" id="normamodalreposicion">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar ultima reposicion del proyecto de ley:</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNmplReposicion/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="fechareposicion">Fecha de reposicion:</label>
					<input type="date" class="form-control" id="fechareposicion" name="fechareposicion"
						   value="<?php
						   if(isset($norma->fecha_sol_repo)){
							if($norma->fecha_sol_repo != 0){
								echo mdate('%Y-%m-%d', $norma->fecha_sol_repo);
							}else{
								echo '';
							}
							
						}



						   /*if(isset($norma->fecha_sol_repo)){
							   echo mdate('%Y-%m-%d', $norma->fecha_sol_repo);
						   }*/
						   ?>">
				</div>
				<div class="form-group">
					<label for="normaremitenterepo">A quien se presenta solicitud de reposicion:</label>
					<input class="form-control" id="normaremitenterepo" name="normaremitenterepo" value="<?php if(isset($norma->proponente_solrepo)){echo $norma->proponente_solrepo;} ?>">
				</div>
				<div class="form-group">
					<label for="normadestinatariorepo">Quien presenta solicitud de reposicion:</label>
					<input class="form-control" id="normadestinatariorepo" name="normadestinatariorepo" value="<?php if(isset($norma->destinatario_solrepo)){echo $norma->destinatario_solrepo;} ?>" >
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

<div class="modal" id="normamodalotros">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar otros:</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('normativa/editarNmplOtros/'.$norma->idnormag);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="observaciones">
						Observaciones
					</label>
					<textarea class="form-control" id="observaciones" name="observaciones"><?php if(isset($norma->norma_observaciones)){echo $norma->norma_observaciones;}   ?></textarea>
				</div>
				<div class="form-group">
					<label for="enlace" >
						Enlace
					</label>
					<input class="form-control" id="enlace" type="text" name="enlace" value="<?php if(isset($norma->enlace)){echo $norma->enlace;} ?>" >
				</div>
				<div class="form-group">
					<label for="obsmet" >
						Observaciones metodologicas
					</label>
					<textarea  class="form-control" id="obsmet" name="obsmet"><?php if(isset($norma->obs_metodologicas)){echo $norma->obs_metodologicas;} ?></textarea>
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
				<h1 class="modal-title">Editar Tema 1 de la Norma Plurinacional</h1>
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
				<h1 class="modal-title">Editar Tema 2 de la Norma Plurinacional</h1>
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
				<?php elseif ($proponente == ''): ?>	
					<div class="form-group">
						<div class="custom-control custom-radio">
							<input id="proponente_norma_1" name="proponente_norma" type="radio" value="1" class="custom-control-input">
							<label class="custom-control-label" for="proponente_norma_1">
								Oficialismo
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="proponente_norma_2" name="proponente_norma" type="radio" value="2" class="custom-control-input" >
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


