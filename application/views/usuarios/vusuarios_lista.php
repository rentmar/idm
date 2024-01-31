<main role="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('Usuarios/crearUsuario/'.$grupo);?>">
							<input type="submit" class="BOTON" value="CREAR">
						</a>
						<a href="<?php echo site_url('/'); ?>">
							<input type="submit" class="BOTONROJO" value="CANCELAR">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<h3 class="text-center">
					<?php echo "Usuarios ".$titulo; ?>
				</h3>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table id="usuarios-tabla" class="table">
					<thead class="thead-dark">
						<tr>
							<th>Nro.</th>
							<th>Usuario</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Departamento</th>
							<th>Accion</th>
						</tr>
					</thead>
					<?php foreach ($usuarios as $u):?>
						<?php if($u->idusuario !=1): ?>
						<tr>
							<td><?php echo $u->idusuario;?></td>
							<td><?php echo $u->username;?></td>
							<td><?php echo $u->first_name;?></td>
							<td><?php echo $u->last_name;?></td>
							<td><?php echo $u->nombre_departamento;?></td>
							<td>
								<a  href="<?php echo site_url('Usuarios/editarUsuario/'.$u->idusuario);?>" data-toggle="tooltip" title="Editar Usuario">
									<i class="fas fa-user-edit"></i>
								</a>

								<?php if($u->active): ?>
									<a href="<?php echo site_url('usuarios/cambiarEstadoUsuario/'.$u->idusuario);?>" data-toggle="tooltip" title="Activa/Desactiva">
										<i class="fas fa-toggle-on"></i>
									</a>
								<?php else: ?>
									<a href="<?php echo site_url('usuarios/cambiarEstadoUsuario/'.$u->idusuario);?>" data-toggle="tooltip" title="Activa/Desactiva" >
										<i class="fas fa-toggle-off"></i>
									</a>
								<?php endif; ?>

							</td>
						</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>


</main>
