<!DOCTYPE html>
<html>
	<head>
		<title>Pedidos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link rel="stylesheet" href="js/jquery.mobile.theme-1.4.3.css" />
		<link rel="stylesheet" href="js/jquery.mobile.structure-1.4.3.css" />
		<link rel="stylesheet" href="js/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="css/demo_table_jui.css" />
		<link rel="stylesheet" href="css/ui-darkness/jquery-ui-1.10.4.custom.css" />
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery.mobile-1.4.3.min.js"></script>
		<script src="js/jquery-ui-1.10.4.custom.js"></script>
		<script src="js/jquery.dataTables.js"></script>
<script>
	$(function() {
	clientTable = $("#client_table").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage": {
						"sUrl": "js/es_ES.txt"
					},
			"ajax":"controllers/cliente.php",
			"sAjaxDataProp":"User",
			"columns":[
			            { "mData": "codigo" },
                        { "mData": "nombre" },
                        { "mData": "direccion" }
			]
        });
     });
	$(document).on("pagecreate", function() {


	});
</script>
	</head>
	<body>

		<div data-role="page">

			<div data-role="header">
				<h1>Clientes</h1>
			</div><!-- /header -->

			<div role="main" class="ui-content">
<table id="client_table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="width:10%">Codigo</th>
            <th style="width:10%">Nombre</th>
            <th style="width:20%">Direccion</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
			</div><!-- /content -->

			<div data-role="footer">
				<h4>LinkSim</h4>
			</div><!-- /footer -->
		</div><!-- /page -->

	</body>
</html>
