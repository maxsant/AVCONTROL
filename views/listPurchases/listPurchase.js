function init()
{
	$('#modalStatusPayment').on("submit", function(e){
		updateStatusPayment(e);
	});
}

function updateStatusPayment(e)
{
	e.preventDefault();
	var formData = new FormData($("#modalStatusPayment_form")[0]);
	
	if(formData.get('status_payment') == '0'){
		swal.fire({
            title:'Estado',
            text: 'Error Campo Vacio',
            icon: 'error'
        });
	}else{
		$.ajax({
			url: "../../controllers/PurchaseController.php?op=updateStatusPayment",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(data){
				$('#table_data').DataTable().ajax.reload();
				$('#modalStatusPayment').modal('hide');
				
				swal.fire({
					title: 'Estado',
					text: 'Registro confirmado',
					icon: 'success'
				});
			}
		})
	}
}

$(document).ready(function(){

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
            url:"../../controllers/PurchaseController.php?op=listPurchase",
            type:"POST"
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
});

function ver(purchase_id){

    $('#detail_data').DataTable({
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

	$.post('../../controllers/PurchaseController.php?op=calculate', {purchase_id : purchase_id}, function(data){
		data = JSON.parse(data);
		$('#txtsubtotal').html(data.subtotal);
		$('#txtiva').html(data.iva)
		$('#txttotal').html(data.total)
	})
	
	$('#modaldetail').modal('show');

}

function editStatus(purchase_id)
{
	$.post("../../controllers/PurchaseController.php?op=viewPurchase", { purchase_id : purchase_id }, function(data){
		data = JSON.parse(data);
		$('#purchase_id').val(data.id);
		$('#status_payment').val(data.status_payment).trigger('change');
		$('#modalStatusPayment').modal('show');
	});
}

init();