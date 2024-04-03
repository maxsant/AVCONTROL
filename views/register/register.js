$(document).ready(function(){
	
	$.post("../../controllers/IdentificationController.php?op=combo", function(data){
		$('#identification_type_id').html(data);
	});
	
});