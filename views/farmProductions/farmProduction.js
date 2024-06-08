var user_id = $('#user_id').val();

$(document).ready(function(){
    
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
            $('#chicken_egg_production_stock').prop('disabled', false).show();
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
            $('#chicken_egg_production_stock').prop('disabled', true).show();
            $('#chicken_egg_production_type').val('0').trigger('change');
            $('#chicken_egg_production_price').val('');
            $('#chicken_egg_production_quantity').val('');
            $('#chicken_egg_production_stock').val('');
            $('#chicken_egg_status').val('');
            $('#chicken_egg_production_date').val('');
            
            $('#chicken_type').prop('disabled', true).show();
            $('#chicken_price').prop('disabled', true).show();
            $('#chicken_stock').prop('disabled', true).show();
            $('#chicken_birthdate').prop('disabled', true).show();
            $('#chicken_weight').prop('disabled', true).show();
            $('#chicken_condition').prop('disabled', true).show();
            $('#chicken_type').val('0').trigger('change'); 
            $('#chicken_price').val('');
            $('#chicken_stock').val('');
            $('#chicken_birthdate').val('');
            $('#chicken_weight').val('');
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
            $('#chicken_weight').prop('disabled', false).show();
            $('#chicken_condition').prop('disabled', false).show();
            // Ocultar otros campos
            $('#chicken_egg_production_type').prop('disabled', true).show();
            $('#chicken_egg_production_price').prop('disabled', true).show();
            $('#chicken_egg_status').prop('disabled', true).show();
            $('#chicken_egg_production_stock').prop('disabled', true).show();
            $('#chicken_egg_production_date').prop('disabled', true).show();
            $('#chicken_egg_production_type').val('0').trigger('change');
            $('#chicken_egg_production_price').val('');
            $('#chicken_egg_production_quantity').val('');
            $('#chicken_egg_production_stock').val('');
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
            $('#chicken_weight').prop('disabled', true).show();
            $('#chicken_condition').prop('disabled', true).show();
            $('#chicken_type').val('0').trigger('change'); 
            $('#chicken_price').val('');
            $('#chicken_stock').val('');
            $('#chicken_birthdate').val('');
            $('#chicken_weight').val('');
            $('#chicken_condition').val('');
			
			$('#chicken_egg_production_type').prop('disabled', true).show();
            $('#chicken_egg_production_price').prop('disabled', true).show();
            $('#chicken_egg_production_quantity').prop('disabled', true).show();
            $('#chicken_egg_status').prop('disabled', true).show();
            $('#chicken_egg_production_stock').prop('disabled', true).show();
            $('#chicken_egg_production_date').prop('disabled', true).show();
            $('#chicken_egg_production_type').val('0').trigger('change');
            $('#chicken_egg_production_price').val('');
            $('#chicken_egg_production_quantity').val('');
            $('#chicken_egg_status').val('');
            $('#chicken_egg_production_stock').val('');
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
	var farm_id = $('#farm_id').val();
    var chicken_egg_production_type = $('#chicken_egg_production_type').val();
    var chicken_egg_production_price = $('#chicken_egg_production_price').val();
    var chicken_egg_production_quantity = $('#chicken_egg_production_quantity').val();
    var chicken_egg_production_stock = $('#chicken_egg_production_stock').val();
    var chicken_egg_production_date = $('#chicken_egg_production_date').val();
    var chicken_egg_status = $('#chicken_egg_status').val();
    
    if($("#chicken_egg_production_type").val()== '' || $("#chicken_egg_production_type").val()== '0'  || $("#farm_id").val()== '' || $("#farm_id").val()== '0'){
		swal.fire({
            title:'Compra',
            text: 'Error Campos Vacios y/o incongruentes',
            icon: 'error'
        });
    }else{
		$.post("../../controllers/FarmProductionController.php?op=saveFarmProductionDetailEggs",{
			chicken_egg_production_type : chicken_egg_production_type,
			chicken_egg_production_price : chicken_egg_production_price,
			chicken_egg_production_quantity : chicken_egg_production_quantity,
			chicken_egg_production_stock : chicken_egg_production_stock,
			chicken_egg_production_date : chicken_egg_production_date,
			chicken_egg_status : chicken_egg_status,
			user_id : user_id,
			farm_id : farm_id
		},function(data){
			data = JSON.parse(data);
			if(data.status == false){
				swal.fire({
		            title:'Produccion',
		            text: data.msg,
		            icon: 'error'
		        });
			}
        });
        
        $('#chicken_egg_production_type').val('0').trigger('change'); 
        $('#chicken_egg_production_price').val('');
    	$('#chicken_egg_production_quantity').val('');
    	$('#chicken_egg_production_stock').val('');
        $('#chicken_egg_status').val('');
        $('#chicken_egg_production_date').val('');
        
        listar(farm_id);
	}
});

$(document).on("click","#btnchicken",function(){
	var farm_id = $('#farm_id').val();
    var chicken_type = $('#chicken_type').val();
    var chicken_price = $('#chicken_price').val();
    var chicken_stock = $('#chicken_stock').val();
    var chicken_birthdate = $('#chicken_birthdate').val();
    var chicken_weight = $('#chicken_weight').val();
    var chicken_condition = $('#chicken_condition').val();
    
    if($("#chicken_type").val()== '' || $("#chicken_type").val()== '0'  || $("#farm_id").val()== '' || $("#farm_id").val()== '0'){
		swal.fire({
            title:'Compra',
            text: 'Error Campos Vacios y/o incongruentes',
            icon: 'error'
        });
    }else{
		$.post("../../controllers/FarmProductionController.php?op=saveFarmProductionDetailChickens",{
			chicken_type : chicken_type,
			chicken_price : chicken_price,
			chicken_stock : chicken_stock,
			chicken_birthdate : chicken_birthdate,
			chicken_weight : chicken_weight,
			chicken_condition : chicken_condition,
			user_id : user_id,
			farm_id : farm_id
		},function(data){
			
        });
        
        $('#chicken_type').val('0').trigger('change'); 
        $('#chicken_price').val('');
        $('#chicken_stock').val('');
        $('#chicken_birthdate').val('');
        $('#chicken_weight').val('');
        $('#chicken_condition').val('');
	}
});

$(document).on("click","#btnthirdparty",function(){
	var farm_id = $('#farm_id').val();
    var third_party_type = $('#third_party_type').val();
    var third_party_price = $('#third_party_price').val();
    var third_party_stock = $('#third_party_stock').val();
    
    if($("#third_party_type").val()== '' || $("#third_party_type").val()== '0'  || $("#farm_id").val()== '' || $("#farm_id").val()== '0'){
		swal.fire({
            title:'Compra',
            text: 'Error Campos Vacios y/o incongruentes',
            icon: 'error'
        });
    }else{
		$.post("../../controllers/FarmProductionController.php?op=saveFarmProductionDetailThirdParties",{
			third_party_type : third_party_type,
			third_party_price : third_party_price,
			third_party_stock : third_party_stock,
			user_id : user_id,
			farm_id : farm_id
		},function(data){
			
        });
        
        $('#third_party_type').val('0').trigger('change');
        $('#third_party_price').val('');
        $('#third_party_stock').val('');
	}
});

function listar(farm_id){
    $('#table_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controllers/FarmProductionController.php?op=listDetail",
            type:"post",
            data:{farm_id : farm_id}
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar MENU registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del START al END de un total de TOTAL registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de MAX registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
}