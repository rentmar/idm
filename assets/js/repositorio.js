/*Funcion para la carga de temas segun el formulario seleccionado seleccionado*/
jQuery(document).on('change', 'select#idcuestionario', function (e) {
	e.preventDefault();
	var formID = jQuery(this).val();
	console.log(formID);
	getListaTemas(formID);
});

/*
Funcion para extraer la lista de medios segun su tipo
 */
function getListaTemas(formID) {
	//alert(tipomedioID + ' ' + baseurl);
	$.ajax({
		url: baseurl + "/repositorio/gettemas",
		type: 'post',
		data: {formID: formID},
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#tema').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log('Exito');
			console.log(json);
			var options = '';
			options +='<option value="" selected >Seleccionar Tema</option>';
			for (var i = 0; i < json.length; i++) {
				options += '<option value="' + json[i].idtema + '">' + json[i].nombre_tema + '</option>';
			}
			jQuery("select#tema").html(options);

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
	$('.selsimplesubtema').select2();
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
	$('#plenarias-tabla').DataTable({
		responsive: true,
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

	$('[data-toggle="tooltip"]').tooltip();

});
