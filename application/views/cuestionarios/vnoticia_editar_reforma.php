<main role="main" >
	<br><br>
	<div class="container" style="background-color:#93C90F;">
	<br>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<br>
				<div class="card">
					<div class="card-header">
						<h4>Editar Noticia</h4>
					</div>
					<div class="card-body ">
						<div class="form-row">
							<div class="col-10">
								<label for="fecha" >
									Fecha:
								</label>
								<input type="date" id="fecha" name="fecha" class="form-control" disabled="true"
									   value="<?php echo mdate('%Y-%m-%d', $noticia->fecha_noticia);?>" >
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#fechamodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Fecha
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
									<label for="rel_idtipomedio" >
										Tipo Medio
									</label>
									<select class="combo" id='cuadro' name='rel_idtipomedio' disabled="true" required>
										<option value="0"></option>
										<?php foreach ($tipos as $tm) {?>
											<?php if ($tm->idtipomedio == $medio->rel_idtipomedio) {?>
											<option selected='true' value='<?php echo $tm->idtipomedio;?>'><?php echo $tm->nombre_tipo;?></option>
											<?php } ?>
											<?php if ($tm->idtipomedio != $medio->rel_idtipomedio) {?>
											<option value='<?php echo $tm->idtipomedio;?>'><?php echo $tm->nombre_tipo;?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#mediomodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Medio Comunicacion
								</button>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="medio" >
										Medio de Comunicacion
									</label>
									<select class="combo" id='cuadro' name='medio' disabled="true" required>
										<option value="0"></option>
										<?php foreach ($medios as $m) {?>
											<?php if ($m->idmedio == $medio->idmedio) {?>
											<option selected='true' value='<?php echo $m->idmedio;?>'><?php echo $m->nombre_medio;?></option>
											<?php } ?>
											<?php if ($m->idmedio != $medio->idmedio) {?>
											<option value='<?php echo $m->idmedio;?>'><?php echo $m->nombre_medio;?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
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
									<label for="titular" >
										Titular:
									</label>
									<input type="text" id="titular" name="titular" class="form-control" disabled="true"
										   value="<?php echo $noticia->titular; ?>" required>
								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#datosmodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Datos Noticia
								</button>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="resumen" >
										Resumen:
									</label>
									<textarea id="resumen" name="resumen" required class="form-control" disabled="true">
										<?php echo $noticia->resumen; ?>
									</textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="url" >
										url:
									</label>
									<input id="url" name="url" class="form-control" disabled="true" value="<?php echo $noticia->url_noticia; ?>" >
								</div>
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

									<label style="font-size:20px">
										Seleccionar Actor/es:
									</label><br>
									<?php foreach ($actores as $a ) { ?>
										<?php foreach ( $na as $n) { ?>
											<?php if ($a->idactor==$n->rel_idactor) { ?>
												<input disabled="true" type="checkbox" checked="true" id="a<?php echo $a->idactor; ?>" name="a<?php echo $a->idactor; ?>" value="<?php echo $a->idactor; ?>">
												<label style="background-color: #ccc" for="a<?php echo $a->idactor; ?>"><?php echo $a->nombre_actor; ?></label><br>
											<?php break; } ?>
										<?php } ?>
										<?php if ($a->idactor!=$n->rel_idactor) { ?>
											<input disabled="true" type="checkbox" id="a<?php echo $a->idactor; ?>" name="a<?php echo $a->idactor; ?>" value="<?php echo $a->idactor; ?>">
											<label for="a<?php echo $a->idactor; ?>"><?php echo $a->nombre_actor; ?></label><br>
										<?php } ?>
									<?php } ?>

								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#actormodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Actor/es
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
									<label style="font-size:20px">
										Seleccionar Tema/s:
									</label><br>
									<?php foreach ($temas as $tema) { ?>
										<?php if ($subtemas!=null) { ?>
											<?php foreach ( $temase as $temaelegido) { ?>
												<?php if ($tema->idtema==$temaelegido->idtema) { ?>
													<input disabled="true" type="checkbox" checked="true" id="t<?php echo $tema->idtema; ?>" name="t<?php echo $tema->idtema; ?>" value="<?php echo $tema->idtema; ?>">
													<label style="background-color: #ccc" for="t<?php echo $tema->nombre_tema; ?>"><?php echo $tema->nombre_tema; ?></label><br>
												<?php break; } ?>
											<?php } ?>
											<?php if ($tema->idtema!=$temaelegido->idtema) { ?>
												<input disabled="true" type="checkbox"  id="t<?php echo $tema->idtema; ?>" name="t<?php echo $tema->idtema; ?>" value="<?php echo $tema->idtema; ?>">
												<label for="t<?php echo $tema->nombre_tema; ?>"><?php echo $tema->nombre_tema; ?></label><br>
											<?php } ?>
										<?php } ?>
										<?php if ($subtemas==null) { ?>
											<input disabled="true" type="checkbox"  id="t<?php echo $tema->idtema; ?>" name="t<?php echo $tema->idtema; ?>" value="<?php echo $tema->idtema; ?>">
											<label for="t<?php echo $tema->nombre_tema; ?>"><?php echo $tema->nombre_tema; ?></label><br>
										<?php } ?>
									<?php } ?>
								</div>
								<div class="form-row">
									<div class="col">
										<hr>
									</div>
								</div>
								<?php if ($otrotema!=NULL) {?>
									<div class="form-group">
									<input disabled="true" type="checkbox" checked="true" id="ot<?php echo $otrotema->idotrotema;?>" name="ot<?php echo $otrotema->idotrotema;?>" value="<?php echo $otrotema->idotrotema;?>">
									<label style="background-color: #ccc" for="ot<?php echo $otrotema->idotrotema;?>">Otro Tema</label><br>		
								</div>
								<div class="form-group">
									<label for="otrotema">Especificar Otro Tema</label><br>
									<input disabled="true" type="text" id="otrotema" name="otrotema" value="<?php echo $otrotema->nombre_otrotema;?>">
								</div>
								<?php } ?>
								<?php if ($otrotema==NULL) {?>
								<div class="form-group">
									<input disabled="true" type="checkbox" id="ot0" name="ot0" value="0">
									<label for="ot0">Otro Tema</label><br>		
								</div>
								<div class="form-group">
									<label for="otrotema">Especificar Otro Tema</label><br>
									<input disabled="true" type="text" id="otrotema" name="otrotema" value="">
								</div>
								<?php } ?>
							</div>
							<div class="col-2">
									<button type="submit" data-toggle="modal" data-target="#temamodal" style="background-color:#474142; color:#ffffff">
										Cambiar Tema/s
									</button>
								</div>
							<div class="form-row">
								<div class="col">
									<hr>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<?php foreach ($temase as $te) { ?>
										<label style="font-size:20px">
											Seleccionar SubTema/s para <?php echo $te->nombre_tema;?>:
										</label><br>
										<?php foreach ($subtemas[$te->idtema] as $st) {?>
											<?php foreach ( $subtemase as $subtemaelegido) { ?>
											<?php if ($st->idsubtema==$subtemaelegido->idsubtema) { ?>
												<input disabled="true" type="checkbox" checked="true" id="st<?php echo $st->idsubtema; ?>" name="st<?php echo $st->idsubtema; ?>" value="<?php echo $st->idsubtema; ?>">
												<label style="background-color: #ccc" for="st<?php echo $st->nombre_subtema; ?>"><?php echo $st->nombre_subtema; ?></label><br>
											<?php break; } ?>
											<?php } ?>
											<?php if ($st->idsubtema!=$subtemaelegido->idsubtema) { ?>
												<input disabled="true" type="checkbox"  id="st<?php echo $st->idsubtema; ?>" name="st<?php echo $st->idsubtema; ?>" value="<?php echo $st->idsubtema; ?>">
												<label for="st<?php echo $st->nombre_subtema; ?>"><?php echo $st->nombre_subtema; ?></label><br>
											<?php } ?>
										<?php } ?>
										<div class="form-row">
											<div class="col">
												<hr>
											</div>
										</div>
										<?php if ($otrosubtema!=NULL) {?>
										<div class="form-group">
											<input disabled="true" type="checkbox" checked="true" id="ost<?php echo $otrosubtema->idotrosubtema;?>" name="ost<?php echo $otrosubtema->idotrosubtema;?>" value="<?php echo $otrosubtema->idotrosubtema;?>">
											<label style="background-color: #ccc" for="ost<?php echo $otrosubtema->idotrosubtema;?>">Otro SubTema</label><br>		
										</div>
										<div class="form-group">
											<label for="otrosubtema">Especificar Otro SubTema</label><br>
											<input disabled="true" type="text" id="otrosubtema" name="otrosubtema" value="<?php echo $otrosubtema->nombre_otrosubtema;?>">
										</div>
										<?php } ?>
										<?php if ($otrosubtema==NULL) {?>
										<div class="form-group">
											<input disabled="true" type="checkbox" id="ost0" name="ost0" value="0">
											<label for="ost0">Otro SubTema</label><br>		
										</div>
										<div class="form-group">
											<label for="otrotema">Especificar Otro SubTema</label><br>
											<input disabled="true" type="text" id="otrosubtema" name="otrosubtema" value="">
										</div>
										<?php } ?>
									<?php } ?>
								</div>
							</div>
									<div class="form-row">
										<div class="col">
											<hr>
										</div>
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

<div class="modal" id="fechamodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Fecha</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('noticia/modificarNoticia/'.$noticia->idnoticia);?>
			<div class="modal-body">
				<div class="form-group">
					<label>Fecha de la Noticia:</label><br>
					<input type="date" id="fecha" name="fecha" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="1" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
			<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="mediomodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Medio de Comunicacion</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('Reformaelectoral/editarMedio');?>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="idnoticia" name="idnoticia"
						value="<?php echo $noticia->idnoticia; ?>">
				</div>
				<div class="form-group">
					<label for="rel_idtipomedio" >
						Seleccionar Tipo Medio
					</label>
					<select class="combo" id='cuadro' name='rel_idtipomedio' required>
						<option value="0"></option>
						<?php foreach ($tipos as $tm) {?>
						<option value='<?php echo $tm->idtipomedio;?>'><?php echo $tm->nombre_tipo;?></option>
						<?php } ?>
					</select>
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

<div class="modal" id="datosmodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Datos de la Noticia</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('noticia/modificarNoticia/'.$noticia->idnoticia);?>
			<div class="modal-body">
				<div class="form-group">
					<label for="titular" >
						Titular:
					</label>
					<input type="text" id="titular" name="titular" class="form-control" value="<?php echo $noticia->titular; ?>"
						 required>
				</div>
				<div class="form-group">
					<label for="resumen" >
						Resumen:
					</label>
					<textarea id="resumen" name="resumen" required class="form-control">
						<?php echo $noticia->resumen; ?>
					</textarea>
				</div>
				<div class="form-group">
					<label for="url" >
						url:
					</label>
					<input id="url" name="url" class="form-control" value="<?php echo $noticia->url_noticia; ?>">			
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

<div class="modal" id="actormodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Actor/es</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('noticia/modificarNoticia/'.$noticia->idnoticia);?>
			<div class="modal-body">
				<div class="form-group">
					<label>
						Seleccionar Actor/es:
					</label><br>
					<?php foreach ($actores as $a ) { ?>
						<input type="checkbox" id="a<?php echo $a->idactor; ?>" name="a<?php echo $a->idactor; ?>" value="<?php echo $a->idactor; ?>">
						<label for="a<?php echo $a->idactor; ?>"><?php echo $a->nombre_actor; ?></label><br>
					<?php } ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="4" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
			<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="temamodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Tema/s</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('Reformaelectoral/editarTemas');?>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="idnoticia" name="idnoticia"
						value="<?php echo $noticia->idnoticia; ?>">
				</div>
				<div class="form-group">
					<label style="font-size:20px">
						Seleccionar Tema/s:
					</label><br>
					<?php foreach ($temas as $tema) { ?>
						<?php if ($subtemas!=null) { ?>
							<?php foreach ( $temase as $temaelegido) { ?>
								<?php if ($tema->idtema==$temaelegido->idtema) { ?>
									<input type="checkbox" checked="true" id="t<?php echo $tema->idtema; ?>" name="t<?php echo $tema->idtema; ?>" value="<?php echo $tema->idtema; ?>">
									<label for="t<?php echo $tema->nombre_tema; ?>"><?php echo $tema->nombre_tema; ?></label><br>
								<?php break; } ?>
							<?php } ?>
							<?php if ($tema->idtema!=$temaelegido->idtema) { ?>
								<input type="checkbox"  id="t<?php echo $tema->idtema; ?>" name="t<?php echo $tema->idtema; ?>" value="<?php echo $tema->idtema; ?>">
								<label for="t<?php echo $tema->nombre_tema; ?>"><?php echo $tema->nombre_tema; ?></label><br>
							<?php } ?>
						<?php } ?>
						<?php if ($subtemas==null) { ?>
							<input type="checkbox"  id="t<?php echo $tema->idtema; ?>" name="t<?php echo $tema->idtema; ?>" value="<?php echo $tema->idtema; ?>">
							<label for="t<?php echo $tema->nombre_tema; ?>"><?php echo $tema->nombre_tema; ?></label><br>
						<?php } ?>
					<?php } ?>
				</div>
				<?php if ($otrotema!=NULL) {?>
				<div class="form-group">
					<input type="checkbox" checked="true" id="idot" name="idot" value="0">
					<label for="idot">Otro Tema</label><br>		
				</div>
				<div class="form-group">
					<label for="otrotema">Especificar Otro Tema</label><br>
					<input type="text" id="otrotema" name="otrotema" value="<?php echo $otrotema->nombre_otrotema;?>">
				</div>
				<?php } ?>
				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>
				<?php if ($otrotema==NULL) {?>
				<div class="form-group">
					<input type="checkbox" id="idot" name="idot" value="0">
					<label for="ot0">Otro Tema</label><br>		
				</div>
				<div class="form-group">
					<label for="otrotema">Especificar Otro Tema</label><br>
					<input type="text" id="otrotema" name="otrotema" value="">
				</div>
				<?php } ?>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Continuar</button>
			<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
</main>