var user_id = $('#user_id').val();

$(document).on("click", "#btnguardar", function(){
	var password_hash = $('#password_hash').val();
	var password_hash_confirmed = $('#password_hash_confirmed').val();
	var name = $('#name').val();
	var lastname = $('#lastname').val();
	var phone = $('#phone').val();
	
	/* VALIDAR CAMPOS VACIOS */
	if($("#password_hash").val()== '' || $("#password_hash_confirmed").val()== '' || $("#name").val()== '' || $("#lastname").val()== '' || $("#phone").val()== ''){
		Swal.fire({
			title: "Error",
			text: "Campos vacios",
			icon: "error"
		})
	}else{
		/* VALIDAR SI SON IGUALES */
		if(password_hash == password_hash_confirmed){
			$.post('../../controllers/UserController.php?op=updatePerfil', {id : user_id, password_hash : password_hash, name : name, lastname : lastname, phone : phone}, function(data){
				
			});
			
			Swal.fire({
				title: "Registro actualizado",
				text: "Contraseña actualizada",
				icon: "success"
			})
			
			$("#password_hash").val('');
			$("#password_hash_confirmed").val('');
			$("#name").val('');
			$("#lastname").val('');
			$("#phone").val('');
			
		}else{
			Swal.fire({
				title: "Error",
				text: "Las contraseñas son distintas",
				icon: "error"
			})
		}
	}
})