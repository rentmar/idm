<html>
	
<!--	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
		<div id="caja_boton">
			<div id="contenedor-submit">
                            <form method="post" action="<?php //echo site_url('Seguimientomonitores/CuestionariosPorDepartamentoUsuario');?>">
                                    <?php //foreach ($NumeroDeCuestionarios as $ff) {?>
                                    <input type="hidden" name="<?php //echo $ff->nombre_cuestionario;?>" id="<?php //echo $ff->nombre_cuestionario;?>" value="<?php //echo $ff->nombre_cuestionario;?>">
                                    <input type="submit" class="BOTON" value="<?php //echo $ff->nombre_cuestionario;?>">
                                    <?php //} ?>
                            </form>
			</div>
		</div>
	</div>-->
	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
		<table>
			<tr id="datos">
			<th>Departamento</th>	
			<th>Cuestionarios</th>

			</tr>
			<?php foreach ($Departamentos as $f) {?>
			<tr>
				<td><?php echo $f->nombre_departamento;?></td>
				<td><?php echo $f->ndepartamento;?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</html>