<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar SubTema</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo base_url().'index.php/SubTema/modificarSubTema/'.$subtema->idsubtema; ?>" method="post">
							<label for="nombre_subtema" class="form-group"> Nombre de SubTema </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_subtema" value="<?php echo $subtema->nombre_subtema;?>" required>
							<br><br>
							<label for="idtema" class="form-group"> Escoger Tema al que pertenece el SubTema</label>
							<span class="rojo"> * </span>
							<br>
							<select name="idtema" id="idtema">
								<option value="0"></option>
								<?php foreach ($temas as $t) {?>
									<?php if ($t->idtema==$subtema->rel_idtema) {?>
										<option selected="true" value="<?php echo $t->idtema;?>"><?php echo $t->nombre_tema;?></option>
									<?php } ?>
									<?php if ($t->idtema!=$subtema->rel_idtema) {?>
										<option value="<?php echo $t->idtema;?>"><?php echo $t->nombre_tema;?></option>
									<?php } ?>
								<?php } ?>
							</select>
							<br><br>
							<input type="submit" id="BOTON" value="EDITAR">
							<a href="<?php echo site_url('SubTema/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>



