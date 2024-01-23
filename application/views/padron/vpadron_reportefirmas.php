<main role="main" >
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<?php echo form_open('padron/procesarConsultaCI'); ?>
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
						<h3>Reporte Reforma Judicial </h3>

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
					<h3>Reporte</h3>

					<br>
					<div class="form-row">
						<input type="submit" class="BOTON" value="GENERAR" name="tema">
					</div>
				</div>
				<?php echo form_close(); ?>

				<br>
				<div class="contenedor">

					<?php echo form_open('padron/procesarConsultaLibros'); ?>
					<h3>Libros Registrados</h3>
					<br>
					<div class="form-row">
						<input type="submit" class="BOTON" value="GENERAR" name="tema">
					</div>
					<?php echo form_close(); ?>

				</div>


			</div>
		</div>
	</div>
	<br>

</main>
