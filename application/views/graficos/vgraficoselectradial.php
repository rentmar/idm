<br>
	<div class="container">
		<div class="card-header">
			<h3>Representacion Grafica "Tipo Radial" de Noticias</h3>
			<p>Fecha inicial</p>
			<input type="date" id="fecha_inicio" name="fecha_inicio">
			<p>Fecha final</p>
			<input type="date" id="fecha_fin" name="fecha_fin">
			<br><br>
			<button id="actores"  type="button" class="btn btn-secondary">Actores</button>
			<button id="mcomunicacion"  type="button" class="btn btn-secondary">Medios de Comunicacion</button>
			<br><br>
			<div>
				<div id="mediosDc" style="visibility:hidden">
					<button id="cdtv"  type="button" class="btn btn-secondary" value="8">Canal de Television</button>
					<button id="eradial"  type="button" class="btn btn-secondary">Emisora Radial</button>
					<button id="pescrita"  type="button" class="btn btn-secondary">Prensa Escrita</button>
				</div>
<!--				<div id="actoreS" style="visibility:hidden">
					<button id="cdtv"  type="button" class="btn btn-secondary" value="8">actor1</button>
					<button id="eradial"  type="button" class="btn btn-secondary">actor2</button>
					<button id="pescrita"  type="button" class="btn btn-secondary">actor3</button>
				</div>-->
			</div>
		</div>
        <div class="card-body">
			<div id="my_dataviz"></div>
		</div>
	</div>
    
    <script>var baseurl = "<?php echo site_url(); ?>";</script>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/js/radialesmdc.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/radialesa.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/radial.js') ?>"></script>
    <script type="text/javascript"></script>
