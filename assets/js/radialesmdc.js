//Detectar la presion del boton
jQuery(document).on('click', '#mcomunicacion', function (e) {
    $('#actoreS').css("visibility", "hidden");
    $('#mediosDc').css("visibility", "visible");
//    document.getElementById("elemento").style.visibility = 'visible';
 //   $('#elemento').hide();
	var fechas = new Fechas();
	console.log("Boton presionado mediosDcomunicacion");
	//Capturar el valor del primer input date
	fechas.fecha_inicio = $("input#fecha_inicio").val();
	//Capturar el valor del segundo input date
	fechas.fecha_fin = $("input#fecha_fin").val();
//	console.log(fechas);
//	console.log(JSON.stringify(fechas));
    getmedio0(fechas);
});
//Funcion para extraer actores
function getmedio0(fecha) {
	$.ajax({
		url: baseurl + "/Graficos/getMedioDcomunicacion",
		type: 'post',
		data: {fecha: JSON.stringify(fecha) },
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Consulta mediosDcomunicacion OK");
//			console.log(json);
			grafRadial0(json);
		},
		error: function (xhr, ajaxOptions, thrownError) {
//			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
function grafRadial0(matriz)
{
    $("#my_dataviz").empty();
    var matrix = matriz;
    var dibujo = radialChart0(matrix);
    
    dibujo.lienzo();
}
//Definir el objeto fechas
function Fechas(){
	this.fecha_inicio = '';
	this.fecha_fin = '';
}
function radialChart0(matrix)
{
    var _chart = {};    //chart es un objeto
    var _b = 1050;       //b es la base de svg
    var _h = 1050;       //h es la altura de svg
    var margenizqu = margendere = 20;
    var margenarri = margenabaj = 20;
    var _margen = {arriba:margenarri,derecha:margendere,abajo:margenabaj,izquierda:margenizqu}; //margen es el margen interno
    var _svg;
    var _bodyV;
    
    _chart.h = function(e)
    {
        if(!arguments.length)
        {
            return _h;
        }
        else
        {
            _h = e;
        }
        return _chart;
    }
    _chart.margen = function(e)
    {
        if(!arguments.length)
        {
            return _margen;
        }
        else
        {
            _margen = e;
        }
        return _chart;
    }
    _chart.b = function(e)
    {
        if(!arguments.length)
        {
            return _b;
        }
        else
        {
            _b = e;
        }
        return _chart;
    }
    _chart.lienzo = function()
    {
//        console.log(matrix);
        console.log("estoy en lienzo mediosDcomunicacion");
        _svg = d3.select("#my_dataviz")     //d3.select("body")
                .append("svg")
                .attr("width",_b)
                .attr("height",_h);
//                .style("background-color", "black");
        _svg.append("defs") //definicion de area.
                .append("clipPath")
                .attr("id","ventana")
                .append("rect")
                .attr("x",0)
                .attr("y",0)
                .attr("width",_b - _margen.derecha - _margen.izquierda)
                .attr("height",_h - _margen.arriba - _margen.abajo);
        _bodyV = _svg.append("g")
                .attr("class","body")
                .attr("transform","translate("+_margen.izquierda+","+_margen.arriba+")")
                .attr("clip-path","url(#ventana)");
        ordenarMatriz0(_b,_h,matrix);
    }
    function ordenarMatriz0(b,h,matrix)
    {
        console.log('Ordenando Matriz mediosDcomunicacion');
        var mymat = [];
        var myobj = {medioC:0,RE:0,ID:0,Censo:0,Total:0};
        var cont = 0;
        for (var i = 0; i < matrix.length ; i++)
        {
            var n = i + 1;
            if(matrix[i].nombre_cuestionario == "Reforma Electoral")
            {
                myobj.RE = matrix[i].ncuestionario;
            }
            if(matrix[i].nombre_cuestionario == "Institucionalidad Democratica")
            {
                myobj.ID = matrix[i].ncuestionario;
            }
            if(matrix[i].nombre_cuestionario == "Censo")
            {
                myobj.Censo = matrix[i].ncuestionario;
            }

            if(matrix.length-1 <= i)
            {
                n = n - Object.keys(myobj).length; //enganando a siguiente if
            };

            if(matrix[i].idmedio != matrix[n].idmedio)
            {
                myobj.medioC = matrix[i].nombre_medio;
                myobj.Total = parseInt(myobj.RE) + parseInt(myobj.ID) + parseInt(myobj.Censo);
                mymat[cont] = myobj
                myobj = {medioC:0,RE:0,ID:0,Censo:0,Total:0};
                cont = cont + 1;
            }
        }
        mymat = mymat.sort((a, b) => b.Total - a.Total);
        console.log(mymat);
        dibujarMatriz0(b,h,mymat);
    }
    function dibujarMatriz0(bc,hc,mymat)
    {
        console.log('dibujando mediosDcomunicacion');
        var tamanoMatriz = mymat.length;
        var colores = {colorRE:'#93C90F', colorID:'#EF9600', colorC:'#00A3E1', colorL:'#7c5295'};
        var escalaDgrafica = 3.2;
        var espacio = 0.02;
        var valorMax = Math.max(...mymat.map(function(d) {return d.Total;}));
        var radio0 = 100;
        var radioInt = radio0;
        var radioExt = radioInt + mymat[0].RE * (escalaDgrafica * (100 / valorMax));
        var anguloIni = 0;
        var anguloFin = (2 * Math.PI) / (tamanoMatriz);
        for(var i = 0 ; i < tamanoMatriz; i++)
        {
            var n = i + 1;
            var arc = d3.arc().innerRadius(radioInt).outerRadius(radioExt).startAngle(anguloIni).endAngle(anguloFin - espacio);
            _bodyV.append('path').attr('transform','translate(' + bc / 2 + ',' + hc / 2 + ')').attr('d',arc()).attr('fill',colores.colorRE);
            radioInt = radioExt;
            radioExt = radioInt + mymat[i].ID * (escalaDgrafica * (100 / valorMax));

            var arc = d3.arc().innerRadius(radioInt).outerRadius(radioExt).startAngle(anguloIni).endAngle(anguloFin - espacio);
            _bodyV.append('path').attr('transform','translate(' + bc / 2 + ',' + hc / 2 + ')').attr('d',arc()).attr('fill',colores.colorID);
            radioInt = radioExt;
            radioExt = radioInt + mymat[i].Censo * (escalaDgrafica * (100 / valorMax));

            var arc = d3.arc().innerRadius(radioInt).outerRadius(radioExt).startAngle(anguloIni).endAngle(anguloFin - espacio);
            _bodyV.append('path').attr('transform','translate(' + bc / 2 + ',' + hc / 2 + ')').attr('d',arc()).attr('fill',colores.colorC);
            radioInt = radio0;
            if(mymat.length - 1 > i)
            {
                radioExt = radioInt + mymat[n].RE * (escalaDgrafica * (100 / valorMax));
                anguloIni = anguloFin;
                anguloFin = anguloIni + (2 * Math.PI) / (tamanoMatriz);
            }
        }
        etiqueta0(bc,hc,radio0,mymat,escalaDgrafica);
    }
    function etiqueta0(bc,hc,radio0,mimat,escalaDgrafica)
    {
        console.log('Poniendo etiquetas mediosDcomunicacion');
        var color = {RE:'#93C90F', ID:'#EF9600', C:'#00A3E1', L:'#7c5295'};
        _bodyV.append("circle").attr("cx",(bc/2)-70).attr("cy",(hc/2)-20).attr("r", 6).style("fill", color.RE);
        _bodyV.append("circle").attr("cx",(bc/2)-70).attr("cy",(hc/2)).attr("r", 6).style("fill", color.ID);
        _bodyV.append("circle").attr("cx",(bc/2)-70).attr("cy",(hc/2)+20).attr("r", 6).style("fill", color.C);
        _bodyV.append("text").attr("x", (bc/2)-60).attr("y", (hc/2)-20).text("Reforma Electoral").style("font-size", "15px").attr("alignment-baseline","middle");
        _bodyV.append("text").attr("x", (bc/2)-60).attr("y", (hc/2)).text("Inst. Democratica").style("font-size", "15px").attr("alignment-baseline","middle");
        _bodyV.append("text").attr("x", (bc/2)-60).attr("y", (hc/2)+20).text("Censo").style("font-size", "15px").attr("alignment-baseline","middle");
//Dibujando circulos Negros
        var radioReal2 = mimat[0].Total;
        var radioReal1 = ((2 / 3) * mimat[0].Total);
        var radioReal0 = ((1 / 3) * mimat[0].Total);
/*        var valorMax = Math.max(...mimat.map(function(d) {return d.Total;}));*/
        var radioExt = 100 + radioReal2 * (escalaDgrafica * (100 / mimat[0].Total));
        var radioExt2 = 100 + radioReal1 * (escalaDgrafica * (100 / mimat[0].Total));
        var radioExt1 = 100 + radioReal0 * (escalaDgrafica * (100 / mimat[0].Total));
        _bodyV.append("circle")
            .attr("transform","translate(" + bc/2 +"," + hc/2 + ")") //moviendo el centro
            .attr("fill", "none")
            .attr("stroke", "#000")
            .attr("stroke-opacity", 0.1)
            .attr("r", radioExt);
        _bodyV.append("circle")
            .attr("transform","translate(" + bc/2 +"," + hc/2 + ")") //moviendo el centro
            .attr("fill", "none")
            .attr("stroke", "#000")
            .attr("stroke-opacity", 0.1)
            .attr("r", radioExt2);
        _bodyV.append("circle")
            .attr("transform","translate(" + bc/2 +"," + hc/2 + ")") //moviendo el centro
            .attr("fill", "none")
            .attr("stroke", "#000")
            .attr("stroke-opacity", 0.1)
            .attr("r", radioExt1);
//inserta valores en circulos negros
        _bodyV.append("text")
            .attr("transform","translate(" + bc/2 +"," + hc/2 + ")") //moviendo el centro
            .attr("x", -35)
            .attr("y", -radioExt1)
            .attr("dy", "0.35em")
            .style("font-size", "10px")
            .text(Math.round(radioReal0));
        _bodyV.append("text")
            .attr("transform","translate(" + bc/2 +"," + hc/2 + ")") //moviendo el centro
            .attr("x", -35)
            .attr("y", -radioExt2)
            .attr("dy", "0.35em")
            .style("font-size", "10px")
            .text(Math.round(radioReal1));
        _bodyV.append("text")
            .attr("transform","translate(" + bc/2 +"," + hc/2 + ")") //moviendo el centro
            .attr("x", -35)
            .attr("y", -radioExt)
            .attr("dy", "0.35em")
            .style("font-size", "10px")
            .text(Math.round(radioReal2));
//insertando texto "Cuestionario"
        _bodyV.append("text")
            .attr("transform","translate(" + bc/2 +"," + hc/2 + ")") //moviendo el centro
            .attr("x", -70)
            .attr("y", -radioExt-20)
            .attr("dy", "0.35em")
            .text("Noticias");
//etiquetas de colores
        var matrixn=[];
        var tamanoMatriz = mimat.length;
        for(var i = 0 ; i < tamanoMatriz; i++)
        {
            matrixn[i]=(mimat[i].medioC);
        }
        var color = d3.scaleOrdinal()
            .domain(matrixn)
            .range(d3.schemeSet1);

        _bodyV.append("g")
            .selectAll("g")
            .data(matrixn)
            .enter()
            .append("g")
            .append("rect")
            .attr("x", 0)
            .attr("y", function(d,i){ return 90 + i*25})
            .attr("width", 15)
            .attr("height", 10)
            .style("fill", function(d){ return color(d)});

        _bodyV.append("g")
            .selectAll("g")
            .data(matrixn)
            .enter()
            .append("g")
            .append("text")
            .attr("x",20)
            .attr("y",function(d,i){return 100+i*25})
            .style("fill",function(d){return color(d)})
            .text(function(d){return d})
            .attr("text-anchor","left")
            .style("aligment-baseline","middle")
//cubos de colores dentro la circunferencia
        var tamanoMatriz = mimat.length;
        var escalaDgrafica = 3.2;
        var espacio = 0.02;
        var valorMax = Math.max(...mimat.map(function(d) {return d.Total;}));
        var radio0 = 100;
        var radioInt = radio0;
        var radioExt = radioInt + mimat[0].RE * (escalaDgrafica * (100 / valorMax));
        var anguloIni = 0;
        var anguloFin = (2 * Math.PI) / (tamanoMatriz);
        for(var i = 0 ; i < tamanoMatriz; i++)
        {
            var n = i + 1;
            var arc = d3.arc().innerRadius(radio0-15).outerRadius(radio0-5).startAngle(anguloIni).endAngle(anguloFin - espacio);
            _bodyV.append('path').attr('transform','translate(' + bc / 2 + ',' + hc / 2 + ')').attr('d',arc()).attr('fill',color(mimat[i].medioC));
            if(mimat.length - 1 > i)
            {
                anguloIni = anguloFin;
                anguloFin = anguloIni + (2 * Math.PI) / (tamanoMatriz);
            }
        }
    }
    return _chart;
}
