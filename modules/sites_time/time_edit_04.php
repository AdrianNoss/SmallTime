<Form name="insert" action="?action=update_time&timestamp=<?php echo $_time->_timestamp ?>&token=<?php echo $token ?>" method="post" target="_self">
	<table width="100%" border="0" cellpadding="5" cellspacing="2">
		<tr>
			<td class=td_background_wochenende width="200" align=left>Datum : (Tag / Monat / Jahr)</td>
			<td class=td_background_tag align=left>
				<?php echo $_time->_tag."."; ?><input type="hidden" type="text" name="_w_tag" value="<?php echo $_time->_tag; ?>" size="4">
				<?php echo $_time->_monat."."; ?><input type="hidden" type="text" name="_w_monat" value="<?php echo $_time->_monat; ?>" size="4">
				<?php echo $_time->_jahr; ?><input type="hidden" type="text" name="_w_jahr" value="<?php echo $_time->_jahr; ?>" size="4">
			</td>
		</tr>

		<tr >
			<td class=td_background_wochenende align=left>Zeit : (Stunde:Minute)</td>
			<td class=td_background_tag align=left>
				<input type="text" name="_w_stunde" value="<?php echo $_time->_stunde; ?>" size="4">
				<input type="text" name="_w_minute" value="<?php echo $_time->_minute; ?>" size="4"></td>
		</tr>

		<tr>
			<td class=td_background_top>&nbsp;</td>
			<td class=td_background_top align=left>  
			<input type="submit" name="absenden" value="UPDATE" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="absenden" value="CANCEL" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type='submit'  name='absenden' value='DELETE' ></td>
		</tr>
		<tr>
			<td ><br><br><br><br><br><br><br></td>
			<td ></td>
		</tr>

		<tr>
			<td class=td_background_wochenende valign="middle">Stunde :</td>
			<td class=td_background_wochenende valign="middle" align=left>
				<?php
				for($z=5;$z<20;$z++){
					echo "<input type='button' value='$z' onclick='this.form._w_stunde.value = $z'>";
				}?></td>
		</tr>

		<tr>
			<td class=td_background_wochenende valign="middle">Minute :</td>
			<td class=td_background_wochenende valign="middle" align=left>
				<input type="button" value="0" onclick="this.form._w_minute.value = 0">
				<input type="button" value="15" onclick="this.form._w_minute.value = 15">
				<input type="button" value="30" onclick="this.form._w_minute.value = 30">
				<input type="button" value="45" onclick="this.form._w_minute.value = 45">
			</td>
		</tr>

	</table>
</Form>