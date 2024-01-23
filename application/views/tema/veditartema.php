<main role="main" >
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Tema</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo base_url().'index.php/Tema/modificarTema/'.$tema->idtema; ?>" method="post">
							<label for="nombre_tema" class="form-group"> Nombre de Tema </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_tema"  value="<?php echo $tema->nombre_tema;?>" required>
							<br><br>
							<label for="cuestionario" class="form-group"> Formulario del Tema </label>
							<span class="rojo"> * </span>
							<br>
							<select name="idcuestionario" id="idcuestionario">
								<?php foreach ($cuestionarios as $c) {?>
									<?php if ($c->idcuestionario==$tema->rel_idcuestionario) { ?>
										<option selected="true" value="<?php echo $c->idcuestionario;?>"><?php echo $c->nombre_cuestionario;?></option>
									<?php } ?>
									<?php if ($c->idcuestionario!=$tema->rel_idcuestionario) { ?>
										<option value="<?php echo $c->idcuestionario;?>"><?php echo $c->nombre_cuestionario;?></option>
									<?php } ?>
								<?php } ?>
							</select>
							<br><br>
							<input type="submit" id="BOTON" value="EDITAR">
							<a href="<?php echo site_url('Tema/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>
