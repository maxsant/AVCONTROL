$(document).ready(function(){
    var farm_delivery_id = getUrlParameter('farmDeliveryId');

    $.post("../../controllers/FarmDeliveriesController.php?op=viewFarmDelivery",{farm_delivery_id : farm_delivery_id},function(data){
        data = JSON.parse(data);
		console.log(data);
        $('#farm_delivery_id').html(data.id);
        $('#farm_delivery_created').html(data.farm_delivery_created);
        $('#payment_name').html(data.payment_name);
        $('#status_payment').html((data.status_payment) == 1 ? 'Pagado' : 'Pendiente');
        $('#txttotal').html(data.farm_delivery_detail_total);

        $('#farm_delivery_subtotal').html(data.farm_delivery_subtotal);
        $('#farm_delivery_iva').html(data.farm_delivery_iva);
        $('#farm_delivery_total').html(data.farm_delivery_total);

        $('#farm_delivery_comment').html(data.farm_delivery_comment);

        $('#user_name').html(data.userName +' '+ data.userLastname);
        $('#payment_name_user').html(data.payment_name);

        $('#farm_name').html("<b>Nombre: </b>"+data.farm_name);
        $('#farm_location').html("<b>Localizacion: </b>"+data.farm_location);
    });
    
    $.post("../../controllers/FarmDeliveriesController.php?op=listFormatDetail",{farm_delivery_id : farm_delivery_id},function(data){
        $('#listDetail').html(data);
    });
});

/* TODO: Obtener parametro de URL */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};