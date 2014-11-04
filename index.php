<?php
header('Content-Type: text/html; charset=UTF-8');
include_once "libs/tmpl.class.php";
include_once "libs/helpers.php";

$s = !empty($_GET["s"]) ? $_GET["s"]: "index";


$idioma = array('pt' => 'pt_BR', 'es' => 'es_AR', 'en' => 'en_US');
$lang = !empty($_GET["lang"]) ? $_GET["lang"]: "pt";
setcookie("GUEST_LANGUAGE_ID", $idioma[$lang]);


$paginaHtml = "html/".$idioma[$lang]."/$s.html";
$headHtml = "template/header.html";
if (file_exists($paginaHtml)) {
	$pagina = file_get_contents($paginaHtml);
	$head = file_get_contents($headHtml);

	preg_match("#<tplMeta>(.*)</tplMeta>#s", $pagina, $tplMeta);
	preg_match("#<tplHead>(.*)</tplHead>#s", $pagina, $tplHead);
	preg_match("#<tplHeader>(.*)</tplHeader>#s", $pagina, $tplHeader);
	preg_match("#<tplContent>(.*)</tplContent>#s", $pagina, $tplContent);

	$data = array(
		"tplMeta"  => !empty($tplMeta[1]) ? $tplMeta[1]:"",
		"tplHead"  => !empty($tplHead[1]) ? $head . $tplHead[1]: $head,
		"tplHeader"  => !empty($tplHeader[1]) ? $tplHeader[1]:"",
		"tplContent"  => !empty($tplContent[1]) ? $tplContent[1]:"",
		"fecha"  => strFecha($lang),
		"url" => $s.".html"
	);

	$html = new tmpl("template/brazil.".$idioma[$lang].".html", $data);
	$html->display();
}else{
	header("HTTP/1.0 404 Not Found");
}
?>
