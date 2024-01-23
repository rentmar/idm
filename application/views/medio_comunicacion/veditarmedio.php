<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Medio de Comunicacion </h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo base_url()."index.php/MedioComunicacion/modificarMedioComunicacion/".$medio->idmedio;?>" method='POST'>
							<label for="idtipomedio" class="form-group"> Seleccionar el Tipo de Medio de Comunicacion </label>
							<span class="rojo"> * </span>
							<br>
							<select class="combo" id='cuadro' name='rel_idtipomedio' required>
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
							<br><br>
							<label for="nombre_medio" class="form-group"> Nombre de Medio de Comunicacion </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_medio"  value="<?php echo $medio->nombre_medio;?>" required>
							<br><br>
							<label class="form-group"> Seleccionar Departamento/s del Medio Comunicacion </label>
							<span class="rojo"> * </span>
							<br>
							<?php $h=0; foreach ($departamentos as $d) { ?>
								<?php foreach ($medio_departamento as $depto) {
									if ($depto->rel_iddepartamento==$d->iddepartamento)
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
							<a href="<?php echo site_url('MedioComunicacion/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
							<br>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>








