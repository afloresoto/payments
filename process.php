<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
include "conection.php";
include "utilitarios.php";

$merchantId="1000000505";//Homologación 7100040113
$terminalId="PD100406";//BP para OTT

/*$date = new DateTime();
$file = fopen("../logs/log1.txt", "a");
fwrite($file, "[".$date->format('Y-m-d H:i:sP')."] Se carga el formulario para el proceso de compra" . PHP_EOL);*/



/*
Debito Internacional
TID: PPRUEBAS - MID: 7100040113
*/

/*
$merchantId="5000004001";//SUPERMAXI
$terminalId="L0100402";

*/

/*$merchantId="1000000505";
$terminalId="PD100406";*/

/*ALIA
7100043215
PD100111
*/

/*PARA PRUEBAS UNIONPAY
$merchantId="7100022527";
$terminalId="PD100421";
DATAFAST LABORATORI
$merchantId="1000000101";
$terminalId="BP275907";

Solidario
7100043215
PD100420

dATAFAST
1000000505
PD100406

DINERS
$merchantId="1000000606";
$terminalId="PD100413";

*/


/* $terminalId="PD100408"; */
/*
$merchantId="1000000505";
$terminalId="PD100403";*/
//TA248532
//7100014458
$merchterm = $merchantId."_".$terminalId;

//$ip_address = get_client_ip();
$items_details = $_SESSION;
$data = "";
$total = $_SESSION["total"];
$totalBase0=$_SESSION["totalBase0"];
$totalBaseIva=$_SESSION["totalBaseIva"];

$email = $_POST["email"];
$trx = $_POST["trx"];
$primer_nombre = $_POST["primer_nombre"];
$segundo_nombre = $_POST["segundo_nombre"];
$apellido = $_POST["apellido"];
$cedula = $_POST["cedula"];
$ip_address = "123.123.123.123";
$telefono = "042222333";
$direccion_cliente ="Av. 9 de Octubre";
$pais_cliente="EC";
$direccion_entrega ="Edif. Las Camaras, piso 4";
$pais_entrega="EC";
$postcode="901103";
$_SESSION["email"] = $email;



/*SISMETIC*/
/*ID de entidad:	8a8294175f113aad015f11652f2200a5
User ID	:	8a8294185a65bf5e015a6c8c728c0d95
Password:	bfqGqwQ32X*/

/*BIP-AMBIENTE DE PRODUCCION*/

/*
authentication.entityId= 8acda4c95e3209e3015e3a054fc636a3
authentication.userId= 8a8394c45af13fe2015b112ba8790a0d
authentication.password= CQ3wNYPJ47
*/

/*$_SESSION['entityId']="8a8294185a65bf5e015a6c8b89a10d8d";
$_SESSION['userId']="8a8294185a65bf5e015a6c8b2f690d8b";
$_SESSION['password']="RkjpyNNE8s";*/

$_SESSION['merchterm'] = $merchterm;

/**ReDShiled Test Info
$_SESSION['entityId']="8a8294185d6038bb015d668f275a0baa";
$_SESSION['userId']="8a8294185d6038bb015d668e35370ba6";
$_SESSION['password']="3N6FaxqfM6";
**/
/*
**Low Risk - DATAFAST*/
$entityId="8a8294185a65bf5e015a6c8b89a10d8d";
/*$_SESSION['userId']="8a8294185a65bf5e015a6c8b2f690d8b";
$_SESSION['password']="RkjpyNNE8s";*/


/**DF Nuevo conector*/
/*$_SESSION['entityId']="8ac7a4c771df15300171dffe0be30608";
/*$_SESSION['userId']="8a8294185a65bf5e015a6c8b2f690d8b";
$_SESSION['password']="RkjpyNNE8s";*/



/**DATACODE - DATAFAST*/
/*
$_SESSION['entityId']="8ac7a4c9696b925001696dbdde7305a8";
$_SESSION['userId']="8a8294185a65bf5e015a6c8b2f690d8b";
$_SESSION['password']="RkjpyNNE8s";*/






/*$_SESSION['entityId']="8acda4ca619ea4520161aebc3fa33484";
$_SESSION['userId']="8acda4ca619ea4520161aeb5c6463457";
$_SESSION['password']="NNZZa2mAZ4";*/


//print_r(htmlentities($finger));break;

/*
	Datos clientes creados en ReD Shield
	Bespoke #1:
	Entity Id: 8a8294185a65bf5e015a6c8db0110da2
	UserId: 8a8294185a65bf5e015a6c8d48aa0da0
	Password: YCh9TEKGHD
	 
	Intermediate #1:
	Entity Id: 8a8294185a65bf5e015a6c8cd8980d98
	UserId: 8a8294185a65bf5e015a6c8c728c0d95
	Password: bfqGqwQ32X
	 
	Sector:
	Low Risk Sector
	Entity Id: 8a8294185a65bf5e015a6c8b89a10d8d
	UserId: 8a8294185a65bf5e015a6c8b2f690d8b
	Password: RkjpyNNE8s

	Clarito
	Entity Id: 8a8294185868aca901586e161baa10be
	UserId: 8a8294185868aca901586e13d31b10ae
	Password: fJ74awjGhc
*/
function request($entityId, $items, $total,$iva,$totaTarifa12,$totalBase0,$email, $primer_nombre, $segundo_nombre, $apellido, $cedula, $trx,$ip_address, $finger,$merchterm,
	$telefono, $direccion_cliente, $pais_cliente, $direccion_entrega, $pais_entrega, $postcode) {
	$finger = urlencode($finger);
	$i = 0;
	$url = "https://test.oppwa.com/v1/checkouts";
	$iva 			=  str_replace('.', '', $iva); 
	$totaTarifa12 	=  str_replace('.', '', $totaTarifa12); 
	$totalBase0 		=  str_replace('.', '', $totalBase0); 
	$valueIva 		= str_pad($iva, 12, '0', STR_PAD_LEFT);
	$valueTotalIva 	= str_pad($totaTarifa12, 12, '0', STR_PAD_LEFT);
	$valueTotalBase0= str_pad($totalBase0, 12, '0', STR_PAD_LEFT);	
	$data = "entityId=".$entityId.
		"&amount=".$total.
		"&currency=USD".
		"&paymentType=DB".
		"&customer.givenName=".$primer_nombre.
		"&customer.middleName=".$segundo_nombre.
		"&customer.surname=".$apellido.
		"&customer.ip=".$ip_address.
		"&customer.merchantCustomerId=000000000001".
		"&merchantTransactionId=transaction_".$trx.		
		"&customer.email=".$email.
		"&customer.identificationDocType=IDCARD".		
		"&customer.identificationDocId=".$cedula.
		"&customer.phone=".$telefono.
		"&billing.street1=".$direccion_cliente.
		"&billing.country=".$pais_cliente.
		"&billing.postcode=".$postcode.
		"&shipping.street1=".$direccion_entrega.
		"&shipping.country=".$pais_entrega.
		/*"&recurringType=INITIAL".*/
		"&risk.parameters[USER_DATA2]=DATAFAST".		
		"&customParameters[".$merchterm."]=00810030070103910004012".$valueIva."05100817913101052012".$valueTotalBase0."053012".$valueTotalIva;
		
	foreach ($items["cart"] as $c) {
		
		$data.= "&cart.items[".$i."].name=".$c["product_name"];
		$data.= "&cart.items[".$i."].description="."Descripcion: ".$c["product_name"];
		$data.= "&cart.items[".$i."].price=".$c["product_price"];
		$data.= "&cart.items[".$i."].quantity=".$c["q"];		
		$i++;
	}
	
	$data .="&testMode=EXTERNAL";
	$token = "OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhiMmY2OTBkOGJ8UmtqcHlOTkU4cw==";
		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization:Bearer '.$token));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);
	return $responseData;
}

$baseUrl = "http://127.0.0.1/shopping/payment.php";

if(!is_float($totalBaseIva))
	$totalBaseIva= number_format((float)$totalBaseIva, 2, '.', '');

if(!is_float($totalBase0))
	$totalBase0 = number_format((float)$totalBase0, 2, '.', '');

$iva =  $totalBaseIva * 0.12;
$iva =  round($iva,2);
$iva = number_format((float)$iva, 2, '.', '');

$total = $totalBaseIva + $iva + $totalBase0; //Monto total de la transaccion
$total = number_format((float)$total, 2, '.', '');

//fwrite($file, "[".$date->format('Y-m-d H:i:sP')."] Se invoca el método1:" . PHP_EOL);	
$responseData = request($entityId, $items_details, $total,$iva,$totalBaseIva,$totalBase0, $email, $primer_nombre, $segundo_nombre, $apellido,$cedula, $trx, 
$ip_address, $finger,$merchterm, $telefono, $direccion_cliente, $pais_cliente, $direccion_entrega, $pais_entrega, $postcode);
$json = json_decode($responseData, true);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../card.min.css">
<style>
.button {width: 100%}
@media (min-width: 460px) {
  /* this rule applies only to devices with a minimum screen width of 480px */
	
	.input, .button {
	height: 44px;
	width: 100%;
	}
}



</style>

</head>
<script type='text/javascript' src="../jquery-3.2.1.js">
</script>
<script type='text/javascript' src="../bootstrap.min.js">
</script>

<body class="well">



<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?php echo $json['id'] ?>"></script>



<div class="container">
	<div class="row">
		<div class="col-md-12">
			<img src="../imagenes/logo-datafast.png" >
		</div>
		<div class="col-md-12">
		<h1>Portal de compras</h1>
					<nav class="navbar navbar-default">
					  <div class="container-fluid">
					    <div class="navbar-header">
					      <a class="navbar-brand active" href="#">Datafast S.A.</a>
					    </div>
					    <ul class="nav navbar-nav" >					      
					      <li><a href="../cart.php">Carrito de Compras</a></li>					      					      
					    </ul>
					  </div>
					</nav>
					<br><br><hr>
			
		</div>
		<div class="col-md-12">
			<form action="<?php echo $baseUrl ?>" class="paymentWidgets" data-brands="VISA MASTER DINERS DISCOVER AMEX ALIA CREDISENSA">	
			</form>
		</div>
		<div class="row">
		<div class="col-md-12 text-center">
		<!-- <img src="../imagenes/marcas.png"> -->
		</div>
	</div>
	<p>Powered by <a href="http://www.datafast.com.ec/" target="_blank">Datafast</a></p>	
	</div>
</div>
</body>
<!-- <script type="text/javascript" src="../js/dfExpiryException.js">
</script> -->


<script type="text/javascript">
//disabledDate();
  	var wpwlOptions = {
  	  onReady: function() {  
	
			var numberOfInstallmentsHtml = '<div class="wpwl-label wpwl-label-custom" style="display:inline-block">Diferidos:</div>' +
              '<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">' +
              '<select name="recurring.numberOfInstallments"><option value="0">0</option><option value="3">3</option><option value="6">6</option><option value="9">9</option></select>' +
              '</div>'; 
			$('form.wpwl-form-card').find('.wpwl-button').before(numberOfInstallmentsHtml);
			
            /*var frecuente = '<div class="wpwl-label wpwl-label-custom" style="display:inline-block">Intereses:</div>' +
              '<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">' +
              '<select name="customParameters[SHOPPER_interes]"><option value="0">No</option><option value="1">Si</option></select>' +
              '</div>'; 
            $('form.wpwl-form-card').find('.wpwl-button').before(frecuente);
            var gracia = '<div class="wpwl-label wpwl-label-custom" style="display:inline-block">Meses de Gracia:</div>' +
              '<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">' +
              '<select name="customParameters[SHOPPER_gracia]"><option value="0">No</option><option value="1">Si</option></select>' +
              '</div>'; 
			$('form.wpwl-form-card').find('.wpwl-button').before(gracia);*/
			
			var tipocredito = 
              '<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">' +
              'Tipo de crédito:<select name="customParameters[SHOPPER_TIPOCREDITO]"><option value="00">Corriente</option>'+
			  '<option value="01">Dif Corriente</option>' +
			  '<option value="02">Dif con int</option>' +
			  '<option value="03">Dif sin int</option>' +
			  '<option value="07">Dif con int + Meses gracia</option>' +
			  '<option value="09">Dif sin int + Meses gracia</option>' +
			  '<option value="21">Dif plus cuotas</option>' +
			  '<option value="22">Dif plus</option>' +
              '</div>'; 
            $('form.wpwl-form-card').find('.wpwl-button').before(tipocredito);
      
            
            var datafast= '<br/><br/><img src='+'"https://www.datafast.com.ec/images/verified.png" style='+'"display:block;margin:0 auto; width:100%;">';
			$('form.wpwl-form-card').find('.wpwl-button').before(datafast);
			var alia= '<img src='+'"https://www.datafast.com.ec/images/alia.png" style='+'"display:block;margin:0 auto; width:10%;">';
			$('form.wpwl-form-card').find('.wpwl-button').before(alia);

			
			/**	var regresar = 
              '<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">' +
              '<button type="button" onclick="history.back()" class="btn btn-success" >Regresar</button>' +
              '</div>'; 
            $('form.wpwl-form-card').find('.wpwl-button').before(regresar);**/
			
			
			        
          },              
          style: "card",
          locale: "es",
		  showCVVHint: true,                      
          labels: {cvv: "CVV", cardHolder: "Nombre(Igual que en la tarjeta)", insertCode:"Ingrese el codigo"},		  
		  brandDetectionPriority: ["ALIA", "MASTER", "CREDISENSA"],
		  onBeforeSubmitCard: function(){ 
							if ( $(".wpwl-control-cardHolder").val() === "" ){ 
							$(".wpwl-control-cardHolder").addClass("wpwl-has-error"); 
							$(".wpwl-control-cardHolder").after("<div class='wpwl-hint-cardHolderError'>Campo requerido</div>"); 
							$(".wpwl-button-pay").addClass("wpwl-button-error").attr("disabled", "disabled"); 
							return false; 
						}else{
							<?php
								//fwrite($file, "[".$date->format('Y-m-d H:i:sP')."] Presiona PAGAR:" . PHP_EOL);	
							?>
								return true;								

						} 		
						
						<?php //fclose($file); ?>

				},
		  onError : function(error) {
				// check if shopper payed after 30 minutes aka checkoutid is invalid
				if (error.name === "InvalidCheckoutIdError") {
					console.log("Tiempo expirado, por favor regresar al carrito de compras");
					var regresar = 
					'<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">' +
					'<button type="button" onclick="history.back()" class="btn btn-success" >Regresar</button>' +
					'</div>'; 
					$('form.wpwl-form-card').find('.wpwl-button').before(regresar);
					
				} else if (error.name === "WidgetError") {
					alert("No completó el pago");
					console.log("here we have extra properties: ");
					console.log(error.brand + " and " + error.event);
				} else if (error.name === "PciIframeCommunicationError") {
					console.log("No se estableció comunicación, por favor revisar la conexión");
					console.log("here we have extra properties: ");
					console.log(error.brand + " and " + error.event);
				}
				// read the error message
				console.log(error.message);
			}
      }
	

</script>


</html>
