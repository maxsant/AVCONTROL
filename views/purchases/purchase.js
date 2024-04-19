var usu_id = $('#user_id').val();

$(document).ready(function(){

    $('#supplier_id').select2();
    
    $('#delivery_id').select2();

    $.post("../../controllers/SupplierController.php?op=combo", function(data){
        $("#supplier_id").html(data);
    });
    
    $.post("../../controllers/DeliveryController.php?op=combo", function(data){
        $("#delivery_id").html(data);
    });
    
    $.post("../../controllers/PaymentController.php?op=combo", function(data){
        $("#payment_id").html(data);
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
    
    $("#delivery_id").change(function(){
        $("#delivery_id").each(function(){
            delivery_id = $(this).val();
            $.post("../../controllers/DeliveryController.php?op=viewDelivery",{id : delivery_id},function(data){
                data=JSON.parse(data);
                $('#delivery_type').val(data.type);
                $('#delivery_stock').val(data.stock);
            });
        });
    });
});

$(document).on("click","#btnlimpiar",function(){
    location.reload();
});