<main role="main">
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<h3 class="text-center" >
					<?php echo $cuestionario->nombre_cuestionario;?>
				</h3>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<table class="table table-striped table-hover ">
					<thead>
					<tr>
						<th>Fecha Registro</th>
						<th>Fecha Norma</th>
						<th>Instancia</th>
						<th>Estado</th>
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Accion</th>
					</tr>
					</thead>
					<tbody>
					<?php if(isset($normas)): ?>
						<?php foreach ($normas as $n): ?>
						<tr>
							<td> <?php echo mdate('%m-%d-%Y', $n->fecha_registro); ?> </td>
							<td> <?php if($n->fecha_norma != '0'){echo mdate('%m-%d-%Y', $n->fecha_norma);}  ?> </td>
							<td> <?php echo $n->instancia; ?> </td>
							<td> <?php echo $n->estado_norma; ?> </td>
							<td> <?php echo $n->norma_codigo; ?> </td>
							<td> <?php echo $n->norma_nombre; ?> </td>
							<td>
								<a href="<?php echo site_url('normativa/editarNorma/'.$n->idnormag); ?>">
									Editar<i class="fas fa-edit"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
			</div>






		</div>
	</div>

</main>
