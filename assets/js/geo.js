function geolocalizar()
{
	var lat = $("input#latitud_f");
	var lon = $("input#longitud_f");

	if (navigator.geolocation){
		navigator.geolocation.getCurrentPosition(mostrarPosicion,mostrarError);
	}
	else {
		lat.val(0);
		lon.val(0);
	}

}

function mostrarPosicion(position){
	var lat = $("input#latitud_f");
	var lon = $("input#longitud_f");
	lat.val(position.coords.latitude);
	lon.val(position.coords.longitude);
	alert("Localizacion actual: " + lat.val() + "  " + lon.val());

}
function mostrarError(error){
	switch(error.code) {
		case error.PERMISSION_DENIED:
			alert("El usuario ha denegado el permiso a la localización");
			break;
		case error.POSITION_UNAVAILABLE:
			alert("La información de la localización no está disponible");
			break;
		case error.TIMEOUT:
			alert("El tiempo de espera para buscar la localización ha expirado");
			break;
		case error.UNKNOWN_ERROR:
			alert("Error desconocido");
			break;
	}
}

$(document).ready(geolocalizar());
