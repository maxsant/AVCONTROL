function init()
{
	$("#mantenimiento_form").on("submit", function(e){
		guardaryeditar(e);
	})
}

function guardaryeditar(e)
{
	e.preventDefault();
	var formData = new FormData($("#mantenimiento_form")[0]);
	var camposVacios = false;
	
	formData.forEach(function(value, key) {
		if(key !== 'id'){
	        if(value === ""){
	            camposVacios = true;
	            return false;
	        }
        }
	});
    
    if(camposVacios){
        swal.fire({
			title: 'Producto',
			text: 'Campos no pueden estar vacios',
			icon: 'error'
		});
        return false;
    }
	$.ajax({
		url: "../../controllers/ProductController.php?op=createAndUpdate",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false, // Ortografía corregida
		success: function(data){
			data = JSON.parse(data);
			if(data.error == true){				
				swal.fire({
					title: 'Producto',
					text: 'Campos no pueden estar vacios',
					icon: 'error'
				});
			}else{
				$('#table_data').DataTable().ajax.reload();
				$('#modalmantenimiento').modal('hide');
				
				swal.fire({
					title: 'Producto',
					text: 'Registro confirmado',
					icon: 'success'
				});
			}
		}
	});
}

$(document).ready(function(){
	
	$.post("../../controllers/ProductTypeController.php?op=combo", function(data){
		$('#product_type_id').html(data);
	});
	
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
            url:"../../controllers/ProductController.php?op=listProduct",
            type:"post"
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

function editar(id)
{
	$('#id').val('');
	$("#mantenimiento_form")[0].reset();
	$.post("../../controllers/ProductController.php?op=viewProduct", {id: id}, function(data){
		data = JSON.parse(data);
		$("#id").val(data.id);
		$("#expiration_date").val(data.expiration_date);
		$("#stock").val(data.stock);
		$("#product_type_id").val(data.product_type_id).trigger('change');
	});
	$('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(id)
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
            $.post("../../controllers/ProductController.php?op=delete",{id : id},function(data){
                console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title:'Producto',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });
}

$(document).on("click", "#btnnuevo", function(){
	$('#id').val('');
    $('#lbltitulo').html('Nuevo Registro');
    $("#mantenimiento_form")[0].reset();
    $('#modalmantenimiento').modal('show');
})

init();