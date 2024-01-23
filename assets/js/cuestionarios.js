
/*Funcion para la carga de medios de comunicacion segun al tipo de medio seleccionado*/
jQuery(document).on('change', 'select#tipo-medio', function (e) {
	e.preventDefault();
	var tipomedioID = jQuery(this).val();
	getMediosList(tipomedioID);
});

/*Funcion para la carga de medios de comunicacion segun al tipo de medio seleccionado*/
jQuery(document).on('change', 'select#idtipomedio', function (e) {
	e.preventDefault();
	var tipomedioID = jQuery(this).val();
	//alert(tipomedioID);
	getMediosReport(tipomedioID);
});

/*Funcion para la carga de medios de comunicacion segun al tipo de medio seleccionado*/
jQuery(document).on('change', 'select#idtema', function (e) {
	e.preventDefault();
	var temaID = jQuery(this).val();
	//alert(temaID);
	getSubtemaReport(temaID);
});

jQuery(document).on('change', 'select#idciudad', function (e) {
	e.preventDefault();
	var ciudadID = jQuery(this).val();
	//alert(temaID);
	getZonaReport(ciudadID);
});

//Funcion para desplegar
jQuery(document).on('click', '#checktema', function (e) {
	//alert('Presionado');
	var texto_otro = '';
	if(this.checked)
	{
		console.log('CHECKED');
		console.log(this.value);
		if(this.value == 0){

			texto_otro += '<label for="otrotema" >Especifique  otra :</label><br>';
			texto_otro += '<input type="text" id="otrotema" name="tema0" placeholder="Otro tema" class="form-control" required >';
			$('#otrotemac').html(texto_otro);
			$('#otrotemac').addClass('contenedores');
		}
	}else{
		console.log('NO CHECKED');
		console.log(this.value);
		if(this.value == 0){
			$("#otrotemac").removeClass("contenedores");
			$('#otrotemac').empty();

		}
	}

});



jQuery(document).on('click', '#tipomedio', function (e) {
	e.preventDefault();
	$('#modalmediocomm').modal("show");
});
jQuery(document).on('click', '#mediocomunicacion', function (e) {
	e.preventDefault();
	$('#modalmediocomm').modal("show");
});

jQuery(document).on('click', '#cardtemas', function (e) {
	e.preventDefault();
	$('#modalmediocomm').modal("show");
});



jQuery(document).on('change', '#seleccionartema----cc', function (e) {
	e.preventDefault();
	var tms = $('#tema').select2('data');
	console.log(tms);



	e.preventDefault();
	var fecha = $('#fecha').val();
	var titular = $('#titular').val();
	var resumen = $('#resumen').val();
	var url = $('#url').val();
	var formulario = $('#idformulario').val();
	var usuario = $('#idusuario').val();

	var noticia = new Noticia();
	noticia.fecha_noticia = fecha;
	noticia.titular = titular;
	noticia.resumen = resumen;
	noticia.url_noticia = url;
	noticia.idformulario = formulario;
	noticia.rel_idusuario = usuario;

	//Recolectar el Tipo de medio
	var id = $('select#tipo-medio').val();
	var tipo = $('select#tipo-medio option:selected').text();
	var tipomedio = new Tipomedio(id, tipo);

	noticia.tipo_medio = tipomedio;

	//Recolectar el medio de comunicacion
	var idmedio = $('select#medio').val();
	var medioname = $('select#medio option:selected').text();
	var medio = new Medio(idmedio, medioname, id);

	noticia.medio_comunicacion = medio;

	//Recolectar a los actores de la noticia
	var actores = [];
	$('input[name="idactor[]"]:checked').each(function () {
		actores.push(this.value);
	});

	noticia.actores = [];
	noticia.actores = actores;

	//Capturar los temas de la noticia
	var temas = [];
	$('input[name="idtema[]"]:checked').each(function () {
		temas.push(this.value);
	});

	/*$('#tema option:selected').each(function () {
		temas.push(this.value);
	});*/
	noticia.temas = [];
	noticia.temas = temas;



	console.log(noticia);
	//$('#modaltemas').modal("show");
});

//Definir el objeto Noticia
function Noticia() {
	this.fecha_registro = '';
	this.titular = '';
	this.parrafo = '';
	this.url = '';
	this.rel_idusuario = '';
	this.idformulario = '';
	this.actores = [];
	this.temas = [];
}


//Definimos el obj tipo de medio
function Tipomedio(identificador, nombre) {
	this.idtipomedio = identificador;
	this.nombre_tipo = nombre;
}


//DEfinimos el obj medio
function Medio(identificador, nombre, idtipo) {
	this.idmedio = identificador;
	this.nombre_medio = nombre;
	this.rel_idtipomedio = idtipo;
}

//Definimos el objeto tema
function Tema(idtema, nombre, idcuestionario, idusuario) {
	this.idtema = idtema; //Identificador del tema
	this.nombre_tema = nombre; //Nombre del tema
	this.rel_idcuestionario = idcuestionario; //Identificador del cuestionario al q el tema pertenece
	this.rel_usuario = idusuario; //Identificador del usuario  q creo el tema
}

//Definimos el objeto subtema
function Subtemas(idsubtema, nombre, idtema) {
	this.idsubtema = idsubtema; //identificador del subtema
	this.nombre_subtema = nombre; //Nombre del subtema
	this.rel_idtema = idtema; //Identificador del tema al que pertenece el subtema
}

//Obj Otro tema
function Otrotema(nombre, idcuestionario, idusuario) {
	this.nombre_otrotema = nombre; //Nombre del otro tema
	this.rel_idcuestionario = idcuestionario; //Cuestionario al que pertenece
	this.rel_idusuario = idusuario //Usuario que crea el otro tema
}

//Obf Otro subtema
function Otrosubtema(nombre, idtema) {
	this.nombre_otrosubtema = nombre; //Nombre del otro subtema definido
	this.rel_idtema = idtema; //Identificador del tema al que pertence
}

function setNoticia(noticia) {
	$.ajax({
		url: baseurl + "/reformaelectoral/setvariables",
		type: 'post',
		data: {noticia: JSON.stringify(noticia) },
		dataType: 'html',
		beforeSend: function () {
		},
		complete: function () {

		},
		success: function (html) {
			console.log('RECIBIDO');
			//console.log(html);
			location.reload();
			location.reload();
			//$('#tipo-medio option[value=" "]').attr('selected', true);
			//$('#tipo-medio option:first').attr('selected','selected');
			//$('#tipo-medio option:first').prop('selected', true);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

/*
Funcion para extraer la lista de medios segun su tipo
 */
function getMediosList(tipomedioID) {
	//alert(tipomedioID + ' ' + baseurl);
	$.ajax({
		url: baseurl + "/reformaelectoral/getmedios",
		type: 'post',
		data: {tipomedioID: tipomedioID},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			var options = '';
			options +='<option value="" selected >Seleccionar Medio</option>';
			for (var i = 0; i < json.length; i++) {
				options += '<option value="' + json[i].medio_id + '">' + json[i].medio_name + '</option>';
			}
			jQuery("select#medio").html(options);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function getMediosReport(tipomedioID) {
	//alert(tipomedioID + ' ' + baseurl);
	$.ajax({
		url: baseurl + "/manejoDB/getmedios",
		type: 'post',
		data: {tipomedioID: tipomedioID},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#idmedio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			var options = '';
			options +='<option value="0" selected >Seleccione una opcion</option>';
			for (var i = 0; i < json.length; i++) {
				options += '<option value="' + json[i].medio_id + '">' + json[i].medio_name + '</option>';
			}
			jQuery("select#idmedio").html(options);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function getSubtemaReport(temaID) {
	$.ajax({
		url: baseurl + "/manejoDB/getsubtema",
		type: 'post',
		data: {temaID: temaID},
		beforeSend: function () {
			jQuery('select#idsubtema').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			var options = '';
			options +='<option value="" selected >Seleccione una opcion</option>';
			for (var i = 0; i < json.length; i++) {
				options += '<option value="' + json[i].stema_id + '">' + json[i].stema_name + '</option>';
			}
			jQuery("select#idsubtema").html(options);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

}

function getZonaReport(temaID) {
	$.ajax({
		url: baseurl + "/formulario/getZona",
		type: 'post',
		data: {ciudadID: temaID},
		beforeSend: function () {
			jQuery('select#idzona').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			var options = '';
			options +='<option value="" selected >Seleccione una opcion</option>';
			for (var i = 0; i < json.length; i++) {
				options += '<option value="' + json[i].idzona + '">' + json[i].nombre_zona + '</option>';
			}
			jQuery("select#idzona").html(options);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

}

function getSubtema(temaID) {
	var identificadores = [];
	var texto_otro = '';
	var color = '';
	var tema = ' ';
	var subtema = '';

	identificadores = temaID;
	//Limpiar Otro tema
	$("#otrotemac").removeClass("contenedores");
	$('#otrotemac').empty();
	$("#subtemac").empty();

	$.ajax({
		url: baseurl + "/reformaelectoral/getprueba",
		type: 'post',
		data: {temaID: JSON.stringify(temaID) },
		dataType: 'json',
		beforeSend: function () {
			console.log("Antes de la peticion");
		} ,
		success: function (json) {
			var identificadores = JSON.stringify(temaID);
			var contador = 0;

			for(var i = 0; i < temaID.length; i++)
			{
				//console.log(identificadores[i]);
				if(temaID[i] == 0){
					console.log("identificador 0");
					texto_otro += '<label for="otrotema" >Especifique  otra :</label><br>';
					texto_otro += '<input type="text" id="otrotema" name="otrotema" placeholder="Otro tema" class="form-control" >';
					$('#otrotemac').html(texto_otro);
					$('#otrotemac').addClass('contenedores');
				}else if(temaID != 0){
					//console.log("ide distinto de 0; " + temaID[i]);
					contador = 0
					//Color


					for(var j=0; j < json.length; j++ )
					{
						//definir el color
						if (json[i].rel_idcuestionario == 1)
						{
							color = '8cc63f';
						}else if (json[i].rel_idcuestionario == 2){
							color = 'EF9600';
						}

						if(temaID[i] == json[j].rel_idtema )
						{
							if(contador == 0)
							{
								tema += '<div class="contenedores">';
								tema += '<div class="card" >';
								tema += '<div  class="card-header  " style="background-color:#'+ color +';" >';
								tema += '<h4>' + json[j].nombre_tema + '<h4>';
								tema += '</div>';
								tema += '<div class="card-body">';
								tema += '<div class="form-check">';
								tema += '  <label class="form-check-label" for="radio1">';
								tema += '      <input type="radio" class="form-check-input" id="tema'+ temaID[i] +  '" name="tema' + temaID[i] +'idsubtema"' + json[j].idsubtema + ' value="' + json[j].idsubtema + '" checked >';
								//tema += '      <input type="radio" class="form-check-input" id="radio' + json[j].idsubtema + '" name="idsubtema" value="' + json[j].idsubtema + '" checked>';
								tema += '      ' + json[j].nombre_subtema;
								tema += '  </label>';
								tema += '</div>';
								console.log(json[j].nombre_subtema + " encabezado ");
								contador++;

							}else {
								tema += '<div class="form-check">';
								tema += '  <label class="form-check-label" for="radio1">';
								tema += '      <input type="radio" class="form-check-input" id="tema'+ temaID[i] + '" name="tema' + temaID[i] +'idsubtema"  value="' + json[j].idsubtema + '">';
								tema += '      ' + json[j].nombre_subtema;
								tema += '  </label>';
								tema += '</div>';
								console.log(json[j].nombre_subtema);
							}
						}

					}


					tema += '<div class="form-check">';
					tema += '  <label class="form-check-label" for="radio">';
					tema += '      <input type="radio" class="form-check-input" id="otrosubtema'+ temaID[i] +'" name="tema' + temaID[i] +'idsubtema"  value="0">';
					tema += '       Otro';
					tema += '  </label>';
					tema += '</div>';

					tema += '<div id="otro'+ temaID[i] +'" class="form-check">';
					tema += '</div>';

					tema += '</div>';
					tema += '</div>';
					tema += '</div>';
					tema += '<br>';

				}
			}
			$('#subtemac').html(tema);
		}
	});
}


function getSubtemaList(temaID, temaTitulo, color) {
	$.ajax({
		url: baseurl + "/reformaelectoral/getsubtema",
		type: 'post',
		data: {temaID: temaID},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#subtema').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {

			var contador = 0;
			var tarjeta = '';
			tarjeta += '<div  class="card-header  " style="background-color:#'+ color +';" >';
			tarjeta += '<h4>' + temaTitulo + '<h4>';
			tarjeta += '</div>';
			tarjeta += '<div class="card-body">';
			tarjeta += '<div class="form-check">';
			for (var i = 0; i < json.length; i++) {
				if (contador == 0) {
					tarjeta += '<div class="form-check">';
					tarjeta += '  <label class="form-check-label" for="radio1">';
					tarjeta += '      <input type="radio" class="form-check-input" id="radio' + json[i].stema_id + '" name="idsubtema" value="' + json[i].stema_id + '" checked>';
					tarjeta += '      ' + json[i].stema_name;
					tarjeta += '  </label>';
					tarjeta += '</div>';
					contador++

				} else {
					tarjeta += '<div class="form-check">';
					tarjeta += '  <label class="form-check-label" for="radio1">';
					tarjeta += '      <input type="radio" class="form-check-input" id="radio' + json[i].stema_id + '" name="idsubtema" value="' + json[i].stema_id + '">';
					tarjeta += '      ' + json[i].stema_name;
					tarjeta += '  </label>';
					tarjeta += '</div>';
				}
			}

			tarjeta += '<div class="form-check">';
			tarjeta += '  <label class="form-check-label" for="radiootro">';
			tarjeta += '      <input type="radio" class="form-check-input" id="radiootro" name="idsubtema" value="0">';
			tarjeta += '       Otro';
			tarjeta += '  </label>';
			tarjeta += '</div>';

			tarjeta += '<div id="" class="form-check">';
			tarjeta += '</div>';

			tarjeta += '</div>';
			tarjeta += '</div>';

			jQuery("#subtemac").html(tarjeta);


		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}




$(document).ready(function() {
	$('.selector-multiple').select2({
		placeholder: "Seleccione un tema",
	});
	$('.selmultiple').select2({
		placeholder: {
			id: 0,
			text: 'Seleccione una opcion'
		}
	});
	$('.simple').select2();
	$('#noticias-tabla').DataTable({
		responsive: true,
		language: {
			"zeroRecords": "No se encontró ninguna noticia",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});
	$('#leyes-tabla').DataTable({
		responsive: true,
		language: {
			"zeroRecords": "No se encontró ninguna noticia",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});
	$('#encuestas-tabla').DataTable({
		lengthMenu: [[100, 500, -1], [100, 500, "Todo"]],
		language: {
			"zeroRecords": "No se encontró ninguna encuesta",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});
	$('#usuarios-tabla').DataTable({
		lengthMenu: [[100, 500, -1], [100, 500, "Todo"]],
		language: {
			"zeroRecords": "No se encontró ninguna encuesta",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});

	$('#plenarias-tabla').DataTable({
		lengthMenu: [[100, 500, -1], [100, 500, "Todo"]],
		language: {
			"zeroRecords": "No se encontró ninguna plenaria",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});
	$('#normas-tabla').DataTable({
		lengthMenu: [[100, 500, -1], [100, 500, "Todo"]],
		language: {
			"zeroRecords": "No se encontró ninguna norma",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});
	$('#padron-tabla').DataTable({
		lengthMenu: [[100, 500, -1], [100, 500, "Todo"]],
		language: {
			"zeroRecords": "No se encontró ningun CI registrado",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});
	$('#libros-tabla').DataTable({
		lengthMenu: [[100, 500, -1], [100, 500, "Todo"]],
		language: {
			"zeroRecords": "No se encontró ningun Libro registrado",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});

	$('#formresp-tabla').DataTable({
		lengthMenu: [[100, 500, -1], [100, 500, "Todo"]],
		language: {
			"zeroRecords": "No se encontró ninguna formulario",
			"lengthMenu":     "Mostrar _MENU_ registros",
			'search': 'Buscar:',
			"info": "Mostrando la página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			'paginate':{
				'next': 'Siguiente',
				'previous': 'Anterior'
			}
		}
	});

	$('[data-toggle="tooltip"]').tooltip();

	new ClipboardJS('.btn');

});

//Validador del formulario noticia
$('#formulario').submit(function (e) {
	var numero_actores_seleccionados;
	var numero_temas_seleccionados;
	numero_actores_seleccionados = $('input[name="idactor[]"]:checked').length;
	numero_temas_seleccionados = $('input[name="idtema[]"]:checked').length;
	if(numero_actores_seleccionados==0)
	{
		e.preventDefault();
		$('#actorsinseleccionar').modal("show");
	}
	if(numero_temas_seleccionados==0){
		e.preventDefault();
		$('#temasinseleccionar').modal("show");
	}

});

$('#formulario_ley').submit(function (e) {
	var numero_temas_seleccionados;
	numero_temas_seleccionados = $('input[name="idtema[]"]:checked').length;
	if(numero_temas_seleccionados==0){
		e.preventDefault();
		$('#temasinseleccionar').modal("show");
	}
});

$('#nuevos_temas').submit(function (e) {
	var numero_temas_seleccionados;
	numero_temas_seleccionados = $('input[name="idtema[]"]:checked').length;
	if(numero_temas_seleccionados==0){
		e.preventDefault();
		$('#temasinseleccionar').modal("show");
	}
});


//Validador de los subtemas

/*$('#formulariosub_ley').submit(function (e) {
	var numero_subtemas_seleccionados;
	numero_subtemas_seleccionados = $('input[name="idtema[]"]:checked').length;
	e.preventDefault();
	$('#subtemasleyessinseleccion').modal("show");
});*/

/**
 * Cuestionario de plenarias
 **/
$("input[name='tratamiento']").click(function () {
	var seleccion = $("input[name='tratamiento']:checked").val();
	var inputExtra = '';
	if(seleccion == 1)
	{
		//$("#norma").show();
		$('#norma').addClass('contenedores');
		inputExtra += '<label for="titular">Número y nombre de la norma que ingresó sin estar en la agenda:</label><br>';
		inputExtra += '<input type="text" id="norma_extraordinaria" name="norma_extraordinaria" required class="form-control" value="">';
		inputExtra += '';
		inputExtra += '';
		$('#norma').html(inputExtra);
	}else{
		//$("#norma").hide();
		$('#norma').removeClass('contenedores');
		inputExtra = '';
		$('#norma').html(inputExtra);
	}
});

$('#formulario_plenaria').submit(function (e) {
	//Validar el selector de tipo de plenaria
	validador_tipo_plenaria_seleccionada = $('input[name="tipo_plenaria"]:checked').length;
	if(validador_tipo_plenaria_seleccionada == 0)
	{
		e.preventDefault();
		$('#tipoplenariasinseleccionar').modal("show");
	}
	else{
		e.preventDefault();
		var plenaria = new Plenaria();
		var instancia = new InstanciaSeguimiento();
		var norma_extra = new NormaExtraordinario();
		var fechas = new Fecha($('#fecha_plenaria').val());
		var departamento = new Departamento();
		var municipio = new Municipio();

		//captura de la instancia de seguimiento
		instancia.identificador = $('#instanciaseguimientoplenaria').val();
		instancia.literal = $("#instanciaseguimientoplenaria option:selected").text();
		plenaria.instancia = instancia;

		//Captura del departamento
		departamento.iddepartamento = $('#depnorma').val();
		departamento.departamento = $("#depnorma option:selected").text();
		plenaria.departamento = departamento;

		//Captura del municipio
		municipio.idmunicipio = $('#munnorma').val();
		municipio.municipio = $("#munnorma option:selected").text();
		plenaria.municipio = municipio;

		plenaria.fecha_plenaria = fechas;
		plenaria.puntos_agenda = $('#puntos_agenda').val();
		plenaria.cumplimiento_agenda = $('#agenda_cumplida').val();
		plenaria.puntos_pendientes = $('#puntos_pendientes').val();
		plenaria.puntos_varios = $('#puntos_varios').val();
		norma_extra.existe = $('input[name = "tratamiento"]:checked').val();;
		norma_extra.normaLiteral = $("#norma_extraordinaria").val();
		plenaria.norma_extraordinaria = norma_extra;
		var idtipoplenaria = $('input[name="tipo_plenaria"]:checked').val();
		plenaria.tipo_plenaria = tipoPlenaria(idtipoplenaria);
		plenaria.idcuestionario = $('#idcuestionario').val();
		plenaria.idusuario = $('#idusuario').val();
		plenaria.monitores = $('#monitores').val();

		console.log('PLENARIA: ');
		console.log(plenaria);
		console.log(plenaria.fecha_plenaria['fecha']);

		//Desplegar la informacion en el modal de preenvio
		//Idenitificadores del cuestionario y el usuario
		$('#idcuestionario_pre').val(plenaria.idcuestionario);
		$('#idusuario_pre').val(plenaria.idusuario);

		//Instancia de seguimiento secundaria
		//Departamental o municipal
		var instanciaSec = '';
		if(plenaria.instancia['identificador'] == 1){
			//Eliminar la instancia secundaria
			instanciaSec += '';
			$('#instancia_secundaria_plenaria').removeClass('form-group');
			$('#instancia_secundaria_plenaria').html(instanciaSec);

		}else if(plenaria.instancia['identificador'] == 2){
			//Instancia secundaria departamental
			instanciaSec += '<label for="puntos_agenda_pre">Departamento:</label>';
			instanciaSec += '<input type="text" class="form-control" id="depple_pre" name="depple_pre" required value="'+ plenaria.departamento['departamento'] +'">';
			instanciaSec += '<input type="hidden" class="form-control" id="iddepple_pre" name="iddepple_pre" value="'+ plenaria.departamento['iddepartamento']+'" >';
			instanciaSec += '';
			$('#instancia_secundaria_plenaria').addClass('form-group');
			$('#instancia_secundaria_plenaria').html(instanciaSec);


		}else if(plenaria.instancia['identificador'] == 3){
			//Instancia secundaria municipal
			instanciaSec += '<label for="puntos_agenda_pre">Municipio:</label>';
			instanciaSec += '<input type="text" class="form-control" id="munnorma_pre" name="munnorma_pre" required value="'+ plenaria.municipio['municipio'] +'" >';
			instanciaSec += '<input type="hidden" class="form-control" id="idmunnorma_pre" name="idmunnorma_pre" value="'+ plenaria.municipio['idmunicipio'] +'" >';
			instanciaSec += '';
			$('#instancia_secundaria_plenaria').addClass('form-group');
			$('#instancia_secundaria_plenaria').html(instanciaSec);
		}


		//Fecha de la plenaria
		$('#fecha_plenaria_pre').val(plenaria.fecha_plenaria['fecha']);
		$('#fecha_plenaria_unix_pre').val(plenaria.fecha_plenaria['fecha_unix']);
		//Instancia de seguimiento
		$('#instancia_seguimiento_pre').val(plenaria.instancia['literal']);
		$('#idinstancia_seg_pre').val(plenaria.instancia['identificador']);
		//Puntos de la agenda
		$('#puntos_agenda_pre').val(plenaria.puntos_agenda);
		//Cumplimiento de la agenda
		$('#cumlimiento_agenda_pre').val(plenaria.cumplimiento_agenda);
		//Descripcion del asunto sin tratamiento
		$('#asunto_sintratar_pre').val(plenaria.puntos_pendientes);
		//Puntos varios
		$('#puntos_varios_pre').val(plenaria.puntos_varios);
		//NUmero y nombre de la norma extraordinaria (campo dinamico)
		var normaExtra = '';
		if(plenaria.norma_extraordinaria['existe'] == 1)
		{
			//Colocar el valor de la norma en el area de texto del preenvio
			normaExtra += '<label for="norma_ingresada_pre">Numero y nombre de la norma que se ingreso sin estar en la agenda:</label>';
			normaExtra += '<textarea class="form-control" rows="3" id="norma_ingresada_pre" name="norma_ingresada_pre" required>'+ plenaria.norma_extraordinaria['normaLiteral'] +'</textarea>';
			normaExtra += '<input type="hidden" class="form-control" id="existe_norma_ingresada_pre" name="existe_norma_ingresada_pre" value="'+ plenaria.norma_extraordinaria['existe'] +'" required >';
			normaExtra += '';
			$('#norma_extra_pre').html(normaExtra);
			/*$('#norma_extra_pre').show();
			$('#norma_ingresada_pre').val(plenaria.norma_extraordinaria['normaLiteral']);
			$('#existe_norma_ingresada_pre').val(plenaria.norma_extraordinaria['existe']);*/

		}else{
			//Eliminar el area de texto del preenvio
			//$('#norma_extra_pre').hide();
			normaExtra += '';
			$('#norma_extra_pre').html(normaExtra);
		}
		//Tipo de plenaria
		$('#id_tipo_plenaria_pre').val(plenaria.tipo_plenaria['idtpl']);
		$('#tipo_plenaria_pre').val(plenaria.tipo_plenaria['tipo_plenaria_nombre']);

		$('#monitores_pre').val(plenaria.monitores);

		//Mostrar el preenvio
		$('#preenvioplenaria').modal("show");

	}
});

function Fecha(literalFecha){
	var fecha_capturada = literalFecha;
	this.fecha = fecha_capturada;
	fecha = new Date(literalFecha);
	this.fecha_unix = Math.floor(fecha.getTime()/1000);
}



//Instancia de seguimiento
function InstanciaSeguimiento(){
	this.identificador = '';
	this.literal = '';
}
//Norma extraordinaria
function NormaExtraordinario() {
	this.existe = '';
	this.normaLiteral = '';
}
//Plenaria
function Plenaria(){
	this.instancia = ' ';
	this.departamento = ' ';
	this.municipio = ' ';
	this.fecha_plenaria = ' '; //fecha de registro
	this.puntos_agenda = ' '; //Puntos a tratar
	this.cumplimiento_agenda = ' '; //Porcentaje de cumplimiento de la agenda
	this.puntos_pendientes = ' '; //Puntos pendientes de la plenaria
	this.puntos_varios = ' '; //Puntos varios de la agenda
	this.norma_extraordinaria = '';
	this.tipo_plenaria = '';
	this.idcuestionario = '';
	this.idusuario = '';
	this.monitores = '';

}
function tipoPlenaria(identificador){
	var ret_val = {};
	$.ajax({
		url: baseurl + "/plenaria/getTipoPlenaria/",
		type: 'post',
		data: {'identificador': identificador},
		async: false,
		dataType: 'json'
	}).done(function (response) {
		ret_val = response;
	}).fail(function (jqXHR, textStatus, errorThrown) {
		ret_val = null;
	});
	return ret_val;
}

//Variacion de la instacia de seguimiento secundaria, segun seleccion de la instancia de segumiento primaria
jQuery(document).on('change', 'select#instanciaseguimientoplenaria', function (e) {
	e.preventDefault();
	var instancia = jQuery(this).val();
	console.log(instancia);
	if(instancia == 1){
		$('#instancia_seguimiento_secundaria').removeClass('contenedores');
		$('#instancia_seguimiento_secundaria').html(' ');
	}else if(instancia==2){
		$('#instancia_seguimiento_secundaria').addClass('contenedores');
		getDepartamentosPlenaria();

	}else if(instancia==3){
		$('#instancia_seguimiento_secundaria').addClass('contenedores');
		getMunicipiosPlenaria();
	}
});
function getDepartamentosPlenaria(){
	$.ajax({
		url: baseurl + "/normativa/getDepartamentos/",
		type: 'post',
		data: {instancia: ''},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito departamentos");
			console.log(json);
			var opciones = '';

			opciones += '<label for="instanciaseguimiento">Seleccione Departamento:</label><br>';
			opciones += '	<select id="depnorma" name="depnorma" class="form-control" required>';
			opciones += '		<option value="" >Seleccione una departamento</option>';
			for (var i = 0; i<json.length; i++) {
				opciones += '	<option value="'+ json[i].iddepartamento +'">'+ json[i].nombre_departamento +'</option>';
			}
			opciones += '	</select>';

			jQuery("div#instancia_seguimiento_secundaria").html(opciones);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function getMunicipiosPlenaria(){
	$.ajax({
		url: baseurl + "/normativa/getMunicipios/",
		type: 'post',
		data: {instancia: ''},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito municipios");
			console.log(json);

			var opciones = '';

			opciones += '<label for="instanciaseguimiento">Seleccione el Municipio:</label><br>';
			opciones += '	<select id="munnorma" name="munnorma" class="form-control" required>';
			opciones += '		<option value="" >Seleccione un municipio</option>';
			for (var i = 0; i<json.length; i++) {
				opciones += '	<option value="'+ json[i].idmunicipio +'">'+ json[i].municipio_nombre +'</option>';
			}
			opciones += '	</select>';
			jQuery("div#instancia_seguimiento_secundaria").html(opciones);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}


/**
 * Fin Cuestionario de plenarias
 **/

/**
 * Cuestionario de normativas
 **/
$("input[name='norma_segundo']").click(function () {
	var seleccion = $("input[name='norma_segundo']:checked").val();
	if(seleccion == 1)
	{
		$("#segundodatos").show();
	}else{
		$("#segundodatos").hide();
	}
});

//Funcionalidad de seleccion de otros temas (1 y 2)
$("input[name='idtema']").click(function () {
	var selTema1 = $("input[name='idtema']:checked").val();
	var opcion = '';

	if(selTema1 == 0){
		opcion += '<label for="otrotema1norma">Otro tema:</label><br>';
		opcion += '<input type="text" id="otrotema1norma" name="otrotema1norma" required class="form-control" value="">';
		$('#otrotema1normadatos').html(opcion);
	}else{
		opcion = '';
		$('#otrotema1normadatos').html(opcion);
	}
});
$("input[name='idtema2']").click(function () {
	var selTema2 = $("input[name='idtema2']:checked").val();
	var opcion = '';

	if(selTema2 == 0){
		opcion +='<label for="otrotema2norma">Otro tema:</label><br>';
		opcion +='<input type="text" id="otrotema2norma" name="otrotema2norma" required class="form-control"   value="">';
		$('#otrotema2normadatos').html(opcion);
	}else{
		opcion = '';
		$('#otrotema2normadatos').html(opcion);
	}
});

//Variacion de la instacia de seguimiento secundaria, segun seleccion de la instancia de segumiento primaria
jQuery(document).on('change', 'select#instanciaseguimientonorma', function (e) {
	e.preventDefault();
	var instancia = jQuery(this).val();
	console.log(instancia);
	if(instancia == 1){
		//alert('Nacional');
		$('#instancia_seguimiento_secundaria').removeClass('contenedores');
	}else if(instancia==2){
		//alert('Depa');
		$('#instancia_seguimiento_secundaria').addClass('contenedores');
		getDepartamentos();

	}else if(instancia==3){
		//alert('Muni');
		$('#instancia_seguimiento_secundaria').addClass('contenedores');
		getMunicipios();
	}
});
function getDepartamentos(){
	$.ajax({
		url: baseurl + "/normativa/getDepartamentos/",
		type: 'post',
		data: {instancia: ''},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito departamentos");
			console.log(json);
			var opciones = '';

				opciones += '<label for="instanciaseguimiento">Seleccione Departamento:</label><br>';
				opciones += '	<select id="depnorma" name="depnorma" class="form-control" required>';
				opciones += '		<option value="" >Seleccione una departamento</option>';
				for (var i = 0; i<json.length; i++) {
					opciones += '	<option value="'+ json[i].iddepartamento +'">'+ json[i].nombre_departamento +'</option>';
				}
				opciones += '	</select>';

			jQuery("div#instancia_seguimiento_secundaria").html(opciones);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function getMunicipios(){
	$.ajax({
		url: baseurl + "/normativa/getMunicipios/",
		type: 'post',
		data: {instancia: ''},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito municipios");
			console.log(json);

			var opciones = '';

			opciones += '<label for="instanciaseguimiento">Seleccione el Municipio:</label><br>';
			opciones += '	<select id="munnorma" name="munnorma" class="form-control" required>';
			opciones += '		<option value="" >Seleccione un municipio</option>';
			for (var i = 0; i<json.length; i++) {
				opciones += '	<option value="'+ json[i].idmunicipio +'">'+ json[i].municipio_nombre +'</option>';
			}
			opciones += '	</select>';
			jQuery("div#instancia_seguimiento_secundaria").html(opciones);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}



//Variacion del tipo de plenaria segun la instancia de seguimiento
jQuery(document).on('change', 'select#instanciaseguimientoplenaria', function (e) {
	e.preventDefault();
	var tipoplenariaID = jQuery(this).val();
	getTiposPlenaria(tipoplenariaID);
});


//Modificar la seleccion de los tipos de plenarias
function getTiposPlenaria(tipoID) {
	//alert(tipomedioID + ' ' + baseurl);
	$.ajax({
		url: baseurl + "/plenaria/getTiposPlenaria/",
		type: 'post',
		data: {instancia: tipoID},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito tipos de plenaria");
			console.log(json);
			var opciones = '';
			for (var i = 0; i<json.length; i++){
				opciones += '<div class="custom-control custom-radio">';
				opciones += '	<input type="radio" class="custom-control-input" id="tipo'+ json[i].idtpl +'" name="tipo_plenaria" value="'+ json[i].idtpl +'" >';
				opciones += '	<label class="custom-control-label" for="tipo'+ json[i].idtpl +'">' + json[i].tipo_plenaria_nombre  + '</label>';
				opciones += '</div>';
			}
			jQuery("div#tipos_de_plenaria").html(opciones);

			/*var options = '';
			options +='<option value="" selected >Seleccionar Medio</option>';
			for (var i = 0; i < json.length; i++) {
				options += '<option value="' + json[i].medio_id + '">' + json[i].medio_name + '</option>';
			}
			jQuery("select#medio").html(options);*/

		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

//Seleccion del estado de ley
jQuery(document).on('change', 'select#estado_norma', function (e) {
	e.preventDefault();
	var estado = jQuery(this).val();
	console.log(estado);
	var inputFecha='';
	if(estado == 1){
		//Ley en tratamiento
		inputFecha = '';
		$('#fechaprimerenvio').removeClass('contenedores');
		$('#fechaprimerenvio').html(inputFecha);
	}else if(estado == 2){
		//Ley Promulgada
		inputFecha += '<label for="fecha_primer_envio">Fecha del primer envio:</label><br>';
		inputFecha += '<input type="date" id="fecha_primer_envio" name="fecha_primer_envio"  class="form-control" required >'
		$('#fechaprimerenvio').addClass('contenedores');
		$('#fechaprimerenvio').html(inputFecha);
	}
});


//Seleccion del proponente 'otr0'
jQuery(document).on('change', 'select#proponente', function (e) {
	e.preventDefault();
	var proponente = jQuery(this).val();
	var inputotro = '';
	console.log(proponente);
	if(proponente == 2)
	{
		console.log("Es otro");
		inputotro += '<label for="proponente_otro">Describir Otro proponente:</label><br>';
		inputotro += '<input placeholder="Otro proponente" type="text" id="proponente_otro" name="proponente_otro"  class="form-control" required >'

		$('#otroproponentedatos').addClass('contenedores');
		$('#otroproponentedatos').html(inputotro);
	}else{
		console.log("No es otro");
		inputotro = '';
		$('#otroproponentedatos').removeClass('contenedores');
		$('#otroproponentedatos').html(inputotro);
	}

});


//Envio de la informacion
$('#formulario_norma').submit(function (e) {
	e.preventDefault();
	var norma = new Norma();
	var instancia = new InstanciaSeguimiento();
	var departamento = new Departamento();
	var municipio = new Municipio();
	var fechas = new Fecha($('#fecha_norma').val());
	var segundoRemitente = new Remitente();
	var tema1 = new Tema();
	var tema2 = new Tema();
	var proponente = new Proponente();
	var estado = new Estado();


	//Usuario y cuestionario
	norma.idcuestionario = $('#idcuestionario').val();
	norma.usuario = $('#idusuario').val();

	//Captura de la instancia
	instancia.identificador = $('#instanciaseguimientonorma').val();
	instancia.literal = $("#instanciaseguimientonorma option:selected").text();
	norma.instanciaSeguimiento = instancia;

	//Captura del departamento
	departamento.iddepartamento = $('#depnorma').val();
	departamento.departamento = $("#depnorma option:selected").text();
	norma.departamento = departamento;

	//Captura del muncipio
	municipio.idmunicipio = $('#munnorma').val();
	municipio.municipio = $("#munnorma option:selected").text();
	norma.municipio = municipio;

	//Captura del estado de la norma
	estado.idestado = $('#estado_norma').val();
	estado.estado = $('#estado_norma option:selected').text();
	norma.estado = estado;

	//Captura de la fecha de primer envio si se trata de una Ley promulgada
	if(norma.estado['idestado'] == 2){
		var fecha_primer_envio = new Fecha($('#fecha_primer_envio').val());
		norma.fecha_primer_envio = fecha_primer_envio;
	}

	//Fecha de la normativa
	norma.fecha = fechas;

	//Remitente
	//norma.remitente = $('#norma_remitente').val();
	norma.remitente = '';
	//Destinatario
	//norma.destinatario = $('#norma_destinatario').val();
	norma.destinatario = '';

	//Segundo remitente
	//segundoRemitente.existe = $('input:radio[name=norma_segundo]:checked').val();
	//segundoRemitente.nombre = $('#norma_segundo_datos').val() ;
	segundoRemitente.existe = 0;
	segundoRemitente.nombre = '';

	norma.segundoremitente = segundoRemitente;

	//Codigo y nombre de la norma
	norma.codigo = $('#norma_codigo').val();
	norma.nombre = $('#norma_nombre').val();

	//Objeto de la norma
	norma.objeto = $('#norma_objeto').val();

	//Temas de la norma
	tema1.idtema = $('input:radio[name=idtema]:checked').val();
	tema1.otrotema = $('#otrotema1norma').val();

	tema2.idtema = $('input:radio[name=idtema2]:checked').val();
	tema2.otrotema = $('#otrotema2norma').val();

	norma.tema1 = tema1;
	norma.tema2 = tema2;

	//Capturar el proponente
	/*proponente.idproponente = $('#proponente').val().toLocaleLowerCase();
	proponente.nombre = $("#proponente option:selected").text();
	proponente.otro = $('#proponente_otro').val();*/
	proponente.idproponente = 0;
	proponente.nombre = '';
	proponente.otro = '';
	norma.proponente = proponente;

	//Observaciones
	norma.observaciones = $('#norma_obs').val();


	//Rellenado del preenvio de la norma
	$('#idcuestionario_pre').val(norma.idcuestionario);
	$('#idusuario_pre').val(norma.usuario);
	$('#fecha_norma_pre').val(norma.fecha['fecha']);
	$('#fecha_norma_unix_pre').val(norma.fecha['fecha_unix']);
	$('#instancia_seguimiento_pre').val(norma.instanciaSeguimiento['literal']);
	$('#idinstancia_seg_pre').val(norma.instanciaSeguimiento['identificador']);
	$('#estado_norma_pre').val(norma.estado['estado']);
	$('#idestado_norma_pre').val(norma.estado['idestado']);


	//Capturar la fecha del primer envio si es una norma promulgada
	if(norma.estado['idestado'] == 2){
		var inputfechaprimer = '';
		inputfechaprimer += '<label for="fecha_primer_envio_pre">Fecha del primer envio:</label>';
		inputfechaprimer += '<input readonly type="text" class="form-control" id="fecha_primer_envio_pre" name="fecha_primer_envio_pre" value="'+ norma.fecha_primer_envio['fecha'] +'" required>';
		inputfechaprimer += '<input type="hidden" class="form-control" id="fecha_primer_envio_pre_unix" name="fecha_primer_envio_pre_unix" value="'+ norma.fecha_primer_envio['fecha_unix'] +'" >';
		inputfechaprimer += '';
		$('#fechaprimerenviopre').html(inputfechaprimer);
	}else if(norma.estado['idestado'] == 1){
		inputfechaprimer = '';
		$('#fechaprimerenviopre').html(inputfechaprimer);
	}

	//Si es departamental o Municipal
	var instanciaSec = '';
	if(norma.instanciaSeguimiento['identificador'] == 1){
		//Eliminar la instancia secundaria
		instanciaSec += '';
		$('#instancia_secundaria').removeClass('form-group');
		$('#instancia_secundaria').html(instanciaSec);

	}else if(norma.instanciaSeguimiento['identificador'] == 2){
		//Instancia secundaria departamental
		instanciaSec += '<label for="puntos_agenda_pre">Departamento:</label>';
		instanciaSec += '<input readonly type="text" class="form-control" id="depnorma_pre" name="depnorma_pre" required value="'+ norma.departamento['departamento'] +'">';
		instanciaSec += '<input type="hidden" class="form-control" id="iddepnorma_pre" name="iddepnorma_pre" value="'+ norma.departamento['iddepartamento']+'" >';
		instanciaSec += '';
		$('#instancia_secundaria').addClass('form-group');
		$('#instancia_secundaria').html(instanciaSec);


	} else if(norma.instanciaSeguimiento['identificador'] == 3){
		//Instancia secundaria municipal
		instanciaSec += '<label for="puntos_agenda_pre">Municipio:</label>';
		instanciaSec += '<input readonly type="text" class="form-control" id="munnorma_pre" name="munnorma_pre" required value="'+ norma.municipio['municipio'] +'" >';
		instanciaSec += '<input type="hidden" class="form-control" id="idmunnorma_pre" name="idmunnorma_pre" value="'+ norma.municipio['idmunicipio'] +'" >';
		instanciaSec += '';
		$('#instancia_secundaria').addClass('form-group');
		$('#instancia_secundaria').html(instanciaSec);
	}
	$('#remitente_pre').val(norma.remitente);
	$('#destinatario_pre').val(norma.destinatario);

	var segenvio = '';
	if(norma.segundoremitente['existe'] == 1)
	{
		//Existe sefundo remitente
		segenvio += '<label for="seg_remitente_pre">Quien y cuando realizo el segundo envio:</label>';
		segenvio += '<input type="text" class="form-control" id="seg_remitente_pre" name="seg_remitente_pre" required value="'+ norma.segundoremitente['nombre'] +'">';
		segenvio += '<input type="hidden" class="form-control" id="existe_seg_remitente_pre" name="existe_seg_remitente_pre" required value="'+ norma.segundoremitente['existe'] +'">';
		$('#segundoenvio').addClass('form-group');
		$('#segundoenvio').html(segenvio);
	}else{
		//Sin segundo remitente
		segenvio = '';
		$('#segundoenvio').removeClass('form-group');
		$('#segundoenvio').html(segenvio);
	}

	$('#cod_norma_pre').val(norma.codigo);
	$('#nom_norma_pre').val(norma.nombre);
	$('#obj_norma_pre').val(norma.objeto);

	//Desplegar los temmas capturados
	//Tema1
	var tema1_pre = '';
	if(norma.tema1['idtema'] == 0){
		console.log('Otro tema seleccionado: ' + norma.tema1['otrotema']);
		tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ norma.tema1['otrotema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ norma.tema1['idtema'] +'" >';
		tema1_pre += '';
		$('#tema1desp').html(tema1_pre);
	}else{
		var temadb = gettema(norma.tema1['idtema']);
		console.log(temadb);
		norma.tema1['tema'] = temadb['nombre_tema'];
		tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
		tema1_pre += '<input readonly type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ norma.tema1['tema'] +'">';;
		tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ norma.tema1['idtema'] +'" >';;
		tema1_pre += '';
		$('#tema1desp').html(tema1_pre);
	}
	//Tema2
	var tema2_pre = '';
	if(norma.tema2['idtema'] == 0){
		console.log('Otro tema seleccionado: '+ norma.tema2['otrotema']);
		tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ norma.tema2['otrotema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ norma.tema2['idtema'] +'" >';
		tema2_pre += '';
		$('#tema2desp').html(tema2_pre);

	}else{
		var tema2db = gettema(norma.tema2['idtema']);
		console.log(tema2db);
		norma.tema2['tema'] = tema2db['nombre_tema'];
		tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
		tema2_pre += '<input readonly type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ norma.tema2['tema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ norma.tema2['idtema'] +'" >';
		tema2_pre += '';
		$('#tema2desp').html(tema2_pre);
	}

	//Proponente
	var prop_dis = '';
	if(norma.proponente['idproponente'] == 2){
		/*prop_dis += '<label for="proponente_pre" >Proponente:</label>';
		prop_dis += '<input type="text" class="form-control" id="proponente_pre" name="proponente_pre" required value="'+ norma.proponente['nombre']  +'">';
		prop_dis += '<input type="text" class="form-control" id="proponentedes_pre" name="proponentedes_pre" required value="'+ norma.proponente['otro']  +'">';;
		prop_dis += '<input type="text" class="form-control" id="idproponente_pre" name="idproponente_pre" value="'+ norma.proponente['idproponente'] +'" >';
		*/
		prop_dis += '';
		$('#propdesp').html(prop_dis);
	}else{
		/*prop_dis += '<label for="proponente_pre" >Proponente:</label>';
		prop_dis += '<input type="text" class="form-control" id="proponente_pre" name="proponente_pre" required value="'+ norma.proponente['nombre']  +'">';
		prop_dis += '<input type="text" class="form-control" id="idproponente_pre" name="idproponente_pre" value="'+ norma.proponente['idproponente'] +'" >';
		*/
		prop_dis += '';
		$('#propdesp').html(prop_dis);
	}

	//Observaciones
	$('#observaciones_pre').val(norma.observaciones);

	console.log(norma);
	$('#preenvionorma').modal("show");
});


$('#formulario_norma_plurinacional').submit(function (e) {
	e.preventDefault();
	var normaPlurinacional = new Norma();
	var instancia = new InstanciaSeguimiento();
	var tema1 = new Tema();
	var tema2 = new Tema();
	var subtema1 = new Subtema();
	var subtema2 = new Subtema();
	var proponente = new Proponente();
	var fecha_norma = new Fecha($('#fecha_norma_plu').val());
	var fecha_repo = new Fecha($('#fecha_norma_solrep_plu').val());

	//Usuario y cuestionario
	normaPlurinacional.idcuestionario = $('#idcuestionario').val();
	normaPlurinacional.usuario = $('#idusuario').val();

	//Instancia de seguimiento
	instancia.identificador = $('#idinstancia_plu').val();
	instancia.literal = $('#instancia_plu').val();
	normaPlurinacional.instanciaSeguimiento = instancia;

	//Codigo y nombre de la norma
	normaPlurinacional.codigo = $('#codigo_plu').val();
	normaPlurinacional.nombre = $('#nombre_plu').val();
	normaPlurinacional.fecha = fecha_norma;

	//Objeto de la norma
	normaPlurinacional.objeto = $('#objeto_plu').val();

	//Temas de la norma
	//tema1.idtema = $('input:radio[name=idtema]:checked').val();
	tema1.idtema = $('#tema1').find("option:selected").val();
	tema1.tema = $('#tema1').find("option:selected").html();
	tema1.otrotema = $('#otrotema1norma').val();
	subtema1.idsubtema = $('#subtema1').find("option:selected").val();
	subtema1.subtema = $('#subtema1').find("option:selected").html();
	subtema1.idtema = tema1.idtema;

	//tema2.idtema = $('input:radio[name=idtema2]:checked').val();
	tema2.idtema = $('#tema2').find("option:selected").val();
	tema2.tema = $('#tema2').find("option:selected").html();
	tema2.otrotema = $('#otrotema2norma').val();
	subtema2.idsubtema = $('#subtema2').find("option:selected").val();
	subtema2.subtema = $('#subtema2').find("option:selected").html();
	subtema2.idtema = tema2.idtema;


	//Subtemas de la norma

	normaPlurinacional.tema1 = tema1;
	normaPlurinacional.tema2 = tema2;
	normaPlurinacional.subtema1 = subtema1;
	normaPlurinacional.subtema2 = subtema2;

	//Capturar el proponente
	proponente.idproponente = $('#proponente').val().toLocaleLowerCase();
	proponente.nombre = $("#proponente option:selected").text();
	proponente.otro = $('#proponente_otro').val();
	normaPlurinacional.proponente = proponente;

	//remitente
	normaPlurinacional.remitente = $('#remitente_plu').val();
	normaPlurinacional.destinatario = $('#destinatario_plu').val();

	//Datos reposicion
	normaPlurinacional.remitente_reposicion = $('#remitente_solrep_plu').val();
	normaPlurinacional.destinatario_reposicion = $('#destinatario_solrep_plu').val();
	normaPlurinacional.fecha_reposicion = fecha_repo;

	normaPlurinacional.observaciones = $('#observaciones_plu').val();
	normaPlurinacional.enlace = $('#enlace_plu').val();

	normaPlurinacional.obs_metodologicas = $('#observaciones_met_plu').val();

	//Rellenado del preenvio
	$('#codigo_plu_pre').val(normaPlurinacional.codigo);
	$('#nombre_plu_pre').val(normaPlurinacional.nombre);
	$('#objeto_plu_pre').val(normaPlurinacional.objeto);

	//Tema1
	var tema1_pre = '';
	if(normaPlurinacional.tema1['idtema'] == 0){
		//Otro tema
		console.log('Otro tema seleccionado: ' + normaPlurinacional.tema1['otrotema']);
		tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ normaPlurinacional.tema1['otrotema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ normaPlurinacional.tema1['idtema'] +'" >';
		tema1_pre += '<label for="subtema1_pre" >Subtema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="subtema1_pre" name="subtema1_pre" required value="'+ normaPlurinacional.subtema1['subtema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idsubtema1_pre" name="idsubtema1_pre" value="'+ normaPlurinacional.subtema1['idsubtema'] +'" >';
		tema1_pre += '';
		$('#tema1desp').html(tema1_pre);
	}else if(normaPlurinacional.tema1['idtema'] == 'n'){
		//Tema sin seleccionar
		tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ normaPlurinacional.tema1['tema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ normaPlurinacional.tema1['idtema'] +'" >';
		tema1_pre += '<label for="subtema1_pre" >Subtema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="subtema1_pre" name="subtema1_pre" required value="'+ normaPlurinacional.subtema1['subtema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idsubtema1_pre" name="idtsubema1_pre" value="'+ normaPlurinacional.subtema1['idsubtema'] +'" >';

		tema1_pre += '';
		$('#tema1desp').html(tema1_pre);
	}else{
		//Tema seleccionado
		tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ normaPlurinacional.tema1['tema'] +'">';;
		tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ normaPlurinacional.tema1['idtema'] +'" >';;
		tema1_pre += '<label for="subtema1_pre" >Subtema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="subtema1_pre" name="subtema1_pre" required value="'+ normaPlurinacional.subtema1['subtema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idsubtema1_pre" name="idsubtema1_pre" value="'+ normaPlurinacional.subtema1['idsubtema'] +'" >';

		tema1_pre += '';
		$('#tema1desp').html(tema1_pre);
	}
	//Tema2
	var tema2_pre = '';
	if(normaPlurinacional.tema2['idtema'] == 0){
		//Otro tema
		console.log('Otro tema seleccionado: ' + normaPlurinacional.tema2['otrotema']);
		tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ normaPlurinacional.tema2['otrotema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ normaPlurinacional.tema2['idtema'] +'" >';
		tema2_pre += '<label for="subtema2_pre" >Subtema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="subtema2_pre" name="subtema2_pre" required value="'+ normaPlurinacional.subtema2['subtema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idsubtema2_pre" name="idsubtema2_pre" value="'+ normaPlurinacional.subtema2['idsubtema'] +'" >';
		tema2_pre += '';
		$('#tema2desp').html(tema2_pre);
	}else if(normaPlurinacional.tema2['idtema'] == 'n'){
		//Tema sin seleccionar
		tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ normaPlurinacional.tema2['tema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ normaPlurinacional.tema2['idtema'] +'" >';
		tema2_pre += '<label for="subtema2_pre" >Subtema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="subtema2_pre" name="subtema2_pre" required value="'+ normaPlurinacional.subtema2['subtema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idsubtema2_pre" name="idtsubema2_pre" value="'+ normaPlurinacional.subtema2['idsubtema'] +'" >';

		tema2_pre += '';
		$('#tema2desp').html(tema2_pre);
	}else{
		//Tema seleccionado
		tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ normaPlurinacional.tema2['tema'] +'">';;
		tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ normaPlurinacional.tema2['idtema'] +'" >';;
		tema2_pre += '<label for="subtema1_pre" >Subtema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="subtema2_pre" name="subtema2_pre" required value="'+ normaPlurinacional.subtema2['subtema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idsubtema2_pre" name="idsubtema2_pre" value="'+ normaPlurinacional.subtema2['idsubtema'] +'" >';

		tema2_pre += '';
		$('#tema2desp').html(tema2_pre);
	}


	var prop_dis = '';
	if(normaPlurinacional.proponente['idproponente'] == 2){
		prop_dis += '<label for="proponente_pre" >Proponente:</label>';
		prop_dis += '<input type="text" class="form-control" id="proponente_pre" name="proponente_pre" required value="'+ normaPlurinacional.proponente['nombre']  +'">';
		prop_dis += '<input type="text" class="form-control" id="proponentedes_pre" name="proponentedes_pre" required value="'+ normaPlurinacional.proponente['otro']  +'">';;
		prop_dis += '<input type="hidden" class="form-control" id="idproponente_pre" name="idproponente_pre" value="'+ normaPlurinacional.proponente['idproponente'] +'" >';
		prop_dis += '';
		$('#propdesp').html(prop_dis);
	}else{
		prop_dis += '<label for="proponente_pre" >Proponente:</label>';
		prop_dis += '<input type="text" class="form-control" id="proponente_pre" name="proponente_pre" required value="'+ normaPlurinacional.proponente['nombre']  +'">';
		prop_dis += '<input type="hidden" class="form-control" id="idproponente_pre" name="idproponente_pre" value="'+ normaPlurinacional.proponente['idproponente'] +'" >';
		prop_dis += '';
		$('#propdesp').html(prop_dis);
	}

	$('#remitente_plu_pre').val(normaPlurinacional.remitente);
	$('#destinatario_plu_pre').val(normaPlurinacional.destinatario);
	$('#fecha_norma_plu_pre').val(normaPlurinacional.fecha['fecha']);
	$('#unixfecha_norma_plu_pre').val(normaPlurinacional.fecha['fecha_unix']);


	$('#remitente_solrep_plu_pre').val(normaPlurinacional.remitente_reposicion);
	$('#destinatario_solrep_plu_pre').val(normaPlurinacional.destinatario_reposicion);
	$('#fecha_norma_solrep_plu_pre').val(normaPlurinacional.fecha_reposicion['fecha']);
	$('#unixfecha_norma_solrep_plu_pre').val(normaPlurinacional.fecha_reposicion['fecha_unix']);

	$('#observaciones_plu_pre').val(normaPlurinacional.observaciones);
	$('#enlace_plu_pre').val(normaPlurinacional.enlace);
	$('#observaciones_met_plu_pre').val(normaPlurinacional.obs_metodologicas);




	console.log(normaPlurinacional);
	$('#preenvionormaplurinacional').modal("show");
});

$('#formulario_norma_plurinacional_lp').submit(function (e) {
	e.preventDefault();
	var normaPlurinacionalLP = new Normalp();
	var instacia = new InstanciaSeguimiento();
	var tema1 = new Tema();
	var tema2 = new Tema();
	var subtema1 = new Subtema();
	var subtema2 = new Subtema();
	var instancia = new InstanciaSeguimiento();

	//Usuario y cuestionario
	normaPlurinacionalLP.idcuestionario = $('#idcuestionario').val();
	normaPlurinacionalLP.usuario = $('#idusuario').val();

	//Instancia de seguimiento
	instancia.identificador = $('#idinstancia_plu_lp').val();
	instancia.literal = $('#instancia_plu_lp').val();
	normaPlurinacionalLP.instanciaSeguimiento = instancia;

	//Codigo y nombre de la norma
	normaPlurinacionalLP.codigo = $('#codigo_plu_lp').val();
	normaPlurinacionalLP.nombre = $('#nombre_plu_lp').val();
	//Objeto de la norma
	normaPlurinacionalLP.objeto = $('#objeto_plu_lp').val();

	//Fecha de la norma
	normaPlurinacionalLP.fecha = new Fecha($('#fecha_plu_lp').val());

	//Temas de la norma
	//tema1.idtema = $('input:radio[name=idtema]:checked').val();
	tema1.idtema = $('#tema1').find("option:selected").val();
	tema1.tema = $('#tema1').find("option:selected").html();
	tema1.otrotema = $('#otrotema1norma').val();
	subtema1.idsubtema = $('#subtema1').find("option:selected").val();
	subtema1.subtema = $('#subtema1').find("option:selected").html();
	subtema1.idtema = tema1.idtema;

	//tema2.idtema = $('input:radio[name=idtema2]:checked').val();
	tema2.idtema = $('#tema2').find("option:selected").val();
	tema2.tema = $('#tema2').find("option:selected").html();
	tema2.otrotema = $('#otrotema2norma').val();
	subtema2.idsubtema = $('#subtema2').find("option:selected").val();
	subtema2.subtema = $('#subtema2').find("option:selected").html();
	subtema2.idtema = tema2.idtema;



	normaPlurinacionalLP.tema1 = tema1;
	normaPlurinacionalLP.tema2 = tema2;
	normaPlurinacionalLP.subtema1 = subtema1;
	normaPlurinacionalLP.subtema2 = subtema2;


	//Antecedentes de ley
	normaPlurinacionalLP.codigo_proyecto_ley = $('#codigo_previo_plu_lp').val();
	normaPlurinacionalLP.comentarios = $('#comentarios_plu_lp').val();

	//Otros
	normaPlurinacionalLP.observaciones = $('#observaciones_plu').val();
	normaPlurinacionalLP.enlace = $('#enlace_plu').val();

	//Datos del registro
	normaPlurinacionalLP.obs_metodologicas = $('#observaciones_met_plu').val();


	/*********************************/
	/*  RELLENADO DEL PREEnVIO      */
	/*********************************/

	//Datos generales
	$('#codigo_plu_lp_pre').val(normaPlurinacionalLP.codigo);
	$('#nombre_plu_lp_pre').val(normaPlurinacionalLP.nombre);
	$('#objeto_plu_lp_pre').val(normaPlurinacionalLP.objeto);
	$('#fecha_plu_lp_pre').val(normaPlurinacionalLP.fecha['fecha']);
	$('#unixfecha_plu_lp_pre').val(normaPlurinacionalLP.fecha['fecha_unix']);



	//Antecedentes de ley
	$('#codigo_previo_plu_lp_pre').val(normaPlurinacionalLP.codigo_proyecto_ley);
	$('#comentarios_plu_lp_pre').val(normaPlurinacionalLP.comentarios);

	//Otros
	$('#observaciones_plu_lp_pre').val(normaPlurinacionalLP.observaciones);
	$('#enlace_plu_lp_pre').val(normaPlurinacionalLP.enlace);

	//Datos del registro
	$('#observaciones_met_plu_lp_pre').val(normaPlurinacionalLP.obs_metodologicas);


	var tema1_pre = '';
	if(normaPlurinacionalLP.tema1['idtema'] == 0){
		//Otro tema
		console.log('Otro tema seleccionado: ' + normaPlurinacionalLP.tema1['otrotema']);
		tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ normaPlurinacionalLP.tema1['otrotema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ normaPlurinacionalLP.tema1['idtema'] +'" >';
		tema1_pre += '<label for="subtema1_pre" >Subtema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="subtema1_pre" name="subtema1_pre" required value="'+ normaPlurinacionalLP.subtema1['subtema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idsubtema1_pre" name="idsubtema1_pre" value="'+ normaPlurinacionalLP.subtema1['idsubtema'] +'" >';
		tema1_pre += '';
		$('#tema1desp').html(tema1_pre);
	}else if(normaPlurinacionalLP.tema1['idtema'] == 'n'){
		//Tema sin seleccionar
		tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ normaPlurinacionalLP.tema1['tema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ normaPlurinacionalLP.tema1['idtema'] +'" >';
		tema1_pre += '<label for="subtema1_pre" >Subtema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="subtema1_pre" name="subtema1_pre" required value="'+ normaPlurinacionalLP.subtema1['subtema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idsubtema1_pre" name="idtsubema1_pre" value="'+ normaPlurinacionalLP.subtema1['idsubtema'] +'" >';

		tema1_pre += '';
		$('#tema1desp').html(tema1_pre);
	}else{
		//Tema seleccionado
		tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ normaPlurinacionalLP.tema1['tema'] +'">';;
		tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ normaPlurinacionalLP.tema1['idtema'] +'" >';;
		tema1_pre += '<label for="subtema1_pre" >Subtema1:</label>';
		tema1_pre += '<input type="text" class="form-control" id="subtema1_pre" name="subtema1_pre" required value="'+ normaPlurinacionalLP.subtema1['subtema'] +'">';
		tema1_pre += '<input type="hidden" class="form-control" id="idsubtema1_pre" name="idsubtema1_pre" value="'+ normaPlurinacionalLP.subtema1['idsubtema'] +'" >';

		tema1_pre += '';
		$('#tema1desp').html(tema1_pre);
	}
	//Tema2
	var tema2_pre = '';
	if(normaPlurinacionalLP.tema2['idtema'] == 0){
		//Otro tema
		console.log('Otro tema seleccionado: ' + normaPlurinacionalLP.tema2['otrotema']);
		tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ normaPlurinacionalLP.tema2['otrotema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ normaPlurinacionalLP.tema2['idtema'] +'" >';
		tema2_pre += '<label for="subtema2_pre" >Subtema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="subtema2_pre" name="subtema2_pre" required value="'+ normaPlurinacionalLP.subtema2['subtema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idsubtema2_pre" name="idsubtema2_pre" value="'+ normaPlurinacionalLP.subtema2['idsubtema'] +'" >';
		tema2_pre += '';
		$('#tema2desp').html(tema2_pre);
	}else if(normaPlurinacionalLP.tema2['idtema'] == 'n'){
		//Tema sin seleccionar
		tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ normaPlurinacionalLP.tema2['tema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ normaPlurinacionalLP.tema2['idtema'] +'" >';
		tema2_pre += '<label for="subtema2_pre" >Subtema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="subtema2_pre" name="subtema2_pre" required value="'+ normaPlurinacionalLP.subtema2['subtema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idsubtema2_pre" name="idtsubema2_pre" value="'+ normaPlurinacionalLP.subtema2['idsubtema'] +'" >';

		tema2_pre += '';
		$('#tema2desp').html(tema2_pre);
	}else{
		//Tema seleccionado
		tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ normaPlurinacionalLP.tema2['tema'] +'">';;
		tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ normaPlurinacionalLP.tema2['idtema'] +'" >';;
		tema2_pre += '<label for="subtema1_pre" >Subtema2:</label>';
		tema2_pre += '<input type="text" class="form-control" id="subtema2_pre" name="subtema2_pre" required value="'+ normaPlurinacionalLP.subtema2['subtema'] +'">';
		tema2_pre += '<input type="hidden" class="form-control" id="idsubtema2_pre" name="idsubtema2_pre" value="'+ normaPlurinacionalLP.subtema2['idsubtema'] +'" >';

		tema2_pre += '';
		$('#tema2desp').html(tema2_pre);
	}

	/*	var normaPlurinacional = new Norma();
		var instancia = new InstanciaSeguimiento();
		var tema1 = new Tema();
		var tema2 = new Tema();
		var proponente = new Proponente();
		var fecha_norma = new Fecha($('#fecha_norma_plu').val());
		var fecha_repo = new Fecha($('#fecha_norma_solrep_plu').val());

		//Usuario y cuestionario
		normaPlurinacional.idcuestionario = $('#idcuestionario').val();
		normaPlurinacional.usuario = $('#idusuario').val();

		//Instancia de seguimiento
		instancia.identificador = $('#idinstancia_plu').val();
		instancia.literal = $('#instancia_plu').val();
		normaPlurinacional.instanciaSeguimiento = instancia;

		//Codigo y nombre de la norma
		normaPlurinacional.codigo = $('#codigo_plu').val();
		normaPlurinacional.nombre = $('#nombre_plu').val();
		normaPlurinacional.fecha = fecha_norma;

		//Objeto de la norma
		normaPlurinacional.objeto = $('#objeto_plu').val();

		//Temas de la norma
		tema1.idtema = $('input:radio[name=idtema]:checked').val();
		tema1.otrotema = $('#otrotema1norma').val();

		tema2.idtema = $('input:radio[name=idtema2]:checked').val();
		tema2.otrotema = $('#otrotema2norma').val();

		normaPlurinacional.tema1 = tema1;
		normaPlurinacional.tema2 = tema2;

		//Capturar el proponente
		proponente.idproponente = $('#proponente').val().toLocaleLowerCase();
		proponente.nombre = $("#proponente option:selected").text();
		proponente.otro = $('#proponente_otro').val();
		normaPlurinacional.proponente = proponente;

		//remitente
		normaPlurinacional.remitente = $('#remitente_plu').val();
		normaPlurinacional.destinatario = $('#destinatario_plu').val();

		//Datos reposicion
		normaPlurinacional.remitente_reposicion = $('#remitente_solrep_plu').val();
		normaPlurinacional.destinatario_reposicion = $('#destinatario_solrep_plu').val();
		normaPlurinacional.fecha_reposicion = fecha_repo;

		normaPlurinacional.observaciones = $('#observaciones_plu').val();
		normaPlurinacional.enlace = $('#enlace_plu').val();

		normaPlurinacional.obs_metodologicas = $('#observaciones_met_plu').val();

		//Rellenado del preenvio
		$('#codigo_plu_pre').val(normaPlurinacional.codigo);
		$('#nombre_plu_pre').val(normaPlurinacional.nombre);
		$('#objeto_plu_pre').val(normaPlurinacional.objeto);

		//Desplegar los temmas capturados
		//Tema1
		var tema1_pre = '';
		if(normaPlurinacional.tema1['idtema'] == 0){
			console.log('Otro tema seleccionado: ' + normaPlurinacional.tema1['otrotema']);
			tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
			tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ normaPlurinacional.tema1['otrotema'] +'">';
			tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ normaPlurinacional.tema1['idtema'] +'" >';
			tema1_pre += '';
			$('#tema1desp').html(tema1_pre);
		}else{
			var temadb = gettema(normaPlurinacional.tema1['idtema']);
			console.log(temadb);
			normaPlurinacional.tema1['tema'] = temadb['nombre_tema'];
			tema1_pre += '<label for="tema1_pre" >Tema1:</label>';
			tema1_pre += '<input type="text" class="form-control" id="tema1_pre" name="tema1_pre" required value="'+ normaPlurinacional.tema1['tema'] +'">';;
			tema1_pre += '<input type="hidden" class="form-control" id="idtema1_pre" name="idtema1_pre" value="'+ normaPlurinacional.tema1['idtema'] +'" >';;
			tema1_pre += '';
			$('#tema1desp').html(tema1_pre);
		}
		//Tema2
		var tema2_pre = '';
		if(normaPlurinacional.tema2['idtema'] == 0){
			console.log('Otro tema seleccionado: '+ normaPlurinacional.tema2['otrotema']);
			tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
			tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ normaPlurinacional.tema2['otrotema'] +'">';
			tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ normaPlurinacional.tema2['idtema'] +'" >';
			tema2_pre += '';
			$('#tema2desp').html(tema2_pre);

		}else{
			var tema2db = gettema(normaPlurinacional.tema2['idtema']);
			console.log(tema2db);
			normaPlurinacional.tema2['tema'] = tema2db['nombre_tema'];
			tema2_pre += '<label for="tema2_pre" >Tema2:</label>';
			tema2_pre += '<input type="text" class="form-control" id="tema2_pre" name="tema2_pre" required value="'+ normaPlurinacional.tema2['tema'] +'">';
			tema2_pre += '<input type="hidden" class="form-control" id="idtema2_pre" name="idtema2_pre" value="'+ normaPlurinacional.tema2['idtema'] +'" >';
			tema2_pre += '';
			$('#tema2desp').html(tema2_pre);
		}

		var prop_dis = '';
		if(normaPlurinacional.proponente['idproponente'] == 2){
			prop_dis += '<label for="proponente_pre" >Proponente:</label>';
			prop_dis += '<input type="text" class="form-control" id="proponente_pre" name="proponente_pre" required value="'+ normaPlurinacional.proponente['nombre']  +'">';
			prop_dis += '<input type="text" class="form-control" id="proponentedes_pre" name="proponentedes_pre" required value="'+ normaPlurinacional.proponente['otro']  +'">';;
			prop_dis += '<input type="hidden" class="form-control" id="idproponente_pre" name="idproponente_pre" value="'+ normaPlurinacional.proponente['idproponente'] +'" >';
			prop_dis += '';
			$('#propdesp').html(prop_dis);
		}else{
			prop_dis += '<label for="proponente_pre" >Proponente:</label>';
			prop_dis += '<input type="text" class="form-control" id="proponente_pre" name="proponente_pre" required value="'+ normaPlurinacional.proponente['nombre']  +'">';
			prop_dis += '<input type="hidden" class="form-control" id="idproponente_pre" name="idproponente_pre" value="'+ normaPlurinacional.proponente['idproponente'] +'" >';
			prop_dis += '';
			$('#propdesp').html(prop_dis);
		}

		$('#remitente_plu_pre').val(normaPlurinacional.remitente);
		$('#destinatario_plu_pre').val(normaPlurinacional.destinatario);
		$('#fecha_norma_plu_pre').val(normaPlurinacional.fecha['fecha']);
		$('#unixfecha_norma_plu_pre').val(normaPlurinacional.fecha['fecha_unix']);


		$('#remitente_solrep_plu_pre').val(normaPlurinacional.remitente_reposicion);
		$('#destinatario_solrep_plu_pre').val(normaPlurinacional.destinatario_reposicion);
		$('#fecha_norma_solrep_plu_pre').val(normaPlurinacional.fecha_reposicion['fecha']);
		$('#unixfecha_norma_solrep_plu_pre').val(normaPlurinacional.fecha_reposicion['fecha_unix']);

		$('#observaciones_plu_pre').val(normaPlurinacional.observaciones);
		$('#enlace_plu_pre').val(normaPlurinacional.enlace);
		$('#observaciones_met_plu_pre').val(normaPlurinacional.obs_metodologicas);


	*/
	console.log(normaPlurinacionalLP);
	$('#preenvionormaplurinacionallp').modal("show");
});

function Norma() {
	this.idcuestionario = '';
	this.usuario = '';
	this.instanciaSeguimiento = '';
	this.departamento = '';
	this.municipio = '';
	this.fecha = '';
	this.fecha_primer_envio = '';
	this.remitente = '';
	this.destinatario = '';
	this.segundoremitente = '';
	this.codigo = '';
	this.nombre = '';
	this.objeto = '';
	this.tema1 = '';
	this.tema2 = '';
	this.subtema1 = '';
	this.subtema2 = '';
	this.proponente = '';
	this.observaciones = '';
	this.estado = '';
	this.remitente_reposicion = '';
	this.destinatario_reposicion = '';
	this.fecha_reposicion = '';
	this.enlace = '';
	this.obs_metodologicas = '';
}
function Normalp() {
	this.idcuestionario = '';
	this.usuario = '';
	this.instanciaSeguimiento = '';
	this.departamento = '';
	this.municipio = '';
	this.fecha = '';
	this.fecha_primer_envio = '';
	this.remitente = '';
	this.destinatario = '';
	this.segundoremitente = '';
	this.codigo = '';
	this.nombre = '';
	this.objeto = '';
	this.tema1 = '';
	this.tema2 = '';
	this.subtema1 = '';
	this.subtema2 = '';
	this.proponente = '';
	this.observaciones = '';
	this.estado = '';
	this.remitente_reposicion = '';
	this.destinatario_reposicion = '';
	this.fecha_reposicion = '';
	this.enlace = '';
	this.obs_metodologicas = '';
	this.codigo_proyecto_ley = '';
	this.comentarios = '';
}

function Departamento() {
	this.iddepartamento = '';
	this.departamento = '';
}

function Municipio() {
	this.idmunicipio = '';
	this.municipio = '';
}

function Remitente() {
	this.existe = '';
	this.nombre = '';
}
function Tema(){
	this.idtema = '';
	this.tema = '';
	this.otrotema = '';
}

function Subtema(){
	this.idsubtema = '';
	this.subtema = '';
	this.idtema = '';
}
function Proponente() {
	this.idproponente = '';
	this.nombre = '';
	this.otro = '';
}

function Estado() {
	this.idestado = '';
	this.estado = '';
}

function gettema(identificador){
	var ret_val = {};
	$.ajax({
		url: baseurl + "/normativa/getTema/",
		type: 'post',
		data: {'identificador': identificador},
		async: false,
		dataType: 'json'
	}).done(function (response) {
		ret_val = response;
	}).fail(function (jqXHR, textStatus, errorThrown) {
		ret_val = null;
	});
	return ret_val;
}




/**
 * Fin Cuestionario de normativas
 **/


/*******************
 *
 * REPORTES PLENARIAS Y NORMAS
 *
 * ********************/
jQuery(document).on('change', 'select#iddepple', function (e) {
	e.preventDefault();
	console.log('Departamento seleccionado');
	var iddep = jQuery(this).val();
	getMunicipiosPlenariaReporte(iddep);
});
function getMunicipiosPlenariaReporte(iddepartamento){
	$.ajax({
		url: baseurl + "/plenaria/getMunicipiosReporte/",
		type: 'post',
		data: {iddepartamento: iddepartamento},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#idmunple').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito municipios");
			console.log(json);

			var opciones = '';

			opciones += '';
			opciones += '	';
			opciones += '		<option value="" >Seleccione un municipio</option>';
			for (var i = 0; i<json.length; i++) {
				opciones += '	<option value="'+ json[i].idmunicipio +'">'+ json[i].municipio_nombre +'</option>';
			}
			opciones += '	';
			jQuery("select#idmunple").html(opciones);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
/*******************
 *
 * FIN REPORTES PLENARIAS Y NORMAS
 *
 * ********************/

/****************
 *
 * Padron - recoleccion de informacion
 *
 *****************/
$('#formcomp_ci').submit(function (e) {
	e.preventDefault();
	var numerocarnet = $('#carnet_identidad').val();
	var cuentaci = numeroci(numerocarnet);
	console.log("Comprobar el CI");
	console.log(numerocarnet);
	console.log(cuentaci);
	if(cuentaci == 0)
	{
		console.log('No esta registrado');
		$('#num_docid').val(numerocarnet);
		$('#personanoregistradaci').modal("show");
	}else {
		console.log('Ya esta registrado');
		$('#personaregistrada').modal("show");
		$('#carnet_identidad').val('');
	}
});

//Insercion de la CI
//$('#formregistrar_ci').submit(function (e) {
	/*e.preventDefault();
	var numerocarnet = $('#carnet_identidad').val();
	console.log('InsertarCI');
	console.log(numerocarnet);
	//Llamada Rutina de insercion json
	var flaginsert = insertarCI(numerocarnet);
	console.log(flaginsert);*/

	/*if(flaginsert['bandera'] == false){
		$('#carnet_identidad').val('');
		$('#personanoregistradaci').hide();
		$('#inserterror').modal("show");
	}else {
		$('#carnet_identidad').val('');
		$('#personanoregistradaci').hide();
		$('#insertcorrecto').modal("show");
	}

	location.reload();*/





	/*
	var numerocarnet = $('#carnet_identidad').val();
	var cuentaci = numeroci(numerocarnet);
	console.log("Comprobar el CI");
	console.log(numerocarnet);
	console.log(cuentaci);
	if(cuentaci == 0)
	{
		console.log('No esta registrado');
		$('#num_docid').val(numerocarnet);
		$('#personanoregistradaci').modal("show");
	}else {
		console.log('Ya esta registrado');
		$('#personaregistrada').modal("show");
		$('#carnet_identidad').val('');
	}*/
//});


function numeroci(numeroci){
	var ret_val = {};
	$.ajax({
		url: baseurl + "/padron/getnumeroci/",
		type: 'post',
		data: {'numeroci': numeroci},
		async: false,
		dataType: 'json'
	}).done(function (response) {
		ret_val = response;
	}).fail(function (jqXHR, textStatus, errorThrown) {
		ret_val = null;
	});
	return ret_val;
}

function insertarCI(numeroci){
	var ret_val = {};
	$.ajax({
		url: baseurl + "/padron/insertarci/",
		type: 'post',
		data: {'numeroci': numeroci},
		async: false,
		dataType: 'json'
	}).done(function (response) {
		ret_val = response;
	}).fail(function (jqXHR, textStatus, errorThrown) {
		ret_val = null;
	});
	return ret_val;
}

/****************
 *
 * Fin Padron - recoleccion de informacion
 *
 *****************/
jQuery(document).on('change', 'select#tema1', function (e) {
	e.preventDefault();
	console.log('Tema 1 Seleccionado');
	var idtema = jQuery(this).val();
	console.log(idtema);
	//getSubtemas1(idtema);
	if(idtema == 0){
		console.log("Seleccion Otro tema");
		var opciones = '		<option value="n" >Sin Seleccion</option>';
		var opcion = '';
		opcion += '<label for="otrotema1norma">Otro tema:</label><br>';
		opcion += '<input type="text" id="otrotema1norma" name="otrotema1norma" required class="form-control" value="">';
		$('#otrotema1normadatos').html(opcion);
		$("select#subtema1").empty();
		$("select#subtema1").html(opciones);

	}else if(idtema == 'n'){
		console.log("Sin seleccion");
		var opciones = '		<option value="n" >Sin Seleccion</option>';
		var opciones = ' ';
		$('#otrotema1normadatos').empty();
		$("select#subtema1").empty();
		$("select#subtema1").html(opciones);

	}else {
		console.log('Seleccion con subtemas');
		$("select#subtema1").empty();
		getSubtemas1(idtema);
		$('#otrotema1normadatos').empty();
	}
});
jQuery(document).on('change', 'select#tema2', function (e) {
	e.preventDefault();
	console.log('Tema 1 Seleccionado');
	var idtema = jQuery(this).val();
	console.log(idtema);
	//getSubtemas1(idtema);
	if(idtema == 0){
		console.log("Seleccion Otro tema");
		var opciones = '		<option value="n" >Sin Seleccion</option>';
		var opcion = '';
		opcion += '<label for="otrotema2norma">Otro tema:</label><br>';
		opcion += '<input type="text" id="otrotema2norma" name="otrotema2norma" required class="form-control" value="">';
		$('#otrotema2normadatos').html(opcion);
		$("select#subtema2").empty();
		$("select#subtema2").html(opciones);
	}else if(idtema == 'n'){
		console.log("Sin seleccion");
		var opciones = ' ';
		$('#otrotema2normadatos').empty();
		$("select#subtema2").empty();
	}else {
		console.log('Seleccion con subtemas');
		getSubtemas2(idtema);
		$('#otrotema2normadatos').empty();
	}


});
function getSubtemas1(idtema){
	$.ajax({
		url: baseurl + "/normativa/getSubtema/",
		type: 'post',
		data: {identificador: idtema},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#subtema1').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito subtemas1");
			console.log(json);

			var opciones = '';

			opciones += '';
			opciones += '	';
			opciones += '		<option value="n" >Sin Seleccion</option>';
			for (var i = 0; i<json.length; i++) {
				opciones += '	<option value="'+ json[i].idsubtema +'">'+ json[i].nombre_subtema +'</option>';
			}
			opciones += '	';
			jQuery("select#subtema1").html(opciones);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
function getSubtemas2(idtema){
	$.ajax({
		url: baseurl + "/normativa/getSubtema/",
		type: 'post',
		data: {identificador: idtema},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#subtema2').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito subtemas2");
			console.log(json);

			var opciones = '';

			opciones += '';
			opciones += '	';
			opciones += '		<option value="n" >Sin seleccion</option>';
			for (var i = 0; i<json.length; i++) {
				opciones += '	<option value="'+ json[i].idsubtema +'">'+ json[i].nombre_subtema +'</option>';
			}
			opciones += '	';
			jQuery("select#subtema2").html(opciones);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

/*******************
 *
 * subtemas
 *
 * *****************/
