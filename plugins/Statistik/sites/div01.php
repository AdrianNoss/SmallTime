<?PHP
/*******************************************************************************
* Small Time - Plugin : Statistik der Mitarbeiter (Überzeit, Ferien usw.)
/*******************************************************************************
* Version 0.86
* Author:  IT-Master GmbH
* www.it-master.ch / info@it-master.ch
* Copyright (c) , IT-Master GmbH, All rights reserved
*******************************************************************************/
if(!isset($_GET['jahr'])){
	$wahljahr = $_time->_jahr;
}else{
	$wahljahr = $_GET['jahr'];
}
?>
<table>
	<tr>
		<td class=td_background_tag><a href="?action=plugins&jahr=<?php echo ($wahljahr -1) ?>"><?php echo ($wahljahr -1) ?></a></td>
		<td class=td_background_info><a href="?action=plugins&jahr=<?php echo $wahljahr ?>"><?php echo $wahljahr ?></a></td>
		<td class=td_background_tag ><a href="?action=plugins&jahr=<?php echo ($wahljahr +1) ?>"><?php echo ($wahljahr +1) ?></a></td>
	</tr>
</table>





