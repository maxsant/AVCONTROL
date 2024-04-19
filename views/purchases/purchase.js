var user_id = $('#user_id').val();

$(document).ready(function(){
	
	$.post("../../controllers/PurchaseController.php?op=registerPurchase", {user_id : user_id}, function(data){
		data = JSON.parse(data);
        $("#purchase_id").val(data.id);
    });

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

$(document).on("click","#btnagregar",function(){
    var purchase_id = $('#purchase_id').val();
    var delivery_id = $('#delivery_id').val();
    var purchase_detail_price = $('#purchase_detail_price').val();
    var purchase_detail_stock = $('#purchase_detail_stock').val();
    
    if($("#delivery_id").val()== '' || $("#purchase_detail_price").val()== '0' || $("#purchase_detail_price").val()== '' || $("#purchase_detail_stock").val()== '0' || $("#purchase_detail_stock").val()== '' ){
		swal.fire({
            title:'Compra',
            text: 'Error Campos Vacios y/o incongruentes',
            icon: 'error'
        });
    }else{
		$.post("../../controllers/PurchaseController.php?op=savePurchaseDetail",{
			purchase_id : purchase_id,
			delivery_id : delivery_id,
			purchase_detail_price : purchase_detail_price,
			purchase_detail_stock : purchase_detail_stock
		},function(data){
        });
        
        $('#purchase_detail_price').val('');
    	$('#purchase_detail_stock').val('');
    	
    	listar(purchase_id);
	}
});

function listar(purchase_id){
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
            url:"../../controllers/PurchaseController.php?op=listDetail",
            type:"post",
            data:{purchase_id : purchase_id}
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

$(document).on("click","#btnlimpiar",function(){
    location.reload();
});