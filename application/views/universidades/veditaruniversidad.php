<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Universidad</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo base_url().'index.php/Universidad/modificarUniversidad/'.$u->iduniversidad; ?>" method="post">
							<br><br>
							<label for="nombre_universidad" class="form-group"> Nombre de Universidad </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_universidad"  value="<?php echo $u->nombre_universidad;?>" required>
							<br><br>
							<label for="sigla_universidad" class="form-group"> Sigla de Universidad </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="sigla_universidad"  value="<?php echo $u->sigla_universidad;?>" required>
							<br><br>
							<label class="form-group"> Seleccionar Departamento/s de la Universidad </label>
							<span class="rojo"> * </span>
							<br>
							<?php $h=0; foreach ($departamentos as $d) { ?>
								<?php foreach ($deptose as $de) {
									if ($de->rel_iddepartamento==$d->iddepartamento)
									{
										$h=1;
										break;
									}
								}
								if ($h==1) { ?>
									<input type="checkbox" checked='true' id='<?php echo "d".$d->iddepartamento; ?>' name='<?php echo "d".$d->iddepartamento; ?>' value='<?php echo $d->iddepartamento; ?>'>
									<label for='<?php echo "d".$d->iddepartamento; ?>'> <?php echo $d->nombre_departamento;?></label><br>
								<?php } ?>
								<?php if ($h==0) { ?>
									<input type="checkbox" id='<?php echo "d".$d->iddepartamento; ?>' name='<?php echo "d".$d->iddepartamento; ?>' value='<?php echo $d->iddepartamento; ?>'>
									<label for='<?php echo "d".$d->iddepartamento; ?>'> <?php echo $d->nombre_departamento;?></label><br>
								<?php } ?>
								<?php $h=0; } ?>
							<br>
							<input type="submit" id="BOTON" value="EDITAR">
							<a href="<?php echo site_url('Universidad/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>
