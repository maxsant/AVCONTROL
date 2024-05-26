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
			title: 'Granja',
			text: 'Campos no pueden estar vacios',
			icon: 'error'
		});
        return false;
    }
	$.ajax({
		url: "../../controllers/FarmController.php?op=createAndUpdate",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false, // Ortografía corregida
		success: function(data){
			$('#table_data').DataTable().ajax.reload();
			$('#modalmantenimiento').modal('hide');
			
			swal.fire({
				title: 'Granja',
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
            url:"../../controllers/FarmController.php?op=listFarm",
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
	$.post("../../controllers/FarmController.php?op=viewFarm", {id: id}, function(data){
		data = JSON.parse(data);
		$("#id").val(data.id);
		$("#name").val(data.name);
		$("#location").val(data.location);
		$("#size").val(data.size);
		$("#eggs_a").val(data.eggs_a);
		$("#eggs_b").val(data.eggs_b);
		$("#eggs_c").val(data.eggs_c);
		$("#chicken_meet").val(data.chicken_meet);
		$("#third_party_products").val(data.third_party_products);
		$("#chiecken_farm_capacity").val(data.chiecken_farm_capacity);
		
		// Habilitar campos específicos al editar un registro
        $("#eggs_a").prop("readonly", false);
        $("#eggs_b").prop("readonly", false);
        $("#eggs_c").prop("readonly", false);
        $("#chicken_meet").prop("readonly", false);
        $("#third_party_products").prop("readonly", false);
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
            $.post("../../controllers/FarmController.php?op=delete",{id : id},function(data){
                console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title:'Granja',
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
    // Deshabilitar campos específicos al editar un registro
    $("#eggs_a").prop("readonly", true);
    $("#eggs_b").prop("readonly", true);
    $("#eggs_c").prop("readonly", true);
    $("#chicken_meet").prop("readonly", true);
    $("#third_party_products").prop("readonly", true);
    $('#modalmantenimiento').modal('show');
})

init();