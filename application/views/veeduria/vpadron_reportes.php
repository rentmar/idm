<main role="main" >
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<?php echo form_open('veeduria/procesarConsulta'); ?>
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
						<h3> Reporte Formularios Veeduria </h3>

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
					<h3>Reporte formulario veeduria </h3>

					<br>
					<div class="form-group">
						<!--<select id="veeduriaform" name="veeduriaform" class="form-control simple"  >
							<option value="0" >Seleccione una opcion</option>
							<?php /*foreach ($forms_veeduria as $fm): */?>
								<option value="<?php /*echo $fm->idfv; */?>" >
									<?php /*echo $fm->nombre; */?>
								</option>
							<?php /*endforeach;  */?>
						</select>-->
					</div>
					<div class="form-row">
						<input type="submit" class="BOTON" value="GENERAR" name="tema">
					</div>
				</div>
				<?php echo form_close(); ?>

				<br>


			</div>
		</div>
	</div>
	<br>

</main>
