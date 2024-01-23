<main role="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
				<div id="esquinas_redondeadas">
					<div id="Caja_de_orden" class="Caja_de_datos">
						<h3 id="Título_central"> Editar Tipo Medio</h3>
					</div>
					<div id="Caja_de_datos" class="Caja_de_datos">
						<form action="<?php echo base_url().'index.php/tipoMedio/modificarTipoMedio/'.$tm->idtipomedio; ?>" method="post">
							<label for="nombre_tipomedio" class="form-group"> Nombre de Tipo Medio </label>
							<span class="rojo"> * </span>
							<br>
							<input type="text" id="cuadro" name="nombre_tipomedio" value="<?php echo $tm->nombre_tipo;?>" required>
							<br><br>
							<input type="submit" id="BOTON" value="EDITAR">
							<a href="<?php echo site_url('tipoMedio/');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</main>



