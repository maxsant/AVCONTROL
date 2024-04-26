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
			title: 'Gallina',
			text: 'Campos no pueden estar vacios',
			icon: 'error'
		});
        return false;
    }
	$.ajax({
		url: "../../controllers/ChickenController.php?op=createAndUpdate",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false, // Ortografía corregida
		success: function(data){
			$('#table_data').DataTable().ajax.reload();
			$('#modalmantenimiento').modal('hide');
			
			swal.fire({
				title: 'Gallina',
				text: 'Registro confirmado',
				icon: 'success'
			});
		}
	});
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
            url:"../../controllers/ChickenController.php?op=listChicken",
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
	$.post("../../controllers/ChickenController.php?op=viewChicken", {id: id}, function(data){
		data = JSON.parse(data);
		$("#id").val(data.id);
		$("#breed").val(data.breed);
		$("#production_date").val(data.production_date);
		$("#production_quantity").val(data.production_quantity);
		$("#egg_status").val(data.egg_status);
		$("#birthdate").val(data.birthdate);
		$("#condition").val(data.condition);
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
            $.post("../../controllers/ChickenController.php?op=delete",{id : id},function(data){
                console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title:'Gallina',
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