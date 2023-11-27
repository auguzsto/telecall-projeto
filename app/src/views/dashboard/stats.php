<?php
use App\controllers\ProfileController;
use App\controllers\UserController;

$userController = new UserController();
$profileController = new ProfileController();

$dataPoints = array(
	array("label" => "Usuários", "y" => count($userController->findAll())),
    array("label" => "Perfis", "y" => count($profileController->findAll())),
    array("label" => "Modelos para relatórios", "y" => 2),
);
	
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "Estatísticas"
	},
	axisY: {
		title: "Números"
	},
	data: [{
		type: "column",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>            