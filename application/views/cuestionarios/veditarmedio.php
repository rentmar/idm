<main role="main" >
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores" >
				<?php echo form_open('Noticia/modificarNoticia/'.$idnoticia); ?>
				<br>
				<h1>Editar Medio de Comunicacion</h1>
				<br>
				<div class="card">
					<div class="form-row">
						<div class="col-10">
							<div class="form-group">
								<label for="medio" >
									Seleccionar Medio de Comunicacion
								</label>
								<input type="hidden" id="idnoticia" name="idnoticia"
									value="<?php echo $idnoticia; ?>">
								<select class="combo" id='cuadro' name='idmedio' required>
									<option value="0"></option>
									<?php foreach ($medios as $m) {?>
										<option value='<?php echo $m->idmedio;?>'><?php echo $m->nombre_medio;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>	
					<div>
						<button type="submit" name="accion" value="2" class="btn btn-primary" style="background-color:#474142; color:#ffffff">Editar</button>
						<?php echo form_close();?>
						<?php if ($idcuestionario==1) {?>
							<a href="<?php echo site_url('Reformaelectoral/editarNoticia/'.$idnoticia); ?>" >
								<button type="button" class="btn btn-danger" >Cancelar</button>
							</a>
						<?php } ?>
						<?php if ($idcuestionario==2) {?>
							<a href="<?php echo site_url('Instdemocratica/editarNoticia/'.$idnoticia); ?>" >
								<button type="button" class="btn btn-danger" >Cancelar</button>
							</a>
						<?php } ?>
						<?php if ($idcuestionario==3) {?>
							<a href="<?php echo site_url('Censo/editarNoticia/'.$idnoticia); ?>" >
								<button type="button" class="btn btn-danger" >Cancelar</button>
							</a>
						<?php } ?>
						
					</div>
					<br>
				</div>
				<br>
			</div>
		</div>
	</div>
</main>







