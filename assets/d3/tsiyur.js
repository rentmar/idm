var escalaColores;
var xmlData=[];
var labelet = d3.scaleOrdinal(["Reforma Electoral","Institucionalidad Democratica","Censo","Leyes","Actor","Tipo Medio Comunicacion"]).domain([1,2,3,4,5,6]);
var ucolor = d3.scaleOrdinal(["#33C90F","#CC450F","#33A7F4","#8F7585","#DF1C44","#39A275"]).domain([1,2,3,4,5,6]);
var lpX= d3.scaleOrdinal([1.5,1.2,1.6,2.0,2.0,1.3,2.0,1.3,1.5,1.4,2.0,1.6]).domain(d3.range(0,11)),
	lpY= d3.scaleOrdinal([4.7,5.2,5.2,5.0,4.5,4.0,4.0,3.5,3.3,2.8,2.5,2.2]).domain(d3.range(0,11));
var orX= d3.scaleOrdinal([1.8,1.3,1.9,2.2,1.8,1.5,1.3,2.0,2.6,1.8,1.6,1.9]).domain(d3.range(0,11)),
	orY= d3.scaleOrdinal([6.2,6.2,5.7,5.9,6.1,6.5,6.2,6.3,6.4,6.4,6.4,6.4]).domain(d3.range(0,11));
var ptsiX= d3.scaleOrdinal([2.3,2.9,3.1,2.4,1.7,3.0,1.8,2.1,2.5,3.0,3.1,2.8]).domain(d3.range(0,11)),
	ptsiY= d3.scaleOrdinal([7.6,6.0,6.6,7.0,7.2,7.3,7.8,8.4,8.0,7.8,8.1,8.3]).domain(d3.range(0,11));
var cbbaX= d3.scaleOrdinal([3.1,3.1,2.6,3.6,2.6,2.7,3.7,3.4,3.5,3.8,3.0,3.0]).domain(d3.range(0,11)),
	cbbaY= d3.scaleOrdinal([5.2,4.8,4.8,4.6,5.2,5.5,5.3,5.5,5.8,5.9,4.0,5.4]).domain(d3.range(0,11));
var chuX= d3.scaleOrdinal([4.0,3.5,4,3.6,4.2,3.6,3.4,3.9,4.3,4.6,4.8,5.0]).domain(d3.range(0,11)),
	chuY= d3.scaleOrdinal([6.8,6.3,6.5,7.0,7.0,7.3,7.6,7.5,7.4,7.4,7.4,7.4]).domain(d3.range(0,11));
var tjaX= d3.scaleOrdinal([4.0,6.3,4.0,4.5,5.0,3.5,4.5,5.0,4.9,4.0,4.6,3.8]).domain(d3.range(0,11)),
	tjaY= d3.scaleOrdinal([8.0,7.7,7.8,7.8,7.8,8.0,8.0,8.0,8.2,8.5,8.2,8.2]).domain(d3.range(0,11));
var pdoX= d3.scaleOrdinal([1.8,1,1.1,1.3,2.2,2.0,2.4,2.6,2.7,3.2,2.9,2.2]).domain(d3.range(0,11)),
	pdoY= d3.scaleOrdinal([1.4,1.5,1.7,1.9,1.8,1.1,0.8,1.3,0.6,0.7,0.8,1.0]).domain(d3.range(0,11));
var bniX= d3.scaleOrdinal([3.3,3.0,2.6,4.0,4.4,5.1,4.6,3.7,3.3,3.1,2.6,2.6]).domain(d3.range(0,11)),
	bniY= d3.scaleOrdinal([3.2,4.3,4.0,4.1,3.3,2.9,2.6,2.4,2.1,1.4,2.1,2.4]).domain(d3.range(0,11));
var sczX= d3.scaleOrdinal([5.7,5,6.5,7.5,7.0,4.5,4.5,5.5,6.2,4.8,5.8,5.8]).domain(d3.range(0,11)),
	sczY= d3.scaleOrdinal([5.4,6.5,6.5,6.0,5.2,5.8,4.8,4.8,4.3,3.9,4.0,3.3]).domain(d3.range(0,11));
function colorRandom(min, max) {
	var numero=Math.round(Math.random() * (max - min) + min);
  return numero.toString();
}
function opcionBubbleCuest(dir,mp)
{
	var cuest = document.getElementById("idcuest").value;
	renderBubbleChart(dir,cuest,mp);
}
function opcionBubbleTemas(dir,mp)
{
	var cuest = document.getElementById("idcuesttema").value;
	renderMultiBubbleChart(dir,cuest,mp);
}
function opcionBubbleActor(dir,mp)
{
	var act = document.getElementById("idcuestactor").value;
	renderBubbleChartActor(dir,act,mp);
}
function renderBubbleChart(direccion,op,mp)
{
	var opcion=op.toString();
	d3.xml(direccion).then(function (dtxml){
			xmlData=d3.range(0,9).map(function (d,i){
				var nombredpto;
				var valorX,valorY,valorRadio;
				nombredpto=dtxml.documentElement.getElementsByTagName("nombre_departamento"+opcion)[i].textContent;
				valorRadio=parseInt(dtxml.documentElement.getElementsByTagName("radio"+opcion)[i].textContent);
				valorNum = parseInt(dtxml.documentElement.getElementsByTagName("cantidad"+opcion)[i].textContent);
				switch (nombredpto)
				{
					case "La Paz":
						valorX=lpX(0);
						valorY=lpY(0);
						break;
					case "Oruro":
						valorX=orX(0);
						valorY=orY(0);
						break;
					case "Potosi":
						valorX=ptsiX(0);
						valorY=ptsiY(0);
						break;
					case "Cochabamba":
						valorX=cbbaX(0);
						valorY=cbbaY(0);
						break;
					case "Chuquisaca":
						valorX=chuX(0);
						valorY=chuY(0);
						break;
					case "Tarija":
						valorX=tjaX(0);
						valorY=tjaY(0);
						break;
					case "Pando":
						valorX=pdoX(0);
						valorY=pdoY(0);
						break;
					case "Beni":
						valorX=bniX(0);
						valorY=bniY(0);
						break;
					case "Santa Cruz":
						valorX=sczX(0);
						valorY=sczY(0);
						break;
				}
			return {u:nombredpto,x:valorX,y:valorY,v:valorNum,r:valorRadio};
			});
			d3.selectAll("svg").remove();
			var bChart = bubbleChart()
			.x(d3.scaleLinear().domain([0,10]).range([0,500]))
			.y(d3.scaleLinear().domain([0,10]).range([0,500]))
			.r(d3.scaleLinear().domain([0,10]).range([0,40]))
			.mapa(mp)
			.etiqueta(labelet(opcion))
			.colores(escalaColores)
			.uncolor(ucolor(opcion));
			bChart.datos(xmlData);
			bChart.render();
		});	//*/
}
function renderBubbleChartActor(direccion,op,mp)
{
	var opcion=op.toString();
	d3.xml(direccion).then(function (dtxml){
			xmlData=d3.range(0,9).map(function (d,i){
				var nombredpto;
				var valorX,valorY,valorRadio;
				nombredpto=dtxml.documentElement.getElementsByTagName("nombre_departamento"+opcion)[i].textContent;
				valorRadio=parseInt(dtxml.documentElement.getElementsByTagName("radio"+opcion)[i].textContent);
				valorNum = parseInt(dtxml.documentElement.getElementsByTagName("cantidad"+opcion)[i].textContent);
				switch (nombredpto)
				{
					case "La Paz":
						valorX=lpX(0);
						valorY=lpY(0);
						break;
					case "Oruro":
						valorX=orX(0);
						valorY=orY(0);
						break;
					case "Potosi":
						valorX=ptsiX(0);
						valorY=ptsiY(0);
						break;
					case "Cochabamba":
						valorX=cbbaX(0);
						valorY=cbbaY(0);
						break;
					case "Chuquisaca":
						valorX=chuX(0);
						valorY=chuY(0);
						break;
					case "Tarija":
						valorX=tjaX(0);
						valorY=tjaY(0);
						break;
					case "Pando":
						valorX=pdoX(0);
						valorY=pdoY(0);
						break;
					case "Beni":
						valorX=bniX(0);
						valorY=bniY(0);
						break;
					case "Santa Cruz":
						valorX=sczX(0);
						valorY=sczY(0);
						break;
				}
			return {u:nombredpto,x:valorX,y:valorY,v:valorNum,r:valorRadio};
			});
			conosle.log(xmlData);
			/*d3.selectAll("svg").remove();
			var bChart = bubbleChart()
			.x(d3.scaleLinear().domain([0,10]).range([0,500]))
			.y(d3.scaleLinear().domain([0,10]).range([0,500]))
			.r(d3.scaleLinear().domain([0,10]).range([0,40]))
			.mapa(mp)
			.etiqueta(labelet(5))
			.colores(escalaColores)
			.uncolor(ucolor(5));
			bChart.datos(xmlData);
			bChart.render();//*/
		});	//*/
}
function renderMultiBubbleChart(direccion,op,mpbo)
{
	xmlData=[];
	var opcion=op.toString();
	d3.xml(direccion).then(function (dtxml){
		//-------------------------------- et
		var numtemas=dtxml.documentElement.getElementsByTagName("cuest"+opcion+"_nomtema").length;
		if (numtemas<=10)
		{
			var colorestema=d3.schemeCategory10; 
		}
		else
		{
			let colorestema=[].concat(d3.schemeCategory10,d3.schemeDark2);
		}
		var xmlNomTemas=d3.range(0,numtemas).map(function (d,i){
			var elemento=dtxml.documentElement.getElementsByTagName("cuest"+opcion+"_nomtema")[i].textContent;
			return {nt:elemento};
		});
		//----------------------- dat
		var nombredpto,nombretema,canttema,radiotema,valorX,valorY;
		var dtstema=[];
		for (var k=0;k<numtemas;k++)
		{
			dtstema=d3.range(0,9).map(function (d,i){
				nombredpto=dtxml.documentElement.getElementsByTagName("cuest"+opcion+"_departamento")[i+9*k].textContent;
				nombretema=dtxml.documentElement.getElementsByTagName("cuest"+opcion+"_tema")[i+9*k].textContent;
				canttema=parseInt(dtxml.documentElement.getElementsByTagName("cuest"+opcion+"_canttema")[i+9*k].textContent);
				radiotema=parseInt(dtxml.documentElement.getElementsByTagName("cuest"+opcion+"_radiotema")[i+9*k].textContent);
				switch (nombredpto)
				{
					case "La Paz":
						valorX=lpX(k);
						valorY=lpY(k);
						break;
					case "Oruro":
						valorX=orX(k);
						valorY=orY(k);
						break;
					case "Potosi":
						valorX=ptsiX(k);
						valorY=ptsiY(k);
						break;
					case "Cochabamba":
						valorX=cbbaX(k);
						valorY=cbbaY(k);
						break;
					case "Chuquisaca":
						valorX=chuX(k);
						valorY=chuY(k);
						break;
					case "Tarija":
						valorX=tjaX(k);
						valorY=tjaY(k);
						break;
					case "Pando":
						valorX=pdoX(k);
						valorY=pdoY(k);
						break;
					case "Beni":
						valorX=bniX(k);
						valorY=bniY(k);
						break;
					case "Santa Cruz":
						valorX=sczX(k);
						valorY=sczY(k);
						break;
				}
				return {nd:nombredpto,nt:nombretema,x:valorX,y:valorY,v:canttema,rdio:radiotema};
			});
			xmlData.push(dtstema);
		}
		//console.log(xmlData);
		d3.selectAll("svg").remove();
			var mbChart = multiBubbleChart()
			.x(d3.scaleLinear().domain([0,10]).range([0,500]))
			.y(d3.scaleLinear().domain([0,10]).range([0,500]))
			.r(d3.scaleLinear().domain([0,10]).range([0,17]))//escala bubble
			.mapa(mpbo)
			.etiquetaTit(labelet(opcion+1))
			.etiqueta(xmlNomTemas)
			.colores(colorestema)
			.uncolor(ucolor(opcion))
			.datos(xmlData);
			mbChart.render();
			mbChart.ponerEtiquetas();//*/
	});
}
function renderDistribucionChart(objj)
{
	var hh=Object.values(objj);
	var m=hh[0];
	var h=hh[1];
	var r=hh[2];
	var t=hh[3];
	//-------------------datos
//	var h=[[10,15,45,4],[20,30,55,7],[10,12,20,47],[8,8,8,8],[10,10,10,10]],m=[[12,45,12,30],[5,5,5,35],[5,8,22,5],[9,10,7,8]];
//	var r=[{'1':"Si"},{r:"No"},{p:"Talvez"},{r:"No Sabe"}];
//	var t="Pregunta numero 1";
	//--------------------
	d3.select("svg").remove();
	var coloresrespta=d3.schemeCategory10; 
	var edades=d3.scaleOrdinal([0,1,2,3,4,5,6,7,8,9],["20-25","26-30","31-35","36-40","41-45","46-50","51-55","56-60","61-65","66-70"]);
	var distChart = distribucionChart()
					.etiquetasEdad(edades)
					.titulo(t)
					.colores(coloresrespta)
					.x(d3.scaleLinear().domain([0,100]).range([0,300]))
					.y(d3.scaleLinear().domain([0,100]).range([0,500]))
					.respuestas(r)
					.datosm(m)
					.datosh(h);//*/
	//console.log(coloresrespta);
	distChart.render();
}
function renderSankeyChart(objjj)
{
	var hh = Object.values(objjj);
	var a = hh[0];
	var b = hh[1];
	var resp = hh[2];
	var t = hh[3];
	console.log(a,b,resp,t);
	
	//------------------------- argumentos
	//----------------------------------- 
	d3.selectAll("svg")
		.remove();
	var nds1=[];
	var n=["La Paz","Cochabamba","Santa Cruz","Chuquisaca","Potosi","Tarija","Oruro","Beni","Pando"];
	for (var i=0;i<n.length;i++)
	{
		nds1[i]={nomnodo:n[i]};
	}
	var snkyChart = sankeyChart()
						.titulo(t)
						.nodos1(nds1)
						.nodos3(resp)
						.enlacea(a)
						.enlaceb(b);
		snkyChart.render();//*/
}
function sankeyChart()
{
	var _chart={};
	var _ancho=800,_alto=850,
		_margenes={arriba:20,derecha:20,abajo:20,izquierda:20},
		_etiquetas,
		_titulo,
		_nodos1=[],_nodos2=[],_nodos3=[],
		_enlacea=[],
		_enlaceb=[],
		_largoNodo=d3.scaleLinear().domain([0,100]).range([0,65]),
		_svg,
		_bodyG;
	_chart.ancho= function (a){
		if(!arguments.length) return _ancho; _ancho=a;
		return _chart;
	}
	_chart.alto = function (h){
		if(!arguments.length) return _alto; _alto=h;
		return _chart;
	}
	_chart.margenes = function (m){
		if (!arguments.length) return _margenes; _margenes=m;
		return _chart;
	}
	_chart.etiquetas = function (e){
		if (!arguments.length) return _etiquetas; _etiquetas=e;
		return _chart;
	}
	_chart.titulo = function (e){
		if (!arguments.length) return _titulo; _titulo=e;
		return _chart;
	}
	_chart.nodos1= function (dts){  
		if(!arguments.length) return _nodos1; _nodos1=dts;
		return _chart;
	}
	_chart.nodos2= function (dts){  
		if(!arguments.length) return _nodos2; _nodos2=dts;
		return _chart;
	}
	_chart.nodos3= function (dts){  
		if(!arguments.length) return _nodos3; _nodos3=dts;
		return _chart;
	}
	_chart.enlacea= function (dts){  
		if(!arguments.length) return _enlacea; _enlacea=dts;
		return _chart;
	}
	_chart.enlaceb= function (dts){  
		if(!arguments.length) return _enlaceb; _enlaceb=dts;
		return _chart;
	}
	function xInicio()
	{
		return _margenes.izquierda;
	}
	function xFin()
	{
		return _margenes.derecha;
	}
	function yInicio()
	{
		return _margenes.arriba;
	}
	function yFin()
	{
		return _margenes.abajo;
	}
	_chart.render = function () {
		if (!_svg){
			_svg = d3.select("body").select("#contenedor-chart")
					.append("svg")
					.attr("width",_ancho)
					.attr("height",_alto);
			defineVentana(_svg);
		}
		renderBodyChart(_svg);
	}
	function defineVentana(svg)
	{
		svg.append("defs")
			.append("clipPath")
			.attr("id","ventana")
			.append("rect")
			.attr("x",0)
			.attr("y",0)
			.attr("width",_ancho-_margenes.izquierda-_margenes.derecha)
			.attr("height",_alto-_margenes.arriba-_margenes.abajo);
	}
	function renderBodyChart(svg)
	{
		if (!_bodyG)
		{
			_bodyG = svg.append("g")
						//.style("fill-opacity",0.8)
						.attr("class","body")
						.attr("transform","translate("+xInicio()+","+yInicio()+")")
						.attr("clip-path","url(#ventana)");
		}
		renderSankeyDiagrama();
	}
	function renderSankeyDiagrama() //-------------------- render samkey
	{
		//--------------------------------------
		var enlace=d3.linkHorizontal();
		var coloresdpto=d3.scaleOrdinal(d3.schemeSet1),
			coloressx=["#FF00FF","blue"],
			coloresrespta=d3.scaleOrdinal(d3.schemeCategory10);
		var ea=[],st,eb=[],stb,nivel2=100,nivel3=60,iniNodoY1=0,iniNodoY2=0,iniNodoY3=0,iniNodom=[],iniNodoh=[],
		valM=0,valH=0,valAnt=0,valPAm=[],valPAh=[],valP=0,nds3=[];
		for (var j=0;j<9;j++)
		{
			iniNodom.push(0);
		}
		for (var j=0;j<9;j++)
		{
			iniNodoh.push(0);
		}
		for (var j=0;j<9;j++)
		{
			valPAm.push(0);
		}
		for (var j=0;j<9;j++)
		{
			valPAh.push(0);
		}
		iniNodoY2=0;
		for (var i=0;i<_enlacea.length;i++)
		{
			iniNodoY3=iniNodoY3+_largoNodo(_enlacea[i][0]);
		}
		valM=iniNodoY3;
		iniNodoY3=iniNodoY3+10;
		for (var j=0;j<_enlacea.length;j++)
		{
			st={source:[20,iniNodoY1+_largoNodo(_enlacea[j][0])/2],
				target:[_ancho/2-nivel2,iniNodoY2+_largoNodo(_enlacea[j][0])/2],
				v:_largoNodo(_enlacea[j][0]),c:coloresdpto(j)};
			ea.push(st);
			st={source:[20,iniNodoY1+_largoNodo(_enlacea[j][0])+_largoNodo(_enlacea[j][1])/2],
				target:[_ancho/2-nivel2,iniNodoY3+_largoNodo(_enlacea[j][1])/2],
				v:_largoNodo(_enlacea[j][1]),c:coloresdpto(j)};
			ea.push(st);
			iniNodoY1=iniNodoY1+_largoNodo(100)+2;
			iniNodoY2=iniNodoY2+_largoNodo(_enlacea[j][0]);
			iniNodoY3=iniNodoY3+_largoNodo(_enlacea[j][1]);
		}//*/
		valH=iniNodoY3-valM;
		_nodos2=[{s:"Mujer",v:valM},{s:"Hombre",v:valH}];
		// enlace b
		for (var k=0;k<9;k++)
		{
			for (var j=0;j<_nodos3.length;j++)
			{
				iniNodom[k]=iniNodom[k]+_largoNodo(_enlaceb[k].m[j]);
			}
		}
		for (var k=0;k<9;k++)
		{
			for (var j=0;j<_nodos3.length;j++)
			{
				iniNodoh[k]=iniNodoh[k]+_largoNodo(_enlaceb[k].h[j]);
			}
		}
		iniNodoY1=0;
		iniNodoY2=0;
		valAnt=0;
		for (var j=0;j<_nodos3.length;j++)
		{
			for (var i=0;i<9;i++)
			{
				valP=iniNodoY1+valPAm[i]+_largoNodo(_enlaceb[i].m[j])/2;
				stb={source:[_ancho/2-nivel2+20,valP],
					target:[_ancho-nivel3,iniNodoY2+_largoNodo(_enlaceb[i].m[j])/2],
					v:_largoNodo(_enlaceb[i].m[j]),
					c:coloresdpto(i)};
				eb.push(stb);
				valPAm[i]=valPAm[i]+_largoNodo(_enlaceb[i].m[j]);
				iniNodoY1=iniNodoY1+iniNodom[i];
				iniNodoY2=iniNodoY2+_largoNodo(_enlaceb[i].m[j]);
			}
			iniNodoY1=iniNodoY1+10;
			for (var i=0;i<9;i++)
			{
				valP=iniNodoY1+valPAh[i]+_largoNodo(_enlaceb[i].h[j])/2;
				stb={source:[_ancho/2-nivel2+20,valP],
					target:[_ancho-nivel3,iniNodoY2+_largoNodo(_enlaceb[i].h[j])/2],
					v:_largoNodo(_enlaceb[i].h[j]),
					c:coloresdpto(i)};
				eb.push(stb);
				valPAh[i]=valPAh[i]+_largoNodo(_enlaceb[i].h[j]);
				iniNodoY1=iniNodoY1+iniNodoh[i];
				iniNodoY2=iniNodoY2+_largoNodo(_enlaceb[i].h[j]);
			}//*/
			_nodos3[j].v=iniNodoY2-valAnt-(10*j);
			valAnt=valAnt+_nodos3[j].v;
			iniNodoY2=iniNodoY2+10;
			iniNodoY1=0;
		}
		valAnt=0;
		//---------------- nodos nivel 1
		_bodyG.selectAll(".nodos1")
				.data(_nodos1)
				.enter()
				.append("rect")
				.attr("class","nodos1")
				.attr("fill",function (d,i){
					return coloresdpto(i);
				})
				.attr("x",0)
				.attr("y",function (d,i){
					return (_largoNodo(100)+2)*i;
				})
				.attr("width",20)
				.attr("height",_largoNodo(100));
		//----------------- enlaces nivel 1
		_bodyG.selectAll(".linkA")
				.data(ea)
				.enter()
				.append("path")
				.attr("class","linkA")
				.attr("d",function (d,i){
					return enlace(d);
				})
				.style("opacity",0.5)
				.attr("fill","none")
				.attr("stroke",function (d) {
					return d.c;
				})
				.attr("stroke-width",function (d,i) {
					return d.v;
				});
		//----------------- nodos nivel 2
		for (var i=0;i<_nodos2.length;i++)
		{
			_bodyG.append("rect")
				.attr("class","nodos2")
				.attr("fill",coloressx[i])
				.attr("x",_ancho/2-nivel2)
				.attr("y",valAnt+10*i)
				.attr("width",20)
				.attr("height",_nodos2[i].v-10*i);
			valAnt=valAnt+_nodos2[i].v;
		}//*/
		//----------------- enlaces nivel 3
		_bodyG.selectAll(".linkB")
				.data(eb)
				.enter()
				.append("path")
				.attr("class","linkB")
				.attr("d",function (d,i){
					return enlace(d);
				})
				.style("opacity",0.5)
				.attr("fill","none")
				.attr("stroke",function (d) {
					return d.c;
				})
				.attr("stroke-width",function (d,i) {
					return d.v;
				});
		valAnt=0;
		for (var i=0;i<_nodos3.length;i++)
		{
			_bodyG.append("rect")
				.attr("class","nodos3")
				.attr("fill",coloresrespta(i))
				.attr("x",_ancho-nivel3)
				.attr("y",valAnt)
				.attr("width",20)
				.attr("height",_nodos3[i].v);
			valAnt=valAnt+_nodos3[i].v+10;
		}//*/
		etiquetar();
	}
	function etiquetar()
	{
		var setexto=200,respta=0;
		coloresrespta=d3.scaleOrdinal(d3.schemeCategory10);
		_bodyG.append("text")
			.attr("class","titulo")
			.attr("font-size","1em")
			.attr("x",0)
			.attr("y",_alto-setexto)
			.text(_titulo);
		_bodyG.selectAll(".departamento")
			.data(_nodos1)
			.enter()
			.append("text")
			.attr("class","departamento")
			.attr("font-size","1em")
			.attr("x",22)
			.attr("y",function (d,i){
				return (_largoNodo(100)+2)*i+12;
			})
			.text(function (d){
				return d.nomnodo;
			});
		_bodyG.selectAll(".indicadores")
			.data(_nodos3)
			.enter()
			.append("rect")
			.attr("class","indicadores")
			.attr("x",0)
			.attr("y",function (d,i){
				return _alto-setexto+20+22*i;
			})
			.attr("width",20)
			.attr("height",20)
			.style("fill",function (d,i){
				return coloresrespta(i);
			})
		for (var k=0;k<_nodos2.length;k++)
		{
			_bodyG.append("text")
				.attr("class","sx")
				.attr("font-size","1em")
				.attr("x",_ancho/2-80)
				.attr("y",respta+12)
				.text(_nodos2[k].s);
			respta=respta+_nodos2[k].v+10;
		}
		_bodyG.selectAll(".repuesta")
			.data(_nodos3)
			.enter()
			.append("text")
			.attr("class","respuesta")
			.attr("font-size","1em")
			.attr("x",25)
			.attr("y",function (d,i){
				return _alto-setexto+35+22*i;
			})
			.text(function (d){
				return d.r;
			});
	}
	//-------------------- chart
	return _chart;
}
function distribucionChart()
{
	var _chart={};
	var _datosh=[],_datosm=[],
		_ancho=800,_alto=500,
		_margenes={arriba:20,derecha:20,abajo:20,izquierda:20},
		_x,_y,
		_respuestas,
		_colores,
		_etiquetasEdad,
		_ettitulo,
		_svg,
		_bodyG;
	_chart.ancho= function (a){
		if(!arguments.length) return _ancho; _ancho=a;
		return _chart;
	}
	_chart.alto = function (h){
		if(!arguments.length) return _alto; _alto=h;
		return _chart;
	}
	_chart.margenes = function (m){
		if (!arguments.length) return _margenes; _margenes=m;
		return _chart;
	}
	_chart.x = function (c) {
		if (!arguments.length) return _x; _x=c;
		return _chart;
	}
	_chart.y = function (c) {
		if (!arguments.length) return _y; _y=c;
		return _chart;
	}
	_chart.respuestas = function (r) {
		if (!arguments.length) return _respuestas; _respuestas=r;
		return _chart;
	}
	_chart.colores = function (c) {
		if (!arguments.length) return _colores; _colores=c;
		return _chart;
	}
	_chart.uncolor= function (uc){
		if (!arguments.length) return _uncolor; _uncolor=uc;
		return _chart;
	}
	_chart.etiquetasEdad = function (e){
		if (!arguments.length) return _etiquetasEdad; _etiquetasEdad=e;
		return _chart;
	}
	_chart.titulo = function (e){
		if (!arguments.length) return _ettitulo; _ettitulo=e;
		return _chart;
	}
	_chart.datosh = function (dts){  
		if(!arguments.length) return _datosh; _datosh=dts;
		return _chart;
	}
	_chart.datosm = function (dts){  
		if(!arguments.length) return _datosm; _datosm=dts;
		return _chart;
	}
	_chart.datosm = function (dts){  
		if(!arguments.length) return _datosm; _datosm=dts;
		return _chart;
	}
	function xInicio()
	{
		return _margenes.izquierda;
	}
	function xFin()
	{
		return _margenes.derecha;
	}
	function yInicio()
	{
		return _margenes.arriba;
	}
	function yFin()
	{
		return _margenes.abajo;
	}
	_chart.render = function () {
		if (!_svg){
			_svg = d3.select("body").select("#contenedor-chart")
					.append("svg")
					.attr("width",_ancho)
					.attr("height",_alto);
			defineVentana(_svg);
		}
		renderBodyChart(_svg);
	}
	function defineVentana(svg)
	{
		svg.append("defs")
			.append("clipPath")
			.attr("id","ventana")
			.append("rect")
			.attr("x",0)
			.attr("y",0)
			.attr("width",_ancho-_margenes.izquierda-_margenes.derecha)
			.attr("height",_alto-_margenes.arriba-_margenes.abajo);
	}
	function renderBodyChart(svg)
	{
		if (!_bodyG)
		{
			_bodyG = svg.append("g")
						//.style("fill-opacity",0.8)
						.attr("class","body")
						.attr("transform","translate("+xInicio()+","+yInicio()+")")
						.attr("clip-path","url(#ventana)");
		}
		renderBarrasDist();
	}
	function renderBarrasDist()
	{
		var valX,valXant;
		var numresp=0;
		for (var i in _respuestas)
		{
			numresp++
		}
		for (var i=0;i<_datosh.length;i++)
		{
			var valX=0,valXant=0,xini=_ancho/2-54;
			for (var j=0;j<numresp;j++)
			{
				valX=_datosh[i][j];
				_bodyG.append("rect")
					.attr("fill",_colores[j+1])
					.attr("x",xini-_x(valX))
					.attr("y",60+25*numresp+25*i)
					.attr("width",_x(valX))
					.attr("height",20);
				xini=xini-_x(valX);
			}
		}
		for (var i=0;i<_datosm.length;i++)
		{
			valX=0;
			for (var j=0;j<numresp;j++)
			{
				_bodyG.append("rect")
					.attr("fill",_colores[j+1])
					.attr("x",_ancho/2+_x(valX)-12)
					.attr("y",60+25*numresp+25*i)
					.attr("width",_x(_datosm[i][j]))
					.attr("height",20);
				valX=valX+_datosm[i][j];
			}
		}
		//*/
		etiquetar()
	}
	function etiquetar()
	{
		var valY=0;
		var numresp=0;
		for (var i in _respuestas)
		{
			numresp++
		}
		_bodyG.append("text")
			.attr("class","titulo")
			.attr("font-size","1em")
			.attr("x",0)
			.attr("y",20)
			.text(_ettitulo);
		_bodyG.append("text")
			.attr("class","titulo")
			.attr("font-size","1em")
			.attr("text-anchor","middle")
			.attr("x",_ancho/2-100)
			.attr("y",valY=50+25*numresp)
			.text("hombre");
		_bodyG.append("text")
			.attr("class","titulo")
			.attr("font-size","1em")
			.attr("text-anchor","middle")
			.attr("x",_ancho/2-33)
			.attr("y",valY=50+25*numresp)
			.text("Edad");
		_bodyG.append("text")
			.attr("class","titulo")
			.attr("font-size","1em")
			.attr("text-anchor","middle")
			.attr("x",_ancho/2+30)
			.attr("y",valY=50+25*numresp)
			.text("mujer");
		_bodyG.selectAll("rect.indicador")
			.data(_respuestas)
			.enter()
			.append("rect")
			.attr("class","indicador")
			.attr("x",0)
			.attr("y",function (d,i){
				return 30+22*i;
			})
			.attr("width",20)
			.attr("height",20)
			.style("fill",function (d,i){
				return _colores[i+1];
			});
		_bodyG.selectAll("text.resp")
			.data(_respuestas)
			.enter()
			.append("text")
			.attr("class","resp")
			.attr("x",25)
			.attr("y",function (d,i){
				return 45+22*i;
			})
			.text(function (d){
				return d.r;
			});
		for (var i=0;i<=9;i++)
		{
			valY=75+25*numresp+25*i;
			_bodyG.append("text")
			.attr("class","nombre")
			.attr("font-size","1em")
			.attr("text-anchor","middle")
			.attr("x",_ancho/2-33)
			.attr("y",valY)
			.text(_etiquetasEdad(i));
		}
	}
	//-------------------------
	return _chart;
}
function bubbleChart ()
{
	//----------------atributos
	var _chart={};
	var _datos=[],
		_ancho=800, _alto=500,
		_margenes={arriba:20,derecha:30,abajo:20,izquierda:30},
		_x,_y,_r,
		_mapa,
		_colores,
		_uncolor,
		_etiqueta,
		_svg,
		_bodyG;
	//----------------set,get atributos del objeto chart
	_chart.ancho= function (a){
		if(!arguments.length) return _ancho; _ancho=a;
		return _chart;
	}
	_chart.alto = function (h){
		if(!arguments.length) return _alto; _alto=h;
		return _chart;
	}
	_chart.margenes = function (m){
		if (!arguments.length) return _margenes; _margenes=m;
		return _chart;
	}
	_chart.mapa= function (mp){
		if(!arguments.length) return _mapa; _mapa=mp;
		return _chart;
	}
	_chart.colores = function (c) {
		if (!arguments.length) return _colores; _colores=c;
		return _chart;
	}
	_chart.uncolor= function (uc){
		if (!arguments.length) return _uncolor; _uncolor=uc;
		return _chart;
	}
	_chart.x = function (x){
		if(!arguments.length) return _x; _x=x;
		return _chart;
	}
	_chart.y = function (y){
		if(!arguments.length) return _y; _y=y;
		return _chart;
	}
	_chart.r = function (r){
		if(!arguments.length) return _r; _r=r;
		return _chart;
	}
	_chart.datos = function (dts){  
		_datos.push(dts);
		return _chart;
	}
	_chart.etiqueta = function (e){
		if (!arguments.length) return _etiqueta; _etiqueta=e;
		return _chart;
	}
	//------------------ metodos del objeto chart
	_chart.render = function () {
		if (!_svg){
			_svg = d3.select("body").select("#contenedor-chart")
					.append("svg")
					.style("background-image","url('"+_mapa+"')")
					.style("background-repeat","no-repeat")
					.attr("width",_ancho)
					.attr("height",_alto);
			defineVentana(_svg);
		}
		renderBodyChart(_svg);
	}
	//-------------------- funciones internas de clase
	function defineVentana(svg)
	{
		svg.append("defs")
			.append("clipPath")
			.attr("id","ventana")
			.append("rect")
			.attr("x",0)
			.attr("y",0)
			.attr("width",_ancho-_margenes.izquierda-_margenes.derecha)
			.attr("height",_alto-_margenes.arriba-_margenes.abajo);
	}
	function renderBodyChart(svg)
	{
		if (!_bodyG)
		{
			_bodyG = svg.append("g")
						.style("fill-opacity",0.8)
						.attr("class","body")
						.attr("transform","translate("+xInicio()+","+yInicio()+")")
						.attr("clip-path","url(#ventana)");
		}
		renderBubbles();
	}
	function xInicio()
	{
		return _margenes.izquierda;
	}
	function xFin()
	{
		return _margenes.derecha;
	}
	function yInicio()
	{
		return _margenes.arriba;
	}
	function yFin()
	{
		return _margenes.abajo;
	}
	function renderBubbles()
	{
		_datos.forEach(function (d,i){
			_bodyG.selectAll("circle")
					.data(d)
					.enter()
					.append("circle")
					.attr("class","bubble")
					.style("stroke",_uncolor)
					.style("fill",_uncolor);
			_bodyG.selectAll("circle")
					.data(d)
					.transition().duration(3000)
					.attr("cx",function (d){
					return _x(d.x);
					})
					.attr("cy",function (d){
						return _y(d.y);
					})
					.attr("r",function (d){
						return _r(d.r);
					});
			d3.select("svg").append("text")
							.style("outline","3px solid "+_uncolor)
							.attr("class","etiqueta")
							.attr("font-size","1.2em")
							.attr("font-family","Courier New")
							.attr("x",20)
							.attr("y",30)
							.text(_etiqueta);
			d3.select("svg").selectAll("text.nombre")
							.data(d)
							.enter()
							.append("text")
							.attr("class","nombre")
							.attr("font-size","1em")
							.attr("x",500)
							.attr("y",function (d,i){
								return (100+20*i);
							})
							.text(function (d){
								return d.u+":  "+d.v;
							});
		});
		
		
	}
	
	//-------------------- objeto _chart
	return _chart;
}

function multiBubbleChart()
{
	//----------------atributos
	var _chart={};
	var _datos=[],
		_ancho=800, _alto=500,
		_margenes={arriba:20,derecha:30,abajo:20,izquierda:30},
		_x,_y,_r,
		_mapa,
		_colores,
		_uncolor,
		_etiquetaTit,
		_etiqueta=[],
		_svg,
		_bodyG;
	//----------------set,get atributos del objeto chart
	_chart.ancho= function (a){
		if(!arguments.length) return _ancho; _ancho=a;
		return _chart;
	}
	_chart.alto = function (h){
		if(!arguments.length) return _alto; _alto=h;
		return _chart;
	}
	_chart.margenes = function (m){
		if (!arguments.length) return _margenes; _margenes=m;
		return _chart;
	}
	_chart.mapa= function (mp){
		if(!arguments.length) return _mapa; _mapa=mp;
		return _chart;
	}
	_chart.colores = function (c) {
		if (!arguments.length) return _colores; _colores=c;
		return _chart;
	}
	_chart.uncolor= function (uc){
		if (!arguments.length) return _uncolor; _uncolor=uc;
		return _chart;
	}
	_chart.x = function (x){
		if(!arguments.length) return _x; _x=x;
		return _chart;
	}
	_chart.y = function (y){
		if(!arguments.length) return _y; _y=y;
		return _chart;
	}
	_chart.r = function (r){
		if(!arguments.length) return _r; _r=r;
		return _chart;
	}
	_chart.datos = function (dts){  
		if(!arguments.length) return _datos; _datos=dts;
		//_datos.push(dts);
		return _chart;
	}
	_chart.etiqueta = function (e){
		if (!arguments.length) return _etiqueta; _etiqueta=e;
		return _chart;
	}
	_chart.etiquetaTit = function (et){
		if (!arguments.length) return _etiquetaTit; _etiquetaTit=et;
		return _chart;
	}
	//------------------ metodos del objeto chart
	_chart.render = function () {
		if (!_svg){
			_svg = d3.select("body").select("#contenedor-chart")
					.append("svg")
					.style("background-image","url('"+_mapa+"')")
					.style("background-repeat","no-repeat")
					.attr("width",_ancho)
					.attr("height",_alto);
			defineVentana(_svg);
		}
		renderBodyChart(_svg);
	}
	_chart.ponerEtiquetas = function (){//--------------------etiquetas indicadores
		d3.select("svg").append("text")
							.style("outline","3px solid "+_uncolor)
							.attr("class","etiqueta")
							.attr("font-size","1.2em")
							.attr("font-family","Courier New")
							.attr("x",20)
							.attr("y",30)
							.text(_etiquetaTit);
		d3.select("svg").selectAll("text.nombre")
							.data(_etiqueta)
							.enter()
							.append("text")
							.attr("class","nombre")
							.attr("font-family","Courier New")
							.attr("font-size","1em")
							.attr("x",370)
							.attr("y",function (d,i){
								return (50+20*i);
							})
							.text(function (d){
								return d.nt;
							});//*/
		d3.select("svg").selectAll("rect.indicador")
							.data(_etiqueta)
							.enter()
							.append("rect")
							.attr("class","indicador")
							.style("fill",function (d,i){
								return _colores[i];
							})
							.attr("x",365)
							.attr("y",function (d,i){
								return (37+20*i);
							})
							.attr("width",5)
							.attr("height",16);
	}
	//-------------------- funciones internas de clase
	function defineVentana(svg)
	{
		svg.append("defs")
			.append("clipPath")
			.attr("id","ventana")
			.append("rect")
			.attr("x",0)
			.attr("y",0)
			.attr("width",_ancho-_margenes.izquierda-_margenes.derecha)
			.attr("height",_alto-_margenes.arriba-_margenes.abajo);
	}
	function renderBodyChart(svg)
	{
		if (!_bodyG)
		{
			_bodyG = svg.append("g")
						.style("fill-opacity",0.8)
						.attr("class","body")
						.attr("transform","translate("+xInicio()+","+yInicio()+")")
						.attr("clip-path","url(#ventana)");
		}
		renderBubbles();
	}
	function xInicio()
	{
		return _margenes.izquierda;
	}
	function xFin()
	{
		return _margenes.derecha;
	}
	function yInicio()
	{
		return _margenes.arriba;
	}
	function yFin()
	{
		return _margenes.abajo;
	}
	function renderBubbles()
	{
		var numtemas=_datos.length;
		for (var k=0;k<numtemas;k++)
		{
			_bodyG.append("g")
				.style("stroke",_colores[k])
				.style("fill",_colores[k])
				.style("fill-opacity",0.7)
				.attr("class","bubble")
				.selectAll("circle")
				.data(_datos[k])
				.enter()
				.append("circle")
				.attr("cx",function (d,i){
					return _x(d.x);
				})
				.attr("cy", function (d,i){
					return _y(d.y);
				})
				.attr("r",function (d,i){
					return _r(d.rdio);
				});
		}
	}
	//-------------------- objeto _chart
	return _chart;
}
//-------------------------------------------------------- barrasChart
//-------------------------------------------------
//------------------------------------------
function opcionElegida(dir)
{
	var idd=document.getElementById("iddepartamento").value;
	//renderBarras(dir,idd)
}
function renderBarras(MC,MT,MST)
{
	d3.selectAll("svg").remove();
	var barrasChart = barChart()
		.x(d3.scaleLinear([0,750]).domain([0,100]))
		.y(d3.scaleLinear([50,700]).domain([0,100]))
		.colores(d3.scaleOrdinal(["#93C90F","#EF9600","#00A3E1","#7c5295"]).domain([0,1,2,3]));
	barrasChart.datos(MC);
	barrasChart.datos1(MT);
	barrasChart.datos2(MST);
	barrasChart.render();//*/
}
function barChart ()
{
	//----------------atributos
	var _chart={};
	var _datos=[],_datos1=[],_datos2=[],
		_ancho=800, _alto=600, _barrasIni=20,
		_margenes={arriba:20,derecha:20,abajo:20,izquierda:20},
		_x, _y, _nivel,
		_colores,
		_uncolor,
		_etiqueta,
		_svg,
		_bodyG;
	//-------------------- objeto _chart
	_chart.ancho = function (a){
		if(!arguments.length) return _ancho; _ancho=a;
		return _chart;
	}
	_chart.alto = function (h){
		if(!arguments.length) return _alto; _alto=h;
		return _chart;
	}
	_chart.margenes = function (m){
		if(!arguments.length) return _margenes; _margenes=m;
		return _chart;
	}
	_chart.x = function (x){
		if(!arguments.length) return _x; _x=x;
		return _chart;
	}
	_chart.y = function (y){
		if(!arguments.length) return _y; _y=y;
		return _chart;
	}
	_chart.colores = function (c){
		if(!arguments.length) return _colores; _colores=c;
		return _chart;
	}
	_chart.uncolor = function (uc){
		if(!arguments.length) return _uncolor; _uncolor=uc;
		return _chart;
	}
	_chart.etiqueta = function (e){
		if (!arguments.length) return _etiqueta; _etiqueta=e;
		return _chart;
	}
	_chart.datos = function (dts){  
		if(!arguments.length) return _datos; _datos=dts;
		//_datos.push(dts);
		return _chart;
	}
	_chart.datos1 = function (dts){  
		if(!arguments.length) return _datos1; _datos1=dts;
		//_datos.push(dts);
		return _chart;
	}
	_chart.datos2 = function (dts){  
		if(!arguments.length) return _datos2; _datos2=dts;
		//_datos.push(dts);
		return _chart;
	}
	//---------------------- metodo objeto chart
	_chart.render = function () {
		if (!_svg){
			_svg = d3.select("body").select("#contenedor-chart")
					.append("svg")
					.attr("width",_ancho)
					.attr("height",_alto);
			defineVentana(_svg);
		}
		renderBodyChart(_svg);
	}
	//-------------------- funciones internas de clase
	function defineVentana(svg)
	{
		svg.append("defs")
			.append("clipPath")
			.attr("id","ventana")
			.append("rect")
			.attr("x",0)
			.attr("y",0)
			.attr("width",_ancho-_margenes.izquierda-_margenes.derecha)
			.attr("height",_alto-_margenes.arriba-_margenes.abajo);
	}
	function renderBodyChart(svg)
	{
		if (!_bodyG)
		{
			_bodyG = svg.append("g")
						.attr("class","body")
						.attr("transform","translate("+xInicio()+","+yInicio()+")")
						.attr("clip-path","url(#ventana)");
		}
		renderBars();
	}
	function xInicio()
	{
		return _margenes.izquierda;
	}
	function xFin()
	{
		return _margenes.derecha;
	}
	function yInicio()
	{
		return _margenes.arriba;
	}
	function yFin()
	{
		return _margenes.abajo;
	}
	function renderBars()
	{
		_nivel=1;
		_bodyG.append("rect")
				.attr("class","fondo")
				.attr("fill","none")
				.attr("pointer-events","all")
				.attr("width",_ancho)
				.attr("height",_alto)
				.attr("cursor","pointer")
				.on("click",(event,d) => sube(_nivel));
		barrasCuest();
	}
	function sube(n)
	{
		if (n==1) 
		{
			console.log("no seube");
		}
		else 
		{
			_nivel=1;
			_bodyG.selectAll("rect.selector")
				.remove()
			_bodyG.selectAll("rect.tema")
				.remove()
			_bodyG.selectAll("rect.subtema")
				.remove()
			_bodyG.selectAll(".etiqueta")
				.remove()
			barrasCuest();
		}
	}
	function barrasCuest()
	{
		_bodyG.selectAll("rect.selector")
			.remove()
		_bodyG.selectAll("rect.tema")
			.remove()
		_bodyG.selectAll(".etiqueta")
			.remove()
	
		_bodyG.selectAll("rect.selector")
			.data(_datos)
			.enter()
			.append("rect")
			.attr("class","selector")
			.attr("fill",function (d,i){
					return _colores(i);
				})
			.attr("x",0)
			.attr("y",function (d,i){
				return (_barrasIni+i*25);
			})
			.attr("height",20)
			.attr("width",15)
			.attr("pointer-events", "all")
			.attr("cursor","pointer")
			.on("click",(event,d)=>bajaTemas(d,_nivel+1));
		_bodyG.selectAll("rect.cuest")
			.data(_datos)
			.enter()
			.append("rect")
			.attr("class","cuest")
			.attr("fill",function (d,i){
					return _colores(i);
				})
			.attr("x",20)
			.attr("y",function (d,i){
				return (_barrasIni+i*25);
			})
			.attr("height",20)
			.transition().duration(3000)
			.attr("width",function (d,i){
				return _x(d.v);
			});
		ponerEtiquetas(_datos);
	}
	function bajaTemas(dt,n)
	{
		_bodyG.select(".titulo")
			.remove();
		_nivel=n;
		_bodyG.selectAll(".etiqueta")
			.remove();
		_bodyG.selectAll(".selector")
			.remove();
		_bodyG.selectAll(".cuest")
			.filter(function (d,i){
				return d.id != dt.id;
			})
			.remove();
		_bodyG.selectAll(".cuest")
			.transition().duration(2000)
			.on("end",function (d,i){
				barrasTema(d.id);
				return "";
			})
			.attr("x",0)
			.attr("y",_barrasIni)
			.attr("width",15)
			.attr("height",function (d){
				return (d.nt*20+d.nt*5);
			});
	}
	function barrasTema(ident)
	{
		_bodyG.select(".cuest")
			.remove();
		_bodyG.selectAll("rect.selector")
			.data(_datos1[ident-1])
			.enter()
			.append("rect")
			.attr("class","selector")
			.attr("fill",_colores(ident-1))
			.attr("pointer-events", "all")
			.attr("cursor","pointer")
			.on("click",(event,d)=>bajaSubTemas(d,_nivel+1,_colores(ident-1)))
			.attr("x",0)
			.attr("y",function (d,i){
				return (_barrasIni+i*25);
			})
			.attr("height",20)
			.attr("width",15)
			.transition().duration(2000)
			.attr("x",0)
			.attr("y",function (d,i){
				return (_barrasIni+i*25);
			})
			.attr("height",20)
			.attr("width",15)
		_bodyG.selectAll("rect.tema")
			.data(_datos1[ident-1])
			.enter()
			.append("rect")
			.attr("class","tema")
			.attr("fill",_colores(ident-1))
			.attr("x",20)
			.attr("y",function (d,i){
				return (_barrasIni+i*25);
			})
			.attr("height",20)
			.transition().duration(3000)
			//.delay(2000)
			.attr("width",function (d){
				return _x(d.v);
			});
		ponerEtiquetas(_datos1[ident-1]);
	}
	function bajaSubTemas(dt,n,tcolor)
	{
		_bodyG.select(".titulo")
			.remove();
		_nivel=n;
		_bodyG.selectAll(".etiqueta")
			.remove();
		_bodyG.selectAll(".selector")
			.remove();
		_bodyG.selectAll(".tema")
			.filter(function (d,i){
				return (d.idt!=dt.idt);
			})
			.remove();
		_bodyG.selectAll(".tema")
			.transition().duration(2000)
			.on("end",function (d,i){
				barrasSubTemas(d.idt,tcolor);
				return "";
			})
			.attr("x",0)
			.attr("y",_barrasIni)
			.attr("width",15)
			.attr("height",function (d){
				return (d.cst*20+d.cst*5);
			});
	}
	function barrasSubTemas(idt,barcolor)
	{
		_bodyG.select(".tema")
			.remove();
		_bodyG.selectAll("rect.selector")
			.data(_datos2[idt-1])
			.enter()
			.append("rect")
			.attr("class","selector")
			.attr("fill",barcolor)
			.attr("x",0)
			.attr("y",function (d,i){
				return (_barrasIni+i*25);
			})
			.attr("height",20)
			.attr("width",15)
			.transition().duration(2000)
			.attr("x",0)
			.attr("y",function (d,i){
				return (_barrasIni+i*25);
			})
			.attr("height",20)
			.attr("width",15)
		_bodyG.selectAll("rect.subtema")
			.data(_datos2[idt-1])
			.enter()
			.append("rect")
			.attr("class","subtema")
			.attr("fill",barcolor)
			.attr("x",20)
			.attr("y",function (d,i){
				return (_barrasIni+i*25);
			})
			.attr("height",20)
			.transition().duration(3000)
			//.delay(2000)
			.attr("width",function (d){
				return _x(d.v);
			});
		ponerEtiquetas(_datos2[idt-1]);
	}
	function ponerEtiquetas(dte)
	{
		_bodyG.select(".titulo")
			.remove();
		if (_nivel==1)
		{
			_etiqueta="Cuestionarios";
		}
		else if(_nivel==2)
		{
			_etiqueta="Temas";
		}
		else 
		{
			_etiqueta="SubTemas";
		}
		_bodyG.append("text")
			.attr("class","titulo")
			.attr("font-size","1em")
			.attr("font-family","Courier New")
			.attr("x",_ancho/2-70)
			.attr("y",12)
			.text(_etiqueta);
		_bodyG.selectAll("text.etiqueta")
				.data(dte)
				.enter()
				.append("text")
				.attr("class","etiqueta")
				.attr("font-size","1em")
				.attr("x",20)
				.attr("y",function (d,i){
					return (_barrasIni+15+25*i);
				})
				.text(function (d){
					return d.c+":  "+d.n;
				});
	}
	//--------------------------------- objeto
	return _chart;
}
//-------------------------------------------------------- cuerdasChart
//-------------------------------------------------
//------------------------------------------
function renderCuerdas(Mtrx,et)
{
	/*var M = [[0,0,0,10,0,0],
			 [0,0,0,0,15,0],
			 [0,0,0,0,0,20],
			 [12,0,0,0,0,0],
			 [0,4,0,0,0,0],
			 [0,0,6,0,0,0]];*/
	var dts=Object.assign(Mtrx,
						{n:["RE-Inicial","ID-Inicial","CE-Inicial","RE-Final","ID-Final","CE-Final"],
						c:["#33C90F","#CC450F","#33A7F4","#33C90F","#CC450F","#33A7F4"]});
	var noms = dts.n === undefined ? d3.range(dts.length) : dts.n;
	var clrs = dts.c === undefined ? d3.quantize(d3.interpolateRainbow,nombres.length) : dts.c;
	//colr=d3.scaleOrdinal(clrs).domain(nombres);
	var cChart = cuerdasChart();
		cChart.datosCuerdas(dts);
		cChart.colores(clrs);
		cChart.nombres(noms);
		cChart.etiqueta(et);
		cChart.render();
}
function cuerdasChart()
{
	var _chart={};
	var _datosCuerdas,
		_ancho=800, _alto=600,
		_margenes={arriba:20,derecha:20,abajo:20,izquierda:20},
		_ri,_rx,
		_nombres=[],
		_colores=[],
		_cintas,
		_arcos,
		_cuerdas,
		_uncolor,
		_etiqueta,
		_svg,
		_bodyG;
		
	_chart.ancho = function (a){
		if(!arguments.length) return _ancho; _ancho=a;
		return _chart;
	}
	_chart.alto = function (h){
		if(!arguments.length) return _alto; _alto=h;
		return _chart;
	}
	_chart.margenes = function (m){
		if(!arguments.length) return _margenes; _margenes=m;
		return _chart;
	}
	_chart.colores = function (c){
		if(!arguments.length) return _colores; _colores=c;
		return _chart;
	}
	_chart.uncolor = function (uc){
		if(!arguments.length) return _uncolor; _uncolor=uc;
		return _chart;
	}
	_chart.ri = function (r){
		if(!arguments.length) return _ri; _ri=r;
		return _chart;
	}
	_chart.re = function (r){
		if(!arguments.length) return _re; _re=r;
		return _chart;
	}
	_chart.etiqueta = function (e){
		if (!arguments.length) return _etiqueta; _etiqueta=e;
		return _chart;
	}
	_chart.datosCuerdas = function (m){  
		if(!arguments.length) return _datosCuerdas; _datosCuerdas=m;
		//_datos.push(dts);
		return _chart;
	}
	_chart.cuerdas = function (c){  
		if(!arguments.length) return _cuerdas; _cuerdas=c;
		//_datos.push(dts);
		return _chart;
	}
	_chart.nombres = function (n){  
		if(!arguments.length) return _nombres; _nombres=n;
		//_nombres.push();
		return _chart;
	}
	_chart.render = function () {
		if (!_svg){
			_svg = d3.select("body").select("#contenedor-chart")
					.append("svg")
					.attr("width",_ancho)
					.attr("height",_alto);
			defineVentana(_svg);
		}
		renderBodyChart(_svg);
	}
	//-------------------- funciones internas de clase
	function defineVentana(svg)
	{
		svg.append("defs")
			.append("clipPath")
			.attr("id","ventana")
			.append("rect")
			.attr("x",0)
			.attr("y",0)
			.attr("width",_ancho-_margenes.izquierda-_margenes.derecha)
			.attr("height",_alto-_margenes.arriba-_margenes.abajo);
	}
	function renderBodyChart(svg)
	{
		if (!_bodyG)
		{
			_bodyG = svg.append("g")
						.attr("class","body")
						.attr("transform","translate("+xInicio()+","+yInicio()+")")
						.attr("clip-path","url(#ventana)");
		}
		renderChords();
	}
	function xInicio()
	{
		return _margenes.izquierda;
	}
	function xFin()
	{
		return _margenes.derecha;
	}
	function yInicio()
	{
		return _margenes.arriba-_margenes.abajo;
	}
	function yFin()
	{
		return _margenes.abajo;
	}
	
	//-------------------------------------- Chord
	function renderChords()
	{
		var mapNomColor=d3.scaleOrdinal(_nombres,_colores);
		_re=Math.min((_ancho-100)/2,(_alto-100)/2);
		_ri= _re-10;
		//------------------ funciones grafico
		cints = d3.ribbon() //-------------- f()
					.radius(_ri-1)
					.padAngle(1/_ri);
		arcs = d3.arc()  //--------------f()
					.innerRadius(_ri)
					.outerRadius(_re);
		chrd = d3.chord()  //-------------- f(c)
					.padAngle(10/_ri)
					.sortSubgroups(d3.descending)
					.sortChords(d3.descending);
		_cuerdas = chrd(_datosCuerdas);
		console.log(_cuerdas.groups);
		const grupo = _bodyG.append("g")
						.attr("transform", "translate(" + (_ancho / 2+50) + "," + (_alto / 2) + ")")
						.attr("class","grupo")
						.selectAll(".grupo")
						.data(_cuerdas.groups)
						.join("g")
						.append("path")
						.attr("fill",d=>mapNomColor(_nombres[d.index]))
						.attr("d",arcs);
		_bodyG.append("g")
						.attr("transform", "translate(" + (_ancho / 2+50) + "," + (_alto / 2) + ")")
						.attr("class","etiq")
						.selectAll(".etiq")
						.data(_cuerdas.groups)
						.join("g")
						.append("text")
						.style("font-family","bold")
						.text(function (d,i){
							return (_nombres[i]+":"+d.value);
						})
						.attr("transform",function (d){
							return "translate ("+arcs.centroid(d)+"), rotate("+angulo(d)+")";
						})
						.style("text-anchor","middle");
			
		_bodyG.append("g")
			.attr("transform", "translate(" + (_ancho / 2+50) + "," + _alto / 2 + ")")
			.attr("fill-opacity",0.7)
			.selectAll("path")
			.data(_cuerdas)
			.join("path")
			.style("mix-blend-mode","multiply")
			.attr("fill",d=>mapNomColor(_nombres[d.source.index]))
			.attr("d",cints);
			
		etiquetarCuerdas();
	}
	function angulo(d)
	{
		var a = (d.startAngle + d.endAngle)*90/Math.PI - 90;
		return a > 90 ? a-180:a;
	}
	function etiquetarCuerdas()
	{
		_bodyG.attr("class","titulo")
				.append("text")
				.attr("font-size","1.5em")
				.attr("x",200)
				.attr("y",25)
				.text(_etiqueta)
				.style("text-anchor","middle");
		_bodyG.append("circle")
				.attr("cx",8)
				.attr("cy",50)
				.attr("r",8)
				.style("fill","#33C90F");
		
		_bodyG.append("circle")
				.attr("cx",8)
				.attr("cy",80)
				.attr("r",8)
				.style("fill","#CC450F");
		
		_bodyG.append("circle")
				.attr("cx",8)
				.attr("cy",110)
				.attr("r",8)
				.style("fill","#33A7F4");
				
		_bodyG.attr("class","titulo")
				.append("text")
				.attr("x",16)
				.attr("y",55)
				.text("Reforma Electoral (RE)");
				
		_bodyG.attr("class","titulo")
				.append("text")
				.attr("x",16)
				.attr("y",85)
				.text("Institucionalidad Democratica (ID)");
		_bodyG.attr("class","titulo")
				.append("text")
				.attr("x",16)
				.attr("y",115)
				.text("Censo (CE)");
	}
	//------------------------
	return _chart;
}



//Definir el objeto fechas
function Datos(){
	this.fecha_inicio = '';
	this.fecha_fin = '';
	this.idactor = '';
	this.nombre_actor = '';
}

//Transmision de datos
//Funcion para extraer actores
function graficaractorescuerda(datos) {
	var idactor = datos.idactor;
	var nombre_actor = datos.nombre_actor;
	$.ajax({
		url: baseurl + "/graficos/getmatrizactor",
		type: 'post',
		data: {datos: JSON.stringify(datos) },
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Esperar..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito matriz de adyacencia actores");
			console.log("idactor:");
			console.log(idactor);
			console.log(json);
			//Aqui va la rutina para grafica
			//La variable json es la matriz
			//renderCuerdas(Mtrx);
			renderCuerdas(json,nombre_actor);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

}


/** Rutina para Generar datos y grafica de cuerdas ***/
jQuery(document).on('click', '#graficar', function (e) {
	e.preventDefault();
	var datos_consulta = new Datos();
	console.log("Boton presionado");
	//Capturar el valor del primer input date
	datos_consulta.fecha_inicio = $("input#fecha_inicio").val();
	//Capturar el valor del segundo input date
	datos_consulta.fecha_fin = $("input#fecha_fin").val();
	//Capturar el id dell actor
	datos_consulta.idactor = $('select#idactor').val();
	//Capturar el nombre del actor
	datos_consulta.nombre_actor = $('select#idactor option:selected').text();

	//Validadores
	if(datos_consulta.idactor == 0)
	{
		$('#actorsinseleccionar').modal("show");
	}
	else{
		if(Date.parse(datos_consulta.fecha_inicio) >= Date.parse(datos_consulta.fecha_fin) )
		{
			$('#fechaintervalo').modal("show");
		}
		else{
			console.log(datos_consulta);
			console.log(JSON.stringify(datos_consulta));
			$("#contenedor-chart").empty();
			graficaractorescuerda(datos_consulta)

		}
	}
});


/** Rutina para Generar datos y grafica de barras nacional ***/
jQuery(document).on('click', '#graficarbn', function (e) {
	e.preventDefault();
	var datos_consulta = new Datos();
	console.log("Boton graficar barra nacional presionado");
	//Capturar el valor del primer input date
	datos_consulta.fecha_inicio = $("input#fecha_inicio_bn").val();
	//Capturar el valor del segundo input date
	datos_consulta.fecha_fin = $("input#fecha_fin_bn").val();

	if(Date.parse(datos_consulta.fecha_inicio) >= Date.parse(datos_consulta.fecha_fin) )
	{
		$('#fechaintervalo').modal("show");
	}
	else{
		console.log(datos_consulta);
		console.log(JSON.stringify(datos_consulta));
		$("#contenedor-chart").empty();
		graficarbarras(datos_consulta)

	}
});

//Transmision de datos
//Funcion para extraer actores
function graficarbarras(datos) {
	$.ajax({
		url: baseurl + "/graficos/getmatrizbarras",
		type: 'post',
		data: {datos: JSON.stringify(datos) },
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Esperar..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito matriz para barras jerarquicas");
			//Aqui va la rutina para grafica
			console.log(json);
			var mc = json['mc'];
			var mt = json['mt'];
			var mst = json['mst'];

			console.log(mc);
			console.log(mt);
			console.log(mst);

			renderBarras(mc, mt, mst);


		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

}


//Deteccion de cambio del selector de departamentos
jQuery(document).on('change', 'select#iddepartamentobarra', function (e) {
	e.preventDefault();
	var datos_consulta = new Datos();
	console.log("Departamento seleccionado");
	//Capturar el valor del primer input date
	datos_consulta.fecha_inicio = $("input#fecha_inicio_bd").val();
	//Capturar el valor del segundo input date
	datos_consulta.fecha_fin = $("input#fecha_fin_bd").val();
	datos_consulta.iddepartamento = jQuery(this).val();
	var iddepartamento = jQuery(this).val();

	if(datos_consulta.fecha_inicio == "" || datos_consulta.fecha_inicio == null )
	{
		$('#faltafechasmsg').modal("show");
	}
	if(datos_consulta.fecha_fin == "" || datos_consulta.fecha_fin == null )
	{
		$('#faltafechasmsg').modal("show");
	}


	if(iddepartamento != 0)
	{
		if(Date.parse(datos_consulta.fecha_inicio) >= Date.parse(datos_consulta.fecha_fin) )
		{
			$('#fechaintervalo').modal("show");
		}
		else{
			console.log(datos_consulta);
			console.log(JSON.stringify(datos_consulta));
			$("#contenedor-chart").empty();
			graficarbarrasdepartamentos(datos_consulta)

		}
	}
	else{
		$('#departamentomsg').modal("show");
	}
});

//Transmision de datos
//Funcion para extraer actores
function graficarbarrasdepartamentos(datos) {
	$.ajax({
		url: baseurl + "/graficos/getmatrizbarrasdepartamento",
		type: 'post',
		data: {datos: JSON.stringify(datos) },
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Esperar..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Exito matriz depas para barras jerarquicas");
			//Aqui va la rutina para grafica
			console.log(json);
			var mc = json['mc'];
			var mt = json['mt'];
			var mst = json['mst'];

			console.log(mc);
			console.log(mt);
			console.log(mst);

			renderBarras(mc, mt, mst);


		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

}






























jQuery(function() {
    jQuery('#iduipregunta').change(function() {
        var pregunta = $("#iduipregunta option:selected").val();
        var enc = $('option:selected', this).data('idencuesta');
        var encuesta = enc.toString();
        console.log('En js con encuesta', encuesta, 'y pregunta', pregunta);
        var datos = {
                "idencuesta" : encuesta,
                "idpregunta" : pregunta
        };
        getRespuestasA(datos);
    });
});
//Funcion para extraer respuestas
function getRespuestasA(datos) {
    console.log('Consultando respuestas a pregunta',datos);
	$.ajax({
		url: baseurl + "/Graficos/getRespuestasHM",
		type: 'post',
		data: {datos: JSON.stringify(datos) },
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Consulta a pregunta, OK");
//			console.log(json);
            renderDistribucionChart(json);
		},
		error: function (xhr, ajaxOptions, thrownError) {
//			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}


























jQuery(function() {
    jQuery('#iduipreguntasank').change(function() {
        var pregunta = $("#iduipreguntasank option:selected").val();
        var enc = $('option:selected', this).data('idencuesta');
        var encuesta = enc.toString();
        console.log('Llegamos a js');
        var datos = {
                "idencuesta" : encuesta,
                "idpregunta" : pregunta
        };
        getRespuestasSankey(datos);
    });
});
//Funcion para extraer respuestas
function getRespuestasSankey(datos) {
    console.log('Consultas sankey',datos);
	$.ajax({
		url: baseurl + "/Graficos/getRespuestasHMSank",
		type: 'post',
		data: {datos: JSON.stringify(datos) },
		dataType: 'json',
		beforeSend: function () {
			jQuery('select#medio').find("option:eq(0)").html("Please wait..");
		},
		complete: function () {
			// code
		},
		success: function (json) {
			console.log("Consulta Sankey, OK");
//			console.log(json);
            renderSankeyChart(json);
		},
		error: function (xhr, ajaxOptions, thrownError) {
//			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}