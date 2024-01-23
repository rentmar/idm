<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Datos de  Usuario </h3>
						<p></p>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<?php echo form_open('Usuarios/procesarEditar')?>
						<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario->id; ?>" >
						<input type="hidden" id="idgrupo" name="idgrupo" value="<?php echo $grupo->group_id; ?>" >

						<label for="nombre" class="form-group"> Nombre </label>
						<span class="red"> * </span>
						<br>
						<input type="text" id="cuadro" name="nombre" value="<?php echo $usuario->first_name; ?>" >
						<br><br>
						<label for="apellido" class="form-group"> Apellido </label>
						<span class="red"> * </span>
						<br>
						<input type="text" id="cuadro" name="apellido" value="<?php echo $usuario->last_name; ?>" >
						<br><br>
						<label for="carnet" class="form-group"> Carnet de identidad </label>
						<span class="red"> * </span>
						<br>
						<input type="text" id="cuadro" name="carnet" value="<?php echo $usuario->carnet_identidad;?>" >
						<br><br>
                        <label for="iddepartamento" class="form-group">Departamento</label>
                        <select id="iddepartamento" name="iddepartamento" class="form-control" required>
									<option value="">Seleccione un departamento</option>
                            <?php foreach ($departamentos as $d): ?>
                                <?php if($d->iddepartamento == $usuario->rel_iddepartamento): ?>
                                    <option value="<?php echo  $d->iddepartamento;?>" selected  >
                                        <?php echo $d->nombre_departamento;  ?>
                                    </option>
                                <?php else: ?>
                                    <option value="<?php echo  $d->iddepartamento;?>"  >
                                        <?php echo $d->nombre_departamento;  ?>
                                    </option>
                                <?php endif; ?>

                            <?php  endforeach;  ?>
                        </select>
                        <br><br>
						<label for="iduniversidad" class="form-group">Universidad</label>
                        <select id="iduniversidad" name="iduniversidad" class="form-control" required >
                            <?php foreach ($universidades as $u): ?>
                                <?php if($u->iduniversidad == $usuario->rel_iduniversidad): ?>
                                    <option value="<?php echo  $u->iduniversidad;?>" selected  >
                                        <?php echo $u->nombre_universidad;  ?>
                                    </option>
                                <?php else: ?>
                                    <option value="<?php echo  $u->iduniversidad;?>"  >
                                        <?php echo $u->nombre_universidad;  ?>
                                    </option>
                                <?php endif; ?>
                            <?php  endforeach;  ?>
                        </select>
                       	<br>

						<?php foreach ($usuario_grupos as $sg): ?>
						<?php if($sg->id == 3): ?>
						<div class="form-group">
							<div class="form-check">
								<label class="form-check-label">
									<?php if ($enleyes==0) { ?>
									<input id="grupoleyes" name="grupoleyes" type="checkbox" class="form-check-input" value="4">
									Habilitar Ingreso a Formulario LEYES<?php echo $sg->id;?>
									<?php } ?>
									<?php if ($enleyes!=0) { ?>
									<input checked="true" id="grupoleyes" name="grupoleyes" type="checkbox" class="form-check-input" value="4">
									Habilitar Ingreso a Formulario LEYES<?php echo $sg->id;?>
									<?php } ?>
								</label>
							</div>
						</div>
						<?php endif; ?>
						<?php endforeach; ?>



						<br>
						<label for="direccion" class="form-group">Direccion </label>
						<span class="red">  </span>
						<input type="text" id="direccion" class="form-control" name="direccion" value="<?php echo $usuario->direccion; ?>"  >
						<br><br>

						<label for="ubicacion" class="form-group">Ubicacion </label>
						<span class="red">  </span>
						<input type="text" id="ubicacion" name="ubicacion"  class="form-control" value="<?php echo $usuario->geolocalizacion; ?>"  >
						<br><br>



						<input type="submit" id="BOTON" value="EDITAR USUARIO">
						<a href="<?php echo site_url('Usuarios/Listar/'.$grupo->group_id);?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						<?php echo form_close()?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>
