<main role="main">
	<br>
	<div class="container">
		<div class="row">

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="caja_boton">
					<div id="contenedor-submit">
						<a href="<?php echo site_url('SubTema/crearSubTema');?>"><input type="submit" class="BOTON" value="CREAR"></a>
						<a href="<?php echo site_url('/');?>"><input type="submit" class="BOTONROJO" value="CANCELAR"></a>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table>
					<tr id="datos">
						<th>Nro</th>
						<th>SubTema</th>
						<th>Tema</th>
						<th>Formulario</th>
						<th>Accion</th>
					</tr>
					<?php foreach ($subtemas as $st) {?>
						<tr>
							<td><?php echo $st->idsubtema;?></td>
							<td><?php echo $st->nombre_subtema;?></td>
							<td><?php echo $st->nombre_tema;?></td>
							<td><?php echo $st->nombre_cuestionario; ?></td>
							<td>
								<a href="<?php echo site_url('SubTema/editarSubTema/'.$st->idsubtema);?>">
									<i class="fas fa-edit"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</table>
			</div>

		</div>
	</div>
	<br>
</main>



