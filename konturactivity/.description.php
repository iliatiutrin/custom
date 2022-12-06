<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arActivityDescription = array(
	"NAME" => GetMessage("BPDA_DESCR_NAME"),
	"DESCRIPTION" => GetMessage("BPDA_DESCR_DESCR_1"),
	"TYPE" => "activity",
	"CLASS" => "KonturActivity",
	"JSCLASS" => "DelayActivity",
	"CATEGORY" => array(
		"ID" => "other",
	),
	"RETURN" => array(
		"Report" => array(
			"NAME" => GetMessage("BPDA_DESCR_REPORT"),
			"TYPE" => "string",
		),
		"Status" => array(
			"NAME" => GetMessage("BPDA_DESCR_REPORT"),
			"TYPE" => "string",
		),
	),
)
?>
