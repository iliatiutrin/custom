<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_CHECKTYPE_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'checktype', $arCurrentValues['checktype'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_SURNAME_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'surname', $arCurrentValues['surname'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_NAME_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'firstname', $arCurrentValues['firstname'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_PATRONYMIC_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'patronymic', $arCurrentValues['patronymic'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_BIRTH_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'birthDate', $arCurrentValues['birthDate'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_SERIES_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'series', $arCurrentValues['series'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_NUMBER_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'number', $arCurrentValues['number'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_ISSUEDATE_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'issueDate', $arCurrentValues['issueDate'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("API_ISSUERCODE_TEXT") ?>:</span></td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField("text", 'issuerCode', $arCurrentValues['issuerCode'])?>
	</td>
</tr>
<tr>
	<td align="right" width="40%"><?= GetMessage("CPAD_DP_TIME_SELECT") ?>:</td>
	<td width="60%">
		<input type="radio" name="time_type_selector" value="delay" id="time_type_selector_delay" onclick="SetDelayMode(true)"><label for="time_type_selector_delay"><?= GetMessage("CPAD_DP_TIME_SELECT_DELAY") ?></label><br />
		<input type="radio" name="time_type_selector" value="time" id="time_type_selector_time" onclick="SetDelayMode(false)"><label for="time_type_selector_time"><?= GetMessage("CPAD_DP_TIME_SELECT_TIME") ?></label>
		<script type="text/javascript">
			function SetDelayMode(val)
			{
				var f1 = document.getElementById('tr_time_type_selector_delay');
				var f2 = document.getElementById('tr_time_type_selector_time');

				if (val)
				{
					f2.style.display = 'none';
					try{
						f1.style.display = 'table-row';
					}catch(e){
						f1.style.display = 'inline';
					}
					document.getElementById('time_type_selector_delay').checked = true;
				}
				else
				{
					f1.style.display = 'none';
					try{
						f2.style.display = 'table-row';
					}catch(e){
						f2.style.display = 'inline';
					}
					document.getElementById('time_type_selector_time').checked = true;
				}
			}
		</script>
	</td>
</tr>
<tr id="tr_time_type_selector_delay">
	<td align="right" width="40%"><?= GetMessage("CPAD_DP_TIME") ?>:</td>
	<td width="60%">
		<?= CBPDocument::ShowParameterField('int', 'delay_time', $arCurrentValues["delay_time"], array('size' => 20)) ?>
		<select name="delay_type">
			<option value="s"<?= ($arCurrentValues["delay_type"] == "s") ? " selected" : "" ?>><?= GetMessage("CPAD_DP_TIME_S") ?></option>
			<option value="m"<?= ($arCurrentValues["delay_type"] == "m") ? " selected" : "" ?>><?= GetMessage("CPAD_DP_TIME_M") ?></option>
			<option value="h"<?= ($arCurrentValues["delay_type"] == "h") ? " selected" : "" ?>><?= GetMessage("CPAD_DP_TIME_H") ?></option>
			<option value="d"<?= ($arCurrentValues["delay_type"] == "d") ? " selected" : "" ?>><?= GetMessage("CPAD_DP_TIME_D") ?></option>
		</select>
		<?
		$delayMinLimit = CBPSchedulerService::getDelayMinLimit();
		if ($delayMinLimit): ?>
			<p style="color: red;">* <?= GetMessage("CPAD_PD_TIMEOUT_LIMIT") ?>: <?=CBPHelper::FormatTimePeriod($delayMinLimit)?></p>
		<?php endif; ?>
	</td>
</tr>
<tr id="tr_time_type_selector_time">
	<td align="right" width="40%"><?= GetMessage("CPAD_DP_TIME1") ?>:</td>
	<td width="60%">
		<?=CBPDocument::ShowParameterField('datetime', 'delay_date', $arCurrentValues["delay_date"])?>

		<br>
		<label><input type="radio" name="delay_date_is_local" value="N"
			<?=($arCurrentValues["delay_date_is_local"] !== 'Y') ? ' checked' : ''?>
		>
			<?=GetMessage('CPAD_DP_TIME_SERVER')?>
		</label>
		<br>
		<label><input type="radio" name="delay_date_is_local" value="Y"
			<?=($arCurrentValues["delay_date_is_local"] === 'Y') ? ' checked' : ''?>
		>
			<?=GetMessage('CPAD_DP_TIME_LOCAL')?>
		</label>
	</td>
</tr>
<tr>
	<td align="right" width="40%"></td>
	<td width="60%">
		<label><input
					type="checkbox"
					name="delay_write_to_log"
					value="Y"
					<?= ($arCurrentValues['delay_write_to_log'] === 'Y') ? ' checked' : '' ?>
		><?= GetMessage('CPAD_DP_WRITE_TO_LOG') ?></label>
	</td>
</tr>
<script type="text/javascript">
	SetDelayMode(<?= (empty($arCurrentValues['delay_date'])) ? 'true' : 'false' ?>);
</script>