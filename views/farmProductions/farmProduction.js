var user_id = $('#user_id').val();

$(document).ready(function(){
    
    $('#type_production').change(function() {
        var typeProductionValue = $(this).val();
        
        if (typeProductionValue == 1) {
            // Desbloquear ciertos campos
            $('#chicken_egg_production_type').prop('disabled', false).show();
            $('#chicken_egg_production_price').prop('disabled', false).show();
            $('#chicken_egg_production_quantity').prop('disabled', false).show();
            $('#chicken_egg_status').prop('disabled', false).show();
            $('#chicken_egg_production_date').prop('disabled', false).show();
            // Ocultar otros campos
            $('#third_party_type').prop('disabled', true).show();
            $('#third_party_price').prop('disabled', true).show();
            $('#third_party_stock').prop('disabled', true).show();
            
            $('#chicken_type').prop('disabled', true).show();
            $('#chicken_price').prop('disabled', true).show();
            $('#chicken_stock').prop('disabled', true).show();
            $('#chicken_birthdate').prop('disabled', true).show();
            $('#chicken_weihg').prop('disabled', true).show();
            $('#chicken_condition').prop('disabled', true).show();
        } else if(typeProductionValue == 2) {
			// Desbloquear ciertos campos
			$('#third_party_type').prop('disabled', false).show();
            $('#third_party_price').prop('disabled', false).show();
            $('#third_party_stock').prop('disabled', false).show();
            // Ocultar otros campos
            $('#chicken_egg_production_type').prop('disabled', true).show();
            $('#chicken_egg_production_price').prop('disabled', true).show();
            $('#chicken_egg_production_quantity').prop('disabled', true).show();
            $('#chicken_egg_status').prop('disabled', true).show();
            $('#chicken_egg_production_date').prop('disabled', true).show();
            
            $('#chicken_type').prop('disabled', true).show();
            $('#chicken_price').prop('disabled', true).show();
            $('#chicken_stock').prop('disabled', true).show();
            $('#chicken_birthdate').prop('disabled', true).show();
            $('#chicken_weihg').prop('disabled', true).show();
            $('#chicken_condition').prop('disabled', true).show();
        } else if(typeProductionValue == 3) {
			// Desbloquear ciertos campos
			$('#chicken_type').prop('disabled', false).show();
            $('#chicken_price').prop('disabled', false).show();
            $('#chicken_stock').prop('disabled', false).show();
            $('#chicken_birthdate').prop('disabled', false).show();
            $('#chicken_weihg').prop('disabled', false).show();
            $('#chicken_condition').prop('disabled', false).show();
            // Ocultar otros campos
            $('#chicken_egg_production_type').prop('disabled', true).show();
            $('#chicken_egg_production_price').prop('disabled', true).show();
            $('#chicken_egg_production_quantity').prop('disabled', true).show();
            $('#chicken_egg_status').prop('disabled', true).show();
            $('#chicken_egg_production_date').prop('disabled', true).show();
            
            $('#third_party_type').prop('disabled', true).show();
            $('#third_party_price').prop('disabled', true).show();
            $('#third_party_stock').prop('disabled', true).show();
		} else{
			$('#chicken_type').prop('disabled', true).show();
            $('#chicken_price').prop('disabled', true).show();
            $('#chicken_stock').prop('disabled', true).show();
            $('#chicken_birthdate').prop('disabled', true).show();
            $('#chicken_weihg').prop('disabled', true).show();
            $('#chicken_condition').prop('disabled', true).show();
			
			$('#chicken_egg_production_type').prop('disabled', true).show();
            $('#chicken_egg_production_price').prop('disabled', true).show();
            $('#chicken_egg_production_quantity').prop('disabled', true).show();
            $('#chicken_egg_status').prop('disabled', true).show();
            $('#chicken_egg_production_date').prop('disabled', true).show();
            
            $('#third_party_type').prop('disabled', true).show();
            $('#third_party_price').prop('disabled', true).show();
            $('#third_party_stock').prop('disabled', true).show();
		}
    });
    
    $('#type_production').select2();
    
    $('#chicken_egg_production_type').select2();
    
    $('#third_party_type').select2();
    
    $('#chicken_type').select2();
});