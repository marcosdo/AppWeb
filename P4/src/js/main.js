/*
Esta inspirada en: https://davidwalsh.name/highlight-table-columns
*/
window.addEvent('domready',function(){
	var table = document.id('planificacion');
	var rows = table.getElements('tr');
	rows.each(function(tr,trCount){
		tr.getElements('td').each(function(td,tdCount) {
			var column = 'col-' + tdCount;
			var friends = 'td.' + column;
			td.addClass(column);
			td.addEvents({
				'mouseenter': function(){
					$$(friends).erase(td).addClass('column-hover');
					td.addClass('cell-hover');
				},
				'mouseleave': function() {
					$$(friends).erase(td).removeClass('column-hover');
					td.removeClass('cell-hover');
				}
			});
		});
	});
});

$(".message a").click(function () {
	$("form").animate({ height: "toggle", opacity: "toggle" }, "slow");
});

$(document).ready(function() {

	$("#correoOK").hide();
	$("#aliasOK").hide();
	$("#correoNO").hide();
	$("#aliasNO").hide();

	$("#mail").change(function(){
		const campo = $("#mail"); 
		campo[0].setCustomValidity(""); 
		const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && correoValido(campo.val())) {
			$('#correoNO').hide();
			$('#correoOK').show();
			campo[0].setCustomValidity("");
		} else {			
			$('#correoOK').hide();
			$('#correoNO').show();
			campo[0].setCustomValidity("El correo debe ser válido");
		}
	});

	function correoValido(correo) {
		var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		return regex.test(correo);
	}

	$("#alias").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#alias").val();
		$.get(url,usuarioExiste);
    });

	function usuarioExiste(data,status) {
		if(status == "success"){
			if(data == "disponible") {
				$('#aliasNO').hide();
				$('#aliasOK').show();
				alert(data);
			}
			else{			
				$('#aliasOK').hide();
				$('#aliasNO').show();
				alert(data);
			}
		}
	}
})