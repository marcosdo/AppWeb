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

	$("#correoNO").hide();
	$("#aliasNO").hide();
	$("#tituloNO").hide();
	$("#ejercicioNO").hide();

	$("#mail").change(function(){
		const campo = $("#mail"); 
		campo[0].setCustomValidity(""); 
		const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && correoValido(campo.val())) {
			$('#correoNO').hide();
			campo[0].setCustomValidity("");
		} else {			
			$('#correoNO').show();
			campo[0].setCustomValidity("El correo debe ser válido");
		}
	});

	$("#mailE").change(function(){
		const campo = $("#mailE"); 
		campo[0].setCustomValidity(""); 
		const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && correoValido(campo.val())) {
			$('#correoNO').hide();
			campo[0].setCustomValidity("");
		} else {			
			$('#correoNO').show();
			campo[0].setCustomValidity("El correo debe ser válido");
		}
	});

	function correoValido(correo) {
		var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		return regex.test(correo);
	}

	$("#aliasR").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#aliasR").val();
		$.get(url,usuarioExiste);
    });

	$("#aliasE").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#aliasE").val();
		$.get(url,usuarioExiste);
    });

	$("#password2").change(function(){
		var pass1 = $("#password").val();
		var pass2 = $("#password2").val();
		if(pass1 != pass2) alert("Las password deben ser iguales");
    });

	$("#titulo").change(function(){
		var url = "comprobarNoticia.php?titulo=" + $("#titulo").val();
		$.get(url,noticiaExiste);
    });

	$("#nombreE").change(function(){
		var url = "comprobarEjercicio.php?ejercicio=" + $("#nombreE").val();
		$.get(url,ejercicioExiste);
    });

	function usuarioExiste(data,status) {
		if(status == "success"){
			if(data == "disponible") {
				$('#aliasNO').hide();
			}
			else{			
				$('#aliasNO').show();
				alert(data);
			}
		}
	}

	function noticiaExiste(data,status) {
		if(status == "success"){
			if(data == "disponible") {
				$('#tituloNO').hide();
			}
			else{			
				$('#tituloNO').show();
				alert(data);
			}
		}
	}

	function ejercicioExiste(data,status) {
		if(status == "success"){
			if(data == "disponible") {
				$('ejercicioNO').hide();
			}
			else{			
				$('#ejercicioNO').show();
				alert(data);
			}
		}
	}
	$(".message1 a").click(function () {
		$("#formEditaMensaje").animate({ height: "toggle", opacity: "toggle" }, "slow");
	});
	
	$(".message2 a").click(function () {
		$("#formBorraMensaje").animate({ height: "toggle", opacity: "toggle" }, "slow");
	});
})