$('#formencuesta').submit(function (e) {
	//e.preventDefault();
	console.log("Enviar formulario");
	console.log(iduiencuesta);
	idencuesta = iduiencuesta;
	var sec = secciones(idencuesta);
	var pregunta = '';
	var formulario_correcto = true;
	var pregunta_seleccionada;
	var pregunta_seleccionada_input;
	var pregunta_seleccionada_checkotro;
	console.log(sec);
	for(var i=0; i<sec.length;i++){
		pregunta = 'pregunta'+sec[i].iduipregunta;
		console.log(sec[i].iduiseccion); //seccion
		console.log(sec[i].iduipregunta); //pregunta
		console.log(sec[i].iduitipopregunta); //tipo de pregunta
		console.log(pregunta); //Pregunta
		//Validacion
		if(sec[i].iduitipopregunta == 1){
			//Validador, por lo menos uno debe estar seleccionado
			pregunta_seleccionada = $('input[name="pregunta' + sec[i].iduipregunta + '[]"]:checked').length;
			console.log(sec[i].nombre_tipopregunta);
			if (pregunta_seleccionada == 0) {
				e.preventDefault();
				$('#cuestionarioincompleto').modal("show");
				console.log('llenar' + pregunta);
				formulario_correcto = false;
				break;
			}
		}else if(sec[i].iduitipopregunta == 2){
			//Uno debe seleccionarse
			console.log(sec[i].nombre_tipopregunta);
		}else if(sec[i].iduitipopregunta == 3){
			//La casilla de texto debe tener contenido
			pregunta_seleccionada_input=$('input[name="pregunta' + sec[i].iduipregunta + '"]').val();
			console.log(sec[i].nombre_tipopregunta);
			if(pregunta_seleccionada_input == ''){
				e.preventDefault();
				$('#cuestionarioincompleto').modal("show");
				console.log('llenar' + pregunta);
				formulario_correcto = false;
				break;
			}
		}else if(sec[i].iduitipopregunta == 4){
			//Seleccion multiple,
			//Debe seleccionarse uno, maximo tres
			var seleccion_maxima = 3;
			pregunta_seleccionada_checkotro = $('input[name="pregunta' + sec[i].iduipregunta + '[]"]:checked').length;
			console.log(sec[i].nombre_tipopregunta);
			if(pregunta_seleccionada_checkotro == 0){
				e.preventDefault();
				$('#cuestionarioincompleto').modal("show");
				console.log('llenar' + pregunta);
				formulario_correcto = false;
				break;
			}
			if(pregunta_seleccionada_checkotro == 4){
				e.preventDefault();
				alert("Solo se puede seleccionar tres opciones, pregunta (14)");
				formulario_correcto = false;
				break;
			}
		}else if(sec[i].iduitipopregunta == 5){
			//Seleccion cuantificada
			//Checkeado o contenido

			console.log(sec[i].nombre_tipopregunta);
		}
		console.log("");
		console.log("");

	}

	if(formulario_correcto)
	{
		$("#enviarencuesta").html("Encuesta Enviada");
		$("#enviarencuesta").attr("disabled", true);
	}
});

function secciones(identificador){
	var ret_val = {};
	$.ajax({
		url: baseurl + "/encuesta/getSeccionesPreguntas/",
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


/*$('#formencuesta').submit(function (e) {
	e.preventDefault();
	console.log("Enviar formulario");
	console.log(iduiencuesta);
	idencuesta = iduiencuesta;

});*/



/*$('#formencuesta').submit(function (e) {
	var pregunta_seleccionada;
	var formulario_correcto;
	formulario_correcto = true;
	for(var i=0; i<preguntas.length; i++) {
		pregunta_seleccionada = $('input[name="pregunta' + preguntas[i] + '[]"]:checked').length;
		if (pregunta_seleccionada == 0) {
			e.preventDefault();
			$('#cuestionarioincompleto').modal("show");
			formulario_correcto = false;
			break;
		}
	}
	if(formulario_correcto)
	{
		$("#enviarencuesta").html("Encuesta Enviada");
		$("#enviarencuesta").attr("disabled", true);
	}
});*/
