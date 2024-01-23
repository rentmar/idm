<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<?php echo form_open('manejoDB/procesarReportePlenaria/', ['id'=>'repoplenaria',]); ?>
				<div class="contenedor_filtros">
				</div>
				<div class="contenedor">
					<div id="caja_boton">
						<div id="contenedor-submit">
							<a href=""><input type="submit" class="BOTON" value="GENERAR"></a>
						</div><br>
						<div id="contenedor-submit">
							<a href="<?php echo site_url('manejoDB');?>"><input type="" class="BOTONROJO" value="CANCELAR"></a>
						</div>
					</div>
				</div>
				<br>
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
						<h3>Intervalo de fecha (Plenaria) </h3>
						<div class="form-row">
							<div class="col">
								<label for="fecha_inicio" >Inicial:</label>
								<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required >
							</div>
							<div class="col">
								<label for="fecha_fin" >Final:</label>
								<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required >
							</div>
						</div>
					</div>

					<br>

					<h3>Instancia </h3>
					<div class="form-row">
						<select id="idinstanciaple" name="idinstanciaple" class="form-control simple"  >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($instancia as $ins): ?>
									<option value="<?php echo $ins->idinsseg; ?>" >
										<?php echo $ins->instancia; ?>
									</option>
							<?php endforeach;  ?>
						</select>
					</div>


					<br>
					<h3>Departamento </h3>
					<div class="form-row">
						<select id="iddepple" name="iddepple" class="form-control simple"  >
							<option value="0" >Seleccione una opcion</option>
							<?php foreach ($departamentos as $dep): ?>
								<option value="<?php echo $dep->iddepartamento; ?>" >
									<?php echo $dep->nombre_departamento; ?>
								</option>
							<?php endforeach;  ?>
						</select>
					</div>

					<br>
					<h3>Municipio </h3>
					<div  class="form-row">
						<select id="idmunple" name="idmunple" class="form-control simple"  >
							<option value="0" >Seleccione una opcion</option>

						</select>
					</div>

					<br>



				</div>

				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
	<br>

</main>


