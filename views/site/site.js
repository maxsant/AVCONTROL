$(document).ready(function(){
	var btnEnviar = $('#btnsubmitemail');
    // Deshabilitar el boton al cargar la pagina
    btnEnviar.prop('disabled', true);
	visualTimer(btnEnviar);
})

$('#submitEmail_form').on("submit", function(e){
	e.preventDefault();
	var formData = new FormData($('#submitEmail_form')[0]);
	
	var camposVacios = false;
	
    formData.forEach(function(value, key) {
        if (value === "") {
            camposVacios = true;
            return false;  // Para salir del bucle si se encuentra un campo vacio
        }
	});
    
    if (camposVacios) {
        swal.fire({
			title: 'Usuario',
			text: 'Campos vacios',
			icon: 'error'
		});
        return false;
    }
    
	var email = formData.get('email');
	
	$.post("../../controllers/EmailController.php?op=emailConfirmed", { email : email}, function(data) {
		data = JSON.parse(data);
		if(data.status){
			$('#submitEmail_form')[0].reset();
			swal.fire({
		        title:"Usuario",
		        text: "El correo ha sido enviado a tu bandeja de entrada. Por favor verificar.",
		        icon: "success",
		        confirmButtonText : "Si",
		        showCancelButton : true,
		        cancelButtonText: "No",
		    }).then((result)=>{
		        if (result.value){
		            var newURL = window.location.href.split('?')[0];
		            window.history.replaceState({}, document.title, newURL);
		            // Recargar la pagina
		            location.reload();
		        }
		    });
		}else{
			swal.fire({
				title: 'Usuario',
				text: data.msg,
				icon: 'error'
			});
			$('#submitEmail_form')[0].reset();
        }
	});
});

function visualTimer(btnEnviar) {
    var tiempoRestante = 15;
    var temporizadorVisual = setInterval(function() {
        btnEnviar.html('Enviando correo (' + tiempoRestante + 's)');
        tiempoRestante--;
        
        if (tiempoRestante < 0) {
            clearInterval(temporizadorVisual);
            btnEnviar.prop('disabled', false);
            btnEnviar.html('Enviar Correo');
        }
    }, 1000);
}