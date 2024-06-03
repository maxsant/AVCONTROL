var user_id = $('#user_id').val();

$(document).ready(function(){
    
    $.post("../../controllers/FarmProductionController.php?op=registerFarmProduction", {user_id : user_id}, function(data){
		data = JSON.parse(data);
        $("#farm_production_id").val(data.id);
    });
    
    $('#farm_id').select2();
    
    $.post("../../controllers/FarmController.php?op=combo", function(data){
        $("#farm_id").html(data);
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
    
    $('#type_production').change(function() {
        var typeProductionValue = $(this).val();
        
        if (typeProductionValue == 1) {
			$.post("../../controllers/ProductionController.php?op=type_production", {type : typeProductionValue}, function(data){
		        $("#chicken_egg_production_type").html(data);
		    });
            // Desbloquear ciertos campos
            $('#chicken_egg_production_type').prop('disabled', false).show();
            $('#chicken_egg_production_price').prop('disabled', false).show();
            $('#chicken_egg_status').prop('disabled', false).show();
            $('#chicken_egg_production_date').prop('disabled', false).show();
            // Ocultar otros campos
            $('#third_party_type').prop('disabled', true).show();
            $('#third_party_price').prop('disabled', true).show();
            $('#third_party_stock').prop('disabled', true).show();
            $('#third_party_type').val('0').trigger('change');
            $('#third_party_price').val('');
            $('#third_party_stock').val('');
            
            $('#chicken_type').prop('disabled', true).show();
            $('#chicken_price').prop('disabled', true).show();
            $('#chicken_stock').prop('disabled', true).show();
            $('#chicken_birthdate').prop('disabled', true).show();
            $('#chicken_weihg').prop('disabled', true).show();
            $('#chicken_condition').prop('disabled', true).show();
            $('#chicken_type').val('0').trigger('change'); 
            $('#chicken_price').val('');
            $('#chicken_stock').val('');
            $('#chicken_birthdate').val('');
            $('#chicken_weihg').val('');
            $('#chicken_condition').val('');
            
            $("#chicken_egg_production_type").change(function(){
		        $("#chicken_egg_production_type").each(function(){
		            chicken_egg_production_type = $(this).val();
		            $.post("../../controllers/ProductionController.php?op=viewProduction",{id : chicken_egg_production_type},function(data){
		                data=JSON.parse(data);
		                $('#chicken_egg_production_quantity').val(data.stock);
		            });
		        });
		    });
        } else if(typeProductionValue == 2) {
			$.post("../../controllers/ProductionController.php?op=type_production", {type : typeProductionValue}, function(data){
		        $("#third_party_type").html(data);
		    });
			// Desbloquear ciertos campos
			$('#third_party_type').prop('disabled', false).show();
            $('#third_party_price').prop('disabled', false).show();
            // Ocultar otros campos
            $('#chicken_egg_production_type').prop('disabled', true).show();
            $('#chicken_egg_production_price').prop('disabled', true).show();
            $('#chicken_egg_status').prop('disabled', true).show();
            $('#chicken_egg_production_date').prop('disabled', true).show();
            $('#chicken_egg_production_type').val('0').trigger('change');
            $('#chicken_egg_production_price').val('');
            $('#chicken_egg_production_quantity').val('');
            $('#chicken_egg_status').val('');
            $('#chicken_egg_production_date').val('');
            
            $('#chicken_type').prop('disabled', true).show();
            $('#chicken_price').prop('disabled', true).show();
            $('#chicken_stock').prop('disabled', true).show();
            $('#chicken_birthdate').prop('disabled', true).show();
            $('#chicken_weihg').prop('disabled', true).show();
            $('#chicken_condition').prop('disabled', true).show();
            $('#chicken_type').val('0').trigger('change'); 
            $('#chicken_price').val('');
            $('#chicken_stock').val('');
            $('#chicken_birthdate').val('');
            $('#chicken_weihg').val('');
            $('#chicken_condition').val('');
            
            $("#third_party_type").change(function(){
		        $("#third_party_type").each(function(){
		            third_party_type = $(this).val();
		            $.post("../../controllers/ProductionController.php?op=viewProduction",{id : third_party_type},function(data){
		                data=JSON.parse(data);
		                $('#third_party_stock').val(data.stock);
		            });
		        });
		    });
        } else if(typeProductionValue == 3) {
			$.post("../../controllers/ProductionController.php?op=type_production", {type : typeProductionValue}, function(data){
		        $("#chicken_type").html(data);
		    });
			// Desbloquear ciertos campos
			$('#chicken_type').prop('disabled', false).show();
            $('#chicken_price').prop('disabled', false).show();
            $('#chicken_birthdate').prop('disabled', false).show();
            $('#chicken_weihg').prop('disabled', false).show();
            $('#chicken_condition').prop('disabled', false).show();
            // Ocultar otros campos
            $('#chicken_egg_production_type').prop('disabled', true).show();
            $('#chicken_egg_production_price').prop('disabled', true).show();
            $('#chicken_egg_status').prop('disabled', true).show();
            $('#chicken_egg_production_date').prop('disabled', true).show();
            $('#chicken_egg_production_type').val('0').trigger('change');
            $('#chicken_egg_production_price').val('');
            $('#chicken_egg_production_quantity').val('');
            $('#chicken_egg_status').val('');
            $('#chicken_egg_production_date').val('');
            
            $('#third_party_type').prop('disabled', true).show();
            $('#third_party_price').prop('disabled', true).show();
            $('#third_party_stock').prop('disabled', true).show();
            $('#third_party_type').val('0').trigger('change');
            $('#third_party_price').val('');
            $('#third_party_stock').val('');
            
            $("#chicken_type").change(function(){
		        $("#chicken_type").each(function(){
		            chicken_type = $(this).val();
		            $.post("../../controllers/ProductionController.php?op=viewProduction",{id : chicken_type},function(data){
		                data=JSON.parse(data);
		                $('#chicken_stock').val(data.stock);
		            });
		        });
		    });
		} else{
			$('#chicken_type').prop('disabled', true).show();
            $('#chicken_price').prop('disabled', true).show();
            $('#chicken_stock').prop('disabled', true).show();
            $('#chicken_birthdate').prop('disabled', true).show();
            $('#chicken_weihg').prop('disabled', true).show();
            $('#chicken_condition').prop('disabled', true).show();
            $('#chicken_type').val('0').trigger('change'); 
            $('#chicken_price').val('');
            $('#chicken_stock').val('');
            $('#chicken_birthdate').val('');
            $('#chicken_weihg').val('');
            $('#chicken_condition').val('');
			
			$('#chicken_egg_production_type').prop('disabled', true).show();
            $('#chicken_egg_production_price').prop('disabled', true).show();
            $('#chicken_egg_production_quantity').prop('disabled', true).show();
            $('#chicken_egg_status').prop('disabled', true).show();
            $('#chicken_egg_production_date').prop('disabled', true).show();
            $('#chicken_egg_production_type').val('0').trigger('change');
            $('#chicken_egg_production_price').val('');
            $('#chicken_egg_production_quantity').val('');
            $('#chicken_egg_status').val('');
            $('#chicken_egg_production_date').val('');
            
            $('#third_party_type').prop('disabled', true).show();
            $('#third_party_price').prop('disabled', true).show();
            $('#third_party_stock').prop('disabled', true).show();
            $('#third_party_type').val('0').trigger('change');
            $('#third_party_price').val('');
            $('#third_party_stock').val('');
		}
    });
    
    $('#type_production').select2();
    
    $('#chicken_egg_production_type').select2();
    
    $('#third_party_type').select2();
    
    $('#chicken_type').select2();
    
});

$(document).on("click","#btnegg",function(){
    /*var chicken_egg_production_type = $('#chicken_egg_production_type').val();
    var chicken_egg_production_price = $('#chicken_egg_production_price').val();
    var chicken_egg_production_quantity = $('#chicken_egg_production_quantity').val();
    var chicken_egg_production_date = $('#chicken_egg_production_date').val();
    
    if($("#chicken_egg_production_type").val()== ''){
		swal.fire({
            title:'Compra',
            text: 'Error Campos Vacios y/o incongruentes',
            icon: 'error'
        });
    }else{
		$.post("../../controllers/PurchaseController.php?op=savePurchaseDetail",{
			chicken_egg_production_type : chicken_egg_production_type,
			chicken_egg_production_price : chicken_egg_production_price,
			chicken_egg_production_quantity : chicken_egg_production_quantity,
			chicken_egg_production_date : chicken_egg_production_date
		},function(data){
			
        });
        
        $.post("../../controllers/PurchaseController.php?op=calculate",{id : id},function(data){
			data = JSON.parse(data);
			$('#txtsubtotal').html(data.subtotal);
			$('#txtiva').html(data.iva);
			$('#txttotal').html(data.total);
		});
        
        $('#purchase_detail_price').val('');
    	$('#purchase_detail_stock').val('');
    	
    	listar(purchase_id);
	}*/
});