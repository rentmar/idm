<main role="main" >
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<?php echo form_open('ManejoDBL/procesarConsultasimpleley'); ?>
				<div class="contenedor_filtros">
				</div>
				<div class="contenedor">
					<!--Mensaje de Error-->
					<?php if(!empty($this->session->flashdata())): ?>
						<br>
						<div>
							<div id="mensaje-error">
								<div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
									<?php echo $this->session->flashdata('mensaje') ?>
								</div>
							</div>
						</div>
						<br>
					<?php endif; ?>


					<div>
						<h3>Intervalo de fecha </h3>
						<div class="form-row">
							<div class="col">
								<label for="fecha_inicio" >Inicial:</label>
								<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required >
							</div>
							<div class="col">
								<label for="fech_fin" >Final:</label>
								<input type="date" class="form-control" id="fech_fin" name="fecha_fin" required >
							</div>
						</div>
					</div>
					<br>
					<div>
						<div class="form-group">
							<a href="<?php echo site_url('manejoDB');?>"><input type="" class="BOTONROJO" value="SALIR"></a>
						</div>
					</div>
				</div>
				<br>
				<div class="contenedor">
					<h3>Estado de Ley </h3>
					<div class="form-row">
						<select id="idestadol" name="idestadol" class="form-control simple" >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($estadosley as $a): ?>
								<option value="<?php echo $a->idestadoley;?>">
									<?php echo $a->nombre_estadoley; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<br>
					<div class="form-row">
						<input type="submit" class="BOTON" value="GENERAR" name="estadol">
					</div>
				</div>
				<br>
				<div class="contenedor">
					<h3>Universidad </h3>
					<div class="form-row">
						<?php if($this->ion_auth->is_admin()): ?>
							<select id="iduniversidad" name="iduniversidad" class="form-control simple"  >
								<option value="0" >Seleccione una opcion</option>
								<?php foreach ($universidad as $u): ?>
									<option value="<?php echo $u->iduniversidad; ?>">
										<?php echo $u->nombre_universidad;?>
									</option>
								<?php endforeach; ?>
							</select>
						<?php elseif ($this->ion_auth->in_group(2)): ?>
							<input class="form-control" value="<?php echo $un->nombre_universidad;?>" readonly 	>
							<input type="hidden" id="iduniversidad" name="iduniversidad"
								   value="<?php echo $un->iduniversidad; ?>"
							>
						<?php endif; ?>
					</div>
					<br>
					<div class="form-row">
						<input type="submit" class="BOTON" value="GENERAR" name="universidad">
					</div>
				</div>

				<br>
				<div class="contenedor">
					<h3>Tema </h3>
					<div class="form-row">
						<select id="idtema" name="idtema" class="form-control simple" >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($tema as $tm): ?>
								<option value="<?php echo $tm->idtema; ?>" >
									<?php echo $tm->nombre_tema;?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<br>
					<div class="form-row">
						<input type="submit" class="BOTON" value="GENERAR" name="tema">
					</div>
				</div>

				<br>
				<div class="contenedor">
					<h3>Subtema </h3>
					<div class="form-row">
						<select id="idsubtemas" name="idsubtema" class="form-control simple" >
							<option value="0">Seleccione una opcion</option>
							<?php foreach ($stema as $st): ?>
								<option value="<?php echo $st->idsubtema;?>" >
									<?php echo $st->nombre_subtema;?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<br>
					<div class="form-row">
						<input type="submit" class="BOTON" value="GENERAR" name="subtema">
					</div>
				</div>
                          </div>
                 </div>
         </div>
        <br>
</main>
