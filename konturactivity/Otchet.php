<?php
if(isset($_REQUEST['element_id']))
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/bx_root.php");

	if (file_exists($_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/html_pages/.enabled")){
		require_once(dirname(__FILE__)."/../lib/composite/responder.php");
		Bitrix\Main\Composite\Responder::respond();
	};

	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	if(!CModule::IncludeModule("iblock"))	{
		echo 'iblock module not connect';
	}else{
		($res = CIBlockElement::GetByID($_REQUEST["element_id"]));
        
		
		if($element = $res->GetNext())
		{
			($db_props = CIBlockElement::GetProperty($element["IBLOCK_ID"], $_REQUEST["element_id"], array("sort" => "asc"), Array("CODE"=>"OTVET")));
			if($ar_props = $db_props->Fetch())
			{
				$result = $ar_props[VALUE][TEXT];
			};
			($result=(json_decode($result,true)));
			$checkType=$result[checkType];
			if ($checkType=='Fssp'){
				$tr.='';
				function recursion($arr){
					foreach ($arr as $key => $value) {
						$arr_key = array('number' =>'Номер исполнительного производства' , 
										'startDate'=>'Дата начала исполнительного производства',
										'endDate'=>'Дата окончания исполнительного производства. Заполняется, если исполнительное производство завершено',
										'endReason'=>'	Причина завершения исполнительного производства. Заполняется, если исполнительное производство завершено',
										'subject'=>'Описание должника, которое было указано в исполнительном производстве',
										'region'=>'	Регион, в котором заведено исполнительное производство',
										'enforcement'=>'Предмет исполнительного производства',
										'sum'=>'Сумма исполнительного производства',
										'document'=>'Реквизиты исполнительного документа',
										'department'=>'	Департамент, который назначил исполнительное производство',
										'bailiff'=>'Cудебный пристав',
										'url'=>'Ссылка'
									);
						if (is_array($value)) {
							$tr.='<tr><td colspan="2" id="style1" style="background-color: yellow" align="center">'.($key+1).'</td></tr>';
							$tr.=recursion($value);
						}else{
							$tr.='<tr>';
							$tr.='<td id="style1" style="font-weight: bold; align="center">'.$arr_key[$key].'</td>';
							if ($key!='url'){
								$tr.='<td id="style1" align="center">'.$value.'</td></tr>';
							}else{
								$tr.='<td id="style1" align="center" >'."<a href=$value>$value</a>".'</td>';
							}	
						}

						}
					return $tr;
				}
				$tr.=recursion($result[fssp][result][proceedings]);

			}elseif($checkType=='Rosfinmonitoring'){
					$tr.='<tr><td id="style1" style="font-weight: bold; align="center">'.'Перечень распространителей оружия МУ'.'</td>';
				if ($result[rosfinmonitoring][result][person][distributorsWMD][found]){
					$tr.='<td id="style1" style="font-weight: bold; align="center">'.'Найден'.'</td></tr>';
				}else{
					$tr.='<td id="style1" style="font-weight: bold; align="center">'.'Не найден'.'</td></tr>';
				};
				echo($result[rosfinmonitoring][result][person][terrorist][foundItems][0]);
					$tr.='<tr><td id="style1" style="font-weight: bold; align="center">'.'Перечень террористов и экстремистов'.'</td>';
				if (is_null($result[rosfinmonitoring][result][person][terrorist][foundItems][0])){
					$tr.='<td id="style1" style="font-weight: bold; align="center">'.'Не найден'.'</td></tr>';
				}else{
					$tr.='<td id="style1" style="font-weight: bold; align="center">'.'Найден'.'</td></tr>';
				}
			}elseif($checkType=="Passport"){
				$arr = [	'Valid' => 'Паспорт действителен',
							'NotFound' =>'По указанным реквизитам паспорта нет данных в МВД',
							'Expired'=>'Истек срок действия паспорта',
							'Replaced'=>'Паспорт был заменен на новый',
							'IssuedWithViolation'=>'Паспорт был выдан с нарушением',
							'WantedByLaw'=>'Паспорт числится в розыске',
							'Destroyed'=>'Паспорт изъят, уничтожен',
							'OwnerDied'=>'Паспорт недействителен в связи со смертью владельца',
							'Defected'=>'Технический брак паспорта',
							'Lost'=>'Паспорт утрачен'
						];
				$tr.='<tr><td id="style1" style="font-weight: bold; align="center">'.'Паспорт'.'</td>';
				$tr.='<td id="style1" style="font-weight: bold; align="center">'.$arr[$result[passport][result][state]].'</td></tr>';
		}

      	?>
      	<!doctype html>
      	<html lang="en">
      	<head>
      		<meta charset="utf-8">
      		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css">

		<title><?echo $element['NAME'];?></title>
      	</head>
      	<title><?echo $element['NAME'];?></title>
      	<body>
      	<body style="background-color:#F8F8F8">
				<div style="background-color: white" class="container-fluid">
					<table id="table2" style="vertical-align: top;">
						<?php echo $tr;?>
					</table>
				</div>
      			<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>
				<style type="text/css">
					@media print {
						@page {
 							size: landscape;
						}
					}
					html, body, .container-fluid {
					}
					#table2 {
					text-align: center;
					border-collapse: collapse;
					border: 1px solid #ddd;
					border-spacing: 10px;
					border-radius: 3px;
					background: #fdfdfd;
					font-size: 15px;
					font-family: Times New Roman;
					width: 100%;
					}
					#style1 {
						padding: 3px;
						border: 1px solid black;
					}
					#table1 {
						border-collapse: separate;
						width: 100%;
					}
					.container-fluid {
						padding: 1% 3%;
						font-size: 15px;
						font-family: Times New Roman;
						width: 90%;
						<!--border: 0.5px solid gray;-->
					}
					a:link {
  color: #497DDD; 
  border-bottom: 1px dashed; 
}
a:visited {
  color: #EF7D55;
}
a:hover {
  color: #154088; 
  border-bottom: .07em solid;
}
a:active {
  color: #497DDD; 
  border-bottom: 1px dashed;
}
				</style>
      </body>
      </html>

      <?php
    }
}
}else{
	echo 'token not found';
};

?>