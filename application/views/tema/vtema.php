<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('Tema/crearTema');?>">
							<input type="submit" class="BOTON" value="CREAR">
						</a>
						<a href="<?php echo site_url('/');?>">
							<input type="submit" class="BOTONROJO" value="CANCELAR">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<thead>
						<tr id="datos">
							<th>Nro</th>
							<th>Tema</th>
							<th>Formulario</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($temas as $t) {?>
						<tr>
							<td><?php echo $t->idtema;?></td>
							<td><?php echo $t->nombre_tema;?></td>
							<td><?php echo $t->nombre_cuestionario;?></td>
							<td><a href="<?php echo site_url('Tema/editarTema/'.$t->idtema);?>">
									<i class="fas fa-edit"></i>
								</a>
							</td>
						</tr>
					<?php } ?>

					</tbody>


				</table>
			</div>

		</div>
	</div>
	<br>
</main>

