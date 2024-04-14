var usu_id = $('#user_id').val();

$(document).ready(function(){

    $('#supplier_id').select2();
    
    $('#product_type_id').select2();
    
    $('#product_id').select2();

    $.post("../../controllers/SupplierController.php?op=combo", function(data){
        $("#supplier_id").html(data);
    });
    
    $.post("../../controllers/ProductTypeController.php?op=combo", function(data){
        $("#product_type_id").html(data);
    });

    $("#supplier_id").change(function(){
        $("#supplier_id").each(function(){
            supplier_id = $(this).val();
            $.post("../../controllers/SupplierController.php?op=viewSupplier",{id : supplier_id},function(data){
                data=JSON.parse(data);
                $('#supplier_ruc').val(data.RUC);
                $('#supplier_address').val(data.address);
                $('#supplier_phone').val(data.phone);
                $('#supplier_email').val(data.email);
            });
        });
    });
    
    $("#product_type_id").change(function(){
        $("#product_type_id").each(function(){
            product_type_id = $(this).val();
            $.post("../../controllers/ProductTypeController.php?op=viewProductType",{id : product_type_id},function(data){
                data=JSON.parse(data);
                $.post("../../controllers/ProductController.php?op=getProductByType", {product_type_id : product_type_id}, function(dataProduct){
			        $("#product_id").html(dataProduct);
			    });
			    $("#product_id").change(function(){
		        	$("#product_id").each(function(){
		            	product_id = $(this).val();
		            	$.post("../../controllers/ProductController.php?op=viewProduct",{id : product_id},function(data2){
                			data2=JSON.parse(data2);
                			$('#product_stock').val(data2.stock);
                		})
		         	});
    			});
                $('#product_type_price').val(data.price);
            });
        });
    });
});

$(document).on("click","#btnlimpiar",function(){
    location.reload();
});