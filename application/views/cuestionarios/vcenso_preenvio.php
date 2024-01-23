<main role="main">
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-header cuest3" >
						<h6 class="text-white" >Censo</h6>
					</div>
					<div class="card-body" >
						<div class="list-group">
							<a href="#" class="list-group-item disabled">
								Fecha Registro:
								<?php echo ' '.mdate('%m-%d-%Y', $noticia->fecha_registro); ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Fecha:
								<?php echo ' '.mdate('%m-%d-%Y', $noticia->fecha_noticia); ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Titular:
								<?php echo ' '.$noticia->titular; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Resumen:
								<?php echo ' '.$noticia->resumen; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								URL:
								<?php echo ' '.$noticia->url_noticia; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Medio:
								<?php echo $noticia->medio['nombre']; ?>
								<?php echo ' - '.$noticia->tipo_medio['nombre']; ?>
							</a>
							<a href="#" class="list-group-item disabled">
								Actor:
								<ul>
									<?php foreach ($actores_sel as $ac): ?>
										<li type="circle" ><?php echo $ac['nombre_actor'] ?></li>
									<?php endforeach; ?>
								</ul>
							</a>
							<a href="#" class="list-group-item disabled">
								Tema:
								<ul>
									<?php foreach ($temas_sel as $temas): ?>
										<li type="circle" ><?php echo $temas['nombre_tema'] ?></li>
									<?php endforeach; ?>
								</ul>
								<?php if(isset($noticia->otro_tema) && !empty($noticia->otro_tema) ): ?>
									<h7>Otro Tema</h7>
									<p>
									<ul>
										<li type="circle" > <?php echo $noticia->otro_tema; ?> </li>
									</ul>
									</p>
								<?php endif; ?>

							</a>
							<a href="#" class="list-group-item disabled">

							</a>

						</div>

					</div>
					<div class="card-footer" >
						<button id="BOTON" type="button"  data-toggle="modal" data-target="#myModal">
							Enviar
						</button>
						<a  href="<?php echo site_url('censo/cancelarNuevo') ?>"  role="button">
							<button id="BOTON">
								Cancelar
							</button>
						</a>
					</div>

				</div>
			</div>

		</div>

	</div>



</main>


<!-- The Modal -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Enviar</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form action="<?php echo base_url().'index.php/Noticia/registrarNoticia'; ?>" method="post">
					<p>
						Registrar la noticia?
					</p>
					<input type="hidden" id="idcuestionario" name="idcuestionario" value="<?php //echo $idcuestionario; ?>" >
					<input type="hidden" id="fecha_registro" name="fecha_registro" value="<?php //echo $fecha_registro; ?>" >
					<input type="hidden" id="fecha_noticia" name="fecha_noticia" value="<?php //echo $fecha_noticia;?>" >
					<input type="hidden" id="titular" name="titular" value="<?php //echo //$titular; ?>" >
					<input type="hidden" id="resumen" name="resumen" value="<?php //echo //$resumen;?>" >
					<input type="hidden" id="url_noticia" name="url_noticia" value="<?php //echo //$url_noticia;?>" >
					<input type="hidden" id="idactor" name="idactor" value="<?php //echo $idactor;?>" >
					<input type="hidden" id="idmedio" name="idmedio" value="<?php //echo $idmedio;?>" >
					<input type="hidden" id="idtema" name="idtema" value="<?php //echo $idtema;?>" >
					<input type="hidden" id="idsubtema" name="idsubtema" value="<?php //echo $idsubtema;?>" >
					<input type="hidden" id="otrotema" name="otrotema" value="<?php //echo $tema;?>" >
					<input type="hidden" id="otrosubtema" name="otrosubtema" value="<?php //echo $subtema;?>" >
					<input type="hidden" id="idusr" name="idusr" value="<?php //echo $idusr;?>" >
					<!--				<input type="submit" id="BOTON" value="ENVIAR">-->

			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<!-- Al metodo de insercion -->
				<button type="submit" id="BOTON">Si</button>
				<button type="button" class="BOTONROJO" data-dismiss="modal">No</button>
			</div>
			<?php echo form_close(); ?>

		</div>
	</div>
</div>
