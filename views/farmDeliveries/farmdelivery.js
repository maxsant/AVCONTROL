var user_id = $('#user_id').val();

$(document).ready(function(){
	
	$.post("../../controllers/FarmDeliveriesController.php?op=registerFarmDeliveries", {user_id : user_id}, function(data){
		data = JSON.parse(data);
        $("#farm_delivery_id").val(data.id);
    });

    $('#farm_id').select2();
    
    $('#delivery_id').select2();
    
    $('#payment_id').select2();

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
			data = JSON.parse(data);
			if(data.status == false){
				swal.fire({
		            title:'Compra de Suministro',
		            text: data.msg,
		            icon: 'error'
		        });
			}
        });
        
        $.post("../../controllers/FarmDeliveriesController.php?op=calculate",{farm_delivery_id : farm_delivery_id},function(data){
			data = JSON.parse(data);
			$('#txtsubtotal').html(data.subtotal);
			$('#txtiva').html(data.iva);
			$('#txttotal').html(data.total);
		});
        
    	$('#farm_delivery_detail_stock').val('');
    	
    	listar(farm_delivery_id);
	}
});

function eliminar(farm_delivery_detail_id, farm_delivery_id)
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
            $.post("../../controllers/FarmDeliveriesController.php?op=deleteFarmDeliveryDetail",{farm_delivery_detail_id : farm_delivery_detail_id},function(data){
                console.log(data);
            });
            
            $.post("../../controllers/FarmDeliveriesController.php?op=calculate",{farm_delivery_id : farm_delivery_id},function(data){
				data = JSON.parse(data);
				$('#txtsubtotal').html(data.subtotal);
				$('#txtiva').html(data.iva);
				$('#txttotal').html(data.total);
    		});

            listar(farm_delivery_id);

            swal.fire({
                title:'Compra Suministro',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });
}

function listar(farm_delivery_id){
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
            url:"../../controllers/FarmDeliveriesController.php?op=listDetail",
            type:"post",
            data:{farm_delivery_id : farm_delivery_id}
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
    var farm_delivery_id = $("#farm_delivery_id").val();
    var farm_id = $("#farm_id").val();
    var delivery_id = $('#delivery_id').val();
    var farm_name = $("#farm_name").val();
    var farm_location = $("#farm_location").val();
    var farm_delivery_comment = $("#farm_delivery_comment").val();
    var payment_id = $("#payment_id").val();
    var status_payment = $("#status_payment").val();
    
    if($("#delivery_id").val() == '0' || $("#farm_id").val() == '0' || $("#payment_id").val() == '0' || $('#status_payment').val() == '0'){
        swal.fire({
            title:'Compra Suministro',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{
        $.post("../../controllers/FarmDeliveriesController.php?op=calculate",{farm_delivery_id : farm_delivery_id},function(data){
            data=JSON.parse(data);
            if (data.total ==null){
                /* TODO:Validacion de Detalle */
                swal.fire({
                    title:'Compra Suministro',
                    text: 'Error No Existe Detalle',
                    icon: 'error'
                });
            }else{
                $.post("../../controllers/FarmDeliveriesController.php?op=updateFarmDelivery",{
                    farm_delivery_id : farm_delivery_id,
                    farm_id : farm_id,
                    farm_name : farm_name,
                    farm_location : farm_location,
                    payment_id : payment_id,
                    farm_delivery_comment : farm_delivery_comment,
                    status_payment : status_payment,
                    delivery_id : delivery_id
                },function(data){
                    /* TODO:Mensaje de Sweetalert */
                    swal.fire({
                        title: 'Compra Suministro',
                        text: 'Compra de suministros registrada Correctamente con Nro: D-' + farm_delivery_id,
                        icon: 'success',
                        /* TODO: Ruta para mostrar documento de compra */
                        footer: "<a href='../viewFarmDeliveries/index.php?farmDeliveryId=" + farm_delivery_id + "' target='_blank'>Desea ver el Documento?</a>"
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