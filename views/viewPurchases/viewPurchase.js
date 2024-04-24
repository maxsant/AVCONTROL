$(document).ready(function(){
    var purchase_id = getUrlParameter('purchaseId');

    $.post("../../controllers/PurchaseController.php?op=viewPurchase",{purchase_id : purchase_id},function(data){
        data = JSON.parse(data);
		console.log(data);
        $('#purchase_id').html(data.id);
        $('#purchase_created').html(data.purchase_created);
        $('#payment_name').html(data.payment_name);
        $('#status_payment').html((data.status_payment) == 1 ? 'Pagado' : 'Pendiente');
        $('#txttotal').html(data.purchase_detail_total);

        $('#purchase_subtotal').html(data.purchase_subtotal);
        $('#purchase_iva').html(data.purchase_iva);
        $('#purchase_total').html(data.purchase_total);

        $('#purchase_comment').html(data.purchase_comment);

        $('#user_name').html(data.userName +' '+ data.userLastname);
        $('#payment_name_user').html(data.payment_name);

        $('#supplier_name').html("<b>Nombre: </b>"+data.supplier_name);
        $('#supplier_ruc').html("<b>RUC: </b>"+data.supplier_ruc);
        $('#supplier_address').html("<b>Dirección: </b>"+data.supplier_address);
        $('#supplier_email').html("<b>Correo: </b>"+data.supplier_email);
        $('#supplier_phone').html("<b>Celular: </b>"+data.supplier_phone);
    });
    
    $.post("../../controllers/PurchaseController.php?op=listFormatDetail",{purchase_id : purchase_id},function(data){
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