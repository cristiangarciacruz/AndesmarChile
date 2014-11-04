<?php
	function strFecha($lang, $fecha = ''){
		$fecha = (empty($fecha)) ? date("Y-m-d"): $fecha;

		$fechas = json_decode(file_get_contents("includes/fechas.json"), true );

		$fechas = $fechas[ $lang ];

		$dia = $fechas["dias"][date("w", strtotime($fecha))];
		$mes = $fechas["meses"][date("n", strtotime($fecha)) -1];
		$anio = date("Y", strtotime($fecha));

		$nDia = date("d", strtotime($fecha));

		return $dia." ".$nDia." ".$mes." ".$anio;
	}