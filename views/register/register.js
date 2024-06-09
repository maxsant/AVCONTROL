$(document).ready(function(){
	
	$.post("../../controllers/IdentificationController.php?op=combo", function(data){
		$('#identification_type_id').html(data);
	});
	$('#register_form')[0].reset();
});

$('#register_form').on("submit", function(e){
	e.preventDefault();
	
	var formData = new FormData($('#register_form')[0]);
	
	var camposVacios = false;
	
	formData.forEach(function(value, key){
		if(value == ''){
			camposVacios = true;
			return false;
		}
	});
	
	if(camposVacios){
		swal.fire({
			title: 'Usuario',
			text: 'Campos vacios',
			icon: 'error'
		});
		return false;
	}
	
	$.ajax({
		url: '../../controllers/UserController.php?op=registerUser',
		type: 'POST',
		data: formData,
		contentType: false,
		processData: false,
		success: function(data){
			data = JSON.parse(data);
			if(data.status){
				$('#register_form')[0].reset();
				$.post('../../controllers/EmailController.php?op=emailConfirmed', {email : data.email}, function(data){
					
				})
				swal.fire({
					title: 'Usuario',
					text: data.msg,
					icon: 'success'
				});
			}else{
				swal.fire({
					title: 'Usuario',
					text: data.msg,
					icon: 'error'
				});
			}
		}
	})
})