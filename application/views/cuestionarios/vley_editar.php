<main role="main" >
	<br><br>
	<div class="container" style="background-color:#7c5295">
	<br>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<br>
				<div class="card">
					<div class="card-header;" >
						<h4>Editar Ley</h4>
					</div>
					<div class="card-body ">
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="rel_idfuente" >
										Fuente de la Ley
									</label>
									<select class="combo" id='cuadro' name='rel_idfuente' disabled="true" required>
										<option value="0"></option>
										<?php foreach ($fuentes as $f) {?>
											<?php if ($f->idfuente == $fuente->rel_idfuente) {?>
											<option selected='true' value='<?php echo $f->idfuente;?>'><?php echo $f->nombre_fuente;?></option>
											<?php } ?>
											<?php if ($f->idfuente != $fuente->rel_idfuente) {?>
											<option value='<?php echo $f->idfuente;?>'><?php echo $f->nombre_fuente;?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#fuentemodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Fuente de Ley
								</button>
							</div>
						</div>
		
						<div class="form-row">
							<div class="col">
								<hr  style="height:2px;border:none;color:#333;background-color:#333;">
							</div>
						</div>
						
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="resumen" >
										Resumen:
									</label>
									<textarea id="resumen" name="resumen" class="form-control" disabled="true" required>
										<?php echo $ley->resumen; ?>
									</textarea>
								</div>
							</div>
							<div class="col-2">
								<button type="submit" data-toggle="modal" data-target="#resumenmodal" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
									Cambiar Resumen
								</button>
							</div>
						</div>
						<br>
						<div class="form-row">
							<div class="col">
								<hr  style="height:2px;border:none;color:#333;background-color:#333;">
							</div>
						</div>
						<?php foreach ($datosestado as $de) {?>
							<div class="form-row">
								<div class="col-10">
									<div class="form-group">
									<label for="fecha<?php echo $de['idestadoley'];?>" >
										Fecha <?php echo $de['nombre_estadoley'];?>:
									</label>
									<input type="date" id="fecha<?php echo $de['idestadoley'];?>" name="fecha<?php echo $de['idestadoley'];?>" class="form-control" disabled="true"
										   value="<?php echo mdate('%Y-%m-%d', $de['fecha_estadoley']);?>" >
									</div>
								</div>
								<div class="col-2">
									<button type="submit" data-toggle="modal" data-target="#datosmodal<?php echo $de['idestadoley'];?>" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
										Editar Datos Estado <?php echo $de['nombre_estadoley'];?>
									</button>
								</div>
							</div>
							<div class="form-row">
								<div class="col-10">
									<div class="form-group">
										<label for="tituloley<?php echo $de['idestadoley'];?>" >
											Titulo <?php echo $de['nombre_estadoley'];?>:
										</label>
										<textarea id="cuadro" name="tituloley<?php echo $de['idestadoley'];?>" required class="form-control" disabled="true">
											<?php echo $de['nombre_ley']; ?>
										</textarea>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-10">
									<div class="form-group">
										<label for="codigoley<?php echo $de['idestadoley'];?>" >
											Codigo <?php echo $de['nombre_estadoley'];?>:
										</label>
										<input id="codigoley" name="codigoley<?php echo $de['idestadoley'];?>" class="form-control" disabled="true" 
												value="<?php echo $de['codigo_ley']; ?>" >
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-10">
									<div class="form-group">
										<label for="urlley<?php echo $de['idestadoley'];?>" >
											URL <?php echo $de['nombre_estadoley'];?>:
										</label>
										<input id="urlley" name="urlley<?php echo $de['idestadoley'];?>" class="form-control" disabled="true" 
												value="<?php echo $de['url_ley']; ?>" >
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col">
									<hr  style="height:2px;border:none;color:#333;background-color:#333;">
								</div>
							</div>
						<?php } ?>
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
													<label style="background-color: #0099CC" for="t<?php echo $tema->nombre_tema; ?>"><?php echo $tema->nombre_tema; ?></label><br>
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
										<hr style="height:2px;border:none;color:#333;background-color:#333;">
									</div>
								</div>
								<?php if ($otrotema!=NULL) {?>
									<div class="form-group">
									<input disabled="true" type="checkbox" checked="true" id="ot<?php echo $otrotema->idotrotema;?>" name="ot<?php echo $otrotema->idotrotema;?>" value="<?php echo $otrotema->idotrotema;?>">
									<label style="background-color: #0099CC" for="ot<?php echo $otrotema->idotrotema;?>">Otro Tema</label><br>		
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
						</div>
						<div class="form-row">
								<div class="col">
									<hr  style="height:2px;border:none;color:#333;background-color:#333;">
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
												<label style="background-color: #0099CC" for="st<?php echo $st->nombre_subtema; ?>"><?php echo $st->nombre_subtema; ?></label><br>
											<?php break; } ?>
											<?php } ?>
											<?php if ($st->idsubtema!=$subtemaelegido->idsubtema) { ?>
												<input disabled="true" type="checkbox"  id="st<?php echo $st->idsubtema; ?>" name="st<?php echo $st->idsubtema; ?>" value="<?php echo $st->idsubtema; ?>">
												<label for="st<?php echo $st->nombre_subtema; ?>"><?php echo $st->nombre_subtema; ?></label><br>
											<?php } ?>
										<?php } ?>
										<div class="form-row">
										<div class="col">
											<hr  style="height:2px;border:none;color:#333;background-color:#333;">
											</div>
										</div>
										<?php if ($otrosubtema!=NULL) {?>
										<div class="form-group">
											<input disabled="true" type="checkbox" checked="true" id="ost<?php echo $otrosubtema->idotrosubtema;?>" name="ost<?php echo $otrosubtema->idotrosubtema;?>" value="<?php echo $otrosubtema->idotrosubtema;?>">
											<label style="background-color: #0099CC" for="ost<?php echo $otrosubtema->idotrosubtema;?>">Otro SubTema</label><br>		
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
									<hr  style="height:2px;border:none;color:#333;background-color:#333;">
								</div>
							</div>
									
						</div>
					</div>
							
				</div>
			</div>
		</div>
	</div>
</main>

<div class="modal" id="fuentemodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Fuente de Ley</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('Ley/modificarLey/'.$ley->idleyes);?>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="idleyes" name="idleyes"
						value="<?php echo $ley->idleyes;?>">
				</div>
				<div class="form-group">
					<label for="rel_idleyes">
						Seleccionar Fuente
					</label>
					<select class="combo" id='cuadro' name='rel_idfuente' required>
						<option value="0"></option>
						<?php foreach ($fuentes as $f) {?>
						<option value='<?php echo $f->idfuente;?>'><?php echo $f->nombre_fuente;?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="1" class="btn btn-primary" style="background-color:#474142; color:#ffffff">
					Editar
				</button>
			<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="resumenmodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Resumen de la Ley</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('Ley/modificarLey/'.$ley->idleyes);?>
			<div class="modal-body">
				<div class="form-row">
					<div class="col-10">
						<div class="form-group">
							<label for="resumen" >
								Resumen:
							</label>
							<textarea id="resumen" name="resumen" class="form-control"  required>
								<?php echo $ley->resumen; ?>
							</textarea>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="submit" name="accion" value="2" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
			<?php echo form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
<?php foreach ($datosestado as $de) {?>
<div class="modal" id="datosmodal<?php echo $de['idestadoley'];?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Datos del Estado de <?php echo $de['nombre_estadoley'];?></h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('Ley/modificarLey/'.$ley->idleyes);?>
			<div class="modal-body">
				<div class="form-row">
					<div class="col">
						<hr  style="height:2px;border:none;color:#333;background-color:#333;">
					</div>
				</div>
					<div class="form-row">
							<div class="col-10">
								<div class="form-group">
								<label for="fecha<?php echo $de['idestadoley'];?>" >
									Fecha <?php echo $de['nombre_estadoley'];?>:
								</label>
								<input type="hidden" id="el" name="el" value="<?php echo $de['idestadoley'];?>">
								<input type="hidden" id="idestadoley<?php echo $de['idestadoley'];?>" name="idestadoley<?php echo $de['idestadoley'];?>" class="form-control" 
									   value="<?php echo $de['idestadoley'];?>" >
								<input type="date" id="fecha<?php echo $de['idestadoley'];?>" name="fecha<?php echo $de['idestadoley'];?>" class="form-control" 
									   value="<?php echo mdate('%Y-%m-%d', $de['fecha_estadoley']);?>" >
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="tituloley<?php echo $de['idestadoley'];?>" >
										Titulo <?php echo $de['nombre_estadoley'];?>:
									</label>
									<textarea id="cuadro" name="tituloley<?php echo $de['idestadoley'];?>" required class="form-control">
										<?php echo $de['nombre_ley']; ?>
									</textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="codigoley<?php echo $de['idestadoley'];?>" >
										Codigo <?php echo $de['nombre_estadoley'];?>:
									</label>
									<input id="codigoley" name="codigoley<?php echo $de['idestadoley'];?>" class="form-control" 
											value="<?php echo $de['codigo_ley']; ?>" >
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-10">
								<div class="form-group">
									<label for="urlley<?php echo $de['idestadoley'];?>" >
										URL <?php echo $de['nombre_estadoley'];?>:
									</label>
									<input id="urlley" name="urlley<?php echo $de['idestadoley'];?>" class="form-control"  
											value="<?php echo $de['url_ley']; ?>" >
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<hr  style="height:2px;border:none;color:#333;background-color:#333;">
							</div>
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
<?php } ?>
<div class="modal" id="temamodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Editar Tema/s</h1>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('Ley/editarTemas');?>
			<div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="idley" name="idley"
						value="<?php echo $ley->idleyes; ?>">
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
					<input type="text" id="otrotema" name="otrotema" value="<?php echo $otrotema->nombre_otrotema;?>" required>
				</div>
				<?php } ?>
				<div class="form-row">
					<div class="col">
						<hr style="height:2px;border:none;color:#333;background-color:#333;">
					</div>
				</div>
				<?php if ($otrotema==NULL) {?>
				<div class="form-group">
					<input type="checkbox" id="idot" name="idot" value="0">
					<label for="ot0">Otro Tema</label><br>		
				</div>
				<div class="form-group">
					<label for="otrotema">Especificar Otro Tema</label><br>
					<input type="text" id="otrotema" name="otrotema" value="" >
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