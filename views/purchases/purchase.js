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
                if(data.delivery_type_id){
	                $.post('../../controllers/DeliveryTypeController.php?op=viewDeliveryType', {id : data.delivery_type_id}, function(data2){
						data2 = JSON.parse(data2);
						$('#delivery_type').val(data2.name);
					})
				}else{
					$('#delivery_type').val('');
				}
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
        
        $.post("../../controllers/PurchaseController.php?op=calculate",{purchase_id : purchase_id},function(data){
			data = JSON.parse(data);
			$('#txtsubtotal').html(data.subtotal);
			$('#txtiva').html(data.iva);
			$('#txttotal').html(data.total);
		});
        
        $('#purchase_detail_price').val('');
    	$('#purchase_detail_stock').val('');
    	
    	listar(purchase_id);
	}
});

function eliminar(purchase_detail_id, purchase_id)
{
	swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controllers/PurchaseController.php?op=deletePurchaseDetail",{purchase_detail_id : purchase_detail_id},function(data){
                console.log(data);
            });
            
            $.post("../../controllers/PurchaseController.php?op=calculate",{purchase_id : purchase_id},function(data){
				data = JSON.parse(data);
				$('#txtsubtotal').html(data.subtotal);
				$('#txtiva').html(data.iva);
				$('#txttotal').html(data.total);
    		});

            listar(purchase_id);

            swal.fire({
                title:'Compra',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });
}

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

$(document).on("click","#btnguardar",function(){
    var purchase_id = $("#purchase_id").val();
    var supplier_id = $("#supplier_id").val();
    var supplier_ruc = $("#supplier_ruc").val();
    var supplier_address = $("#supplier_address").val();
    var supplier_email = $("#supplier_email").val();
    var supplier_phone = $("#supplier_phone").val();
    var purchase_comment = $("#purchase_comment").val();
    var payment_id = $("#payment_id").val();
    var status_payment = $("#status_payment").val();
    
    if($("#supplier_id").val() == '0' || $("#payment_id").val() == '0' || $('#status_payment').val() == '0'){
        swal.fire({
            title:'Compra',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{
        $.post("../../controllers/PurchaseController.php?op=calculate",{purchase_id : purchase_id},function(data){
            data=JSON.parse(data);
            console.log(data);
            if (data.total ==null){
                /* TODO:Validacion de Detalle */
                swal.fire({
                    title:'Compra',
                    text: 'Error No Existe Detalle',
                    icon: 'error'
                });
            }else{
                $.post("../../controllers/PurchaseController.php?op=updatePurchase",{
                    purchase_id : purchase_id,
                    supplier_id : supplier_id,
                    supplier_ruc : supplier_ruc,
                    supplier_address : supplier_address,
                    supplier_email : supplier_email,
                    supplier_phone : supplier_phone,
                    payment_id : payment_id,
                    purchase_comment : purchase_comment,
                    status_payment : status_payment
                },function(data){
                    /* TODO:Mensaje de Sweetalert */
                    swal.fire({
                        title:'Compra',
                        text: 'Compra registrada Correctamente con Nro: C-'+purchase_id,
                        icon: 'success',
                        /* TODO: Ruta para mostrar documento de compra */
                        footer: "<a href='../viewPurchases/index.php?purchaseId="+purchase_id+"' target='_blank'>Desea ver el Documento?</a>"
                    }).then(function() {
                        location.reload();
                    });

                });
            }
        });
    }
});

$(document).on("click","#btnlimpiar",function(){
    location.reload();
});