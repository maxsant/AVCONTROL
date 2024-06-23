var user_id = $('#user_id').val();

$(document).ready(function(){
	$('#customer_id').select2();
    
    $('#farm_id').select2();
    
    $('#product_id').select2();
    
    $('#payment_id').select2();
    
    $.post("../../controllers/UserController.php?op=combo", function(data){
        $("#customer_id").html(data);
        $("#customer_id").val(user_id).trigger('change');
    });
    
    $.post("../../controllers/FarmController.php?op=combo", function(data){
        $("#farm_id").html(data);
    });
    
    $.post("../../controllers/PaymentController.php?op=combo", function(data){
        $("#payment_id").html(data);
    });
    
    $("#farm_id").change(function(){
        $("#farm_id").each(function(){
            farm_id = $(this).val();
            $.post("../../controllers/FarmController.php?op=viewFarm",{id : farm_id},function(data){
                data = JSON.parse(data);
                $('#farm_name').val(data.name);
                $('#farm_location').val(data.location);
            });
        });
    });
    
    $("#customer_id").change(function(){
        $("#customer_id").each(function(){
            customer_id = $(this).val();
            $.post("../../controllers/UserController.php?op=viewUser",{id : customer_id},function(data){
                data = JSON.parse(data);
                $('#customer_identification').val(data.identification);
                $('#customer_email').val(data.email);
                $('#customer_phone').val(data.phone);
            });
        });
    });
});