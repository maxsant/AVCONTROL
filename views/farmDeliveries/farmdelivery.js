var user_id = $('#user_id').val();

$(document).ready(function(){
	
	$.post("../../controllers/FarmDeliveriesController.php?op=registerFarmDeliveries", {user_id : user_id}, function(data){
		data = JSON.parse(data);
        $("#farm_delivery_id").val(data.id);
    });

    $('#farm_id').select2();
    
    $('#delivery_id').select2();

    $.post("../../controllers/FarmController.php?op=combo", function(data){
        $("#farm_id").html(data);
    });
    
    $.post("../../controllers/DeliveryController.php?op=combo", function(data){
        $("#delivery_id").html(data);
    });
    
    $.post("../../controllers/PaymentController.php?op=combo", function(data){
        $("#payment_id").html(data);
    });
    
    $("#farm_id").change(function(){
        $("#farm_id").each(function(){
            farm_id = $(this).val();
            $.post("../../controllers/FarmController.php?op=viewFarm",{id : farm_id},function(data){
                data=JSON.parse(data);
                $('#farm_name').val(data.name);
                $('#farm_location').val(data.location);
            });
        });
    });
    
    $("#delivery_id").change(function(){
        $("#delivery_id").each(function(){
            delivery_id = $(this).val();
            $.post("../../controllers/DeliveryController.php?op=viewDelivery",{id : delivery_id},function(data){
                data = JSON.parse(data);
                if(data.delivery_type_id){
	                $.post('../../controllers/DeliveryTypeController.php?op=viewDeliveryType', {id : data.delivery_type_id}, function(data2){
						data2 = JSON.parse(data2);
						$('#delivery_type').val(data2.name);
					})
				}else{
					$('#delivery_type').val('');
				}
                $('#farm_delivery_detail_price').val(data.price);
                $('#delivery_stock').val(data.stock);
            });
        });
    });
});

$(document).on("click","#btnagregar",function(){
    var farm_delivery_id = $('#farm_delivery_id').val();
    var delivery_id = $('#delivery_id').val();
    var farm_delivery_detail_price = $('#farm_delivery_detail_price').val();
    var farm_delivery_detail_stock = $('#farm_delivery_detail_stock').val();
    
    if($("#delivery_id").val()== '' || $("#farm_delivery_detail_price").val()== '0' || $("#farm_delivery_detail_price").val()== '' || $("#farm_delivery_detail_stock").val()== '0' || $("#farm_delivery_detail_stock").val()== '' ){
		swal.fire({
            title:'Compra de Suministro',
            text: 'Error Campos Vacios y/o incongruentes',
            icon: 'error'
        });
    }else{
		$.post("../../controllers/FarmDeliveriesController.php?op=saveFarmDeliveryDetail",{
			farm_delivery_id : farm_delivery_id,
			delivery_id : delivery_id,
			farm_delivery_detail_price : farm_delivery_detail_price,
			farm_delivery_detail_stock : farm_delivery_detail_stock
		},function(data){
        });
        
        $('#farm_delivery_detail_price').val('');
    	$('#farm_delivery_detail_stock').val('');
	}
});

$(document).on("click","#btnlimpiar",function(){
    location.reload();
});