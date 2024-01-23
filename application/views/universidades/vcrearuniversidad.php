<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Crear Nueva Universidad</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo base_url().'index.php/Universidad/agregarUniversidad'; ?>" method="post">
							<br>
							<label for="nombre_universidad" class="form-group"> Nombre de Universidad </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_universidad"  required>
							<br><br>
							<label for="sigla_universidad" class="form-group"> Sigla de Universidad </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="sigla_universidad"  required>
							<br><br>
							<label class="form-group"> Seleccionar Departamento/s de la Universidad </label>
							<span class="rojo"> * </span>
							<br>
							<input type="checkbox" id='d0' name='d0' value='0'>
							<label for='d0'>Nacional</label><br>
							<br>
							<?php foreach ($departamentos as $d) {?>
								<input type="checkbox" id='<?php echo "d".$d->iddepartamento; ?>' name='<?php echo "d".$d->iddepartamento; ?>' value='<?php echo $d->iddepartamento; ?>'>
								<label for='<?php echo "d".$d->iddepartamento; ?>'> <?php echo $d->nombre_departamento;?></label><br>
							<?php } ?>
							<br>
							<input type="submit" id="BOTON" value="CREAR">
							<a href="<?php echo site_url('Universidad/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
							<br>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>




