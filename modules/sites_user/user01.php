<?php  
/********************************************************************************
* Small Time
/*******************************************************************************
* Version 0.83
* Author:  IT-Master GmbH
* www.it-master.ch / info@it-master.ch
* Copyright (c) , IT-Master GmbH, All rights reserved
*******************************************************************************/
// Settings des Templates mit Bootstrap
//echo "--". $_template->_bootstrap ."--";
if ($_template->_bootstrap){
?>
	<ul class="nav nav-tabs adminmenu">	
                <?php  if($_settings->_array[13][1]) {?><li<?php echo $_action=="anwesend" ?  ' class="active"':''; ?>><a id="Liste" title="Anwesenheitsliste" href="?action=anwesend">Liste</a></li> <?php }?>
                <li<?php echo $_action=="show_time" ?  ' class="active"':''; ?>><a id="Home" title="Home" href="?action=show_time">Home</a></li> 
                <li<?php echo $_action=="show_year" ?  ' class="active"':''; ?>><a id="Jahr" title="Jahres�bersicht" href="?action=show_year">Jahr</a></li>
                <li<?php echo $_action=="show_pdf" ?  ' class="active"':''; ?>><a id="PDF" title="PDF anzeigen" href="?action=show_pdf">PDF</a></li>
              <?php if($_settings->_array[20][1]==0){ ?>
		 <li<?php echo $_action=="print_month" ?  ' class="active"':''; ?>>
			<a id="Drucken" title="Monats�bersicht drucken" href="?action=print_month&timestamp=<?php echo $_time->_timestamp ?>&print=0">Drucken</a>
		 </li>
		<?php } elseif($_settings->_array[20][1] >= date("j", time())){	?>
		 <li<?php echo $_action=="print_month" ?  ' class="active"':''; ?>>
		 	<a id="Drucken" title="Monats�bersicht vom letzten Monat drucken" href="?action=print_month&timestamp=<?php echo $_time->_timestamp ?>&print=0">Drucken</a>
		 </li>
		<?php } ?>
		 <?php  if($_settings->_array[24][1]){ ?>
                <li<?php echo $_action=="design" ?  ' class="active"':''; ?>><a id="Design" title="Design" href="?action=design">Design</a></li> 
                <?php } ?>
		  <li<?php echo $_action=="show_time" ?  ' class="active"':''; ?>>
		<?php
		// ----------------------------------------------------------------------------
		// Jahresanzeige und Wahl
		// ---------------------------------------------------------------------------- 
		echo "
		<table height='35'  border='0' cellpadding='0' cellspacing='0'>
		<tr>";
		$_startjahr = date("Y",$_user->_BeginnDerZeitrechnung);		// User - Einstellungen
		$_w_jahr	= $_time->_jahr;								// Gew�hltes Jahr
		$_nextjahr	= date("Y",time());								// n�chstes Jahr
		if ($_startjahr<$_w_jahr) {
			$_timestampv = mktime(0, 0, 0, 1, 1, $_w_jahr-1);
			echo "
			<td class='td_background_menue' valign='middle' align='center' width='35'>
				<a title='zur�ck' href='?action=show_time&timestamp=$_timestampv'><img src='images/icons/control_rewind.png' border=0></a>
			</td>";
		}
		echo "
			<td valign='middle' align='center' class='td_background_menue' width='45'>";
		echo $_w_jahr;
		echo "
			</td>";
		if ($_nextjahr >= $_w_jahr){ 
			$_timestampn = mktime(0, 0, 0, 1, 1, $_w_jahr+1);
			echo "
			<td valign='middle' align='center' class='td_background_menue' width='35'>
				<a title='vorw�rts' href='?action=show_time&timestamp=$_timestampn'><img src='images/icons/control_fastforward.png' border=0></a>
			</td>";
			}
		echo "
		</tr></table>";
		?>		
		</li>
        </ul>
<?php 
}else{ 
	echo "<table width='400'  border='0' cellpadding='2' cellspacing='0'><tr><td valign='midle'>";
	if($_settings->_array[13][1]) echo "<a title='Anwesenheits�bersicht' href='?action=anwesend'><img src='images/icons/report_user.png' border=0></a> ";
	if($_settings->_array[13][1]) echo "</td><td valign='middle'>";
	if($_settings->_array[13][1]) echo " | ";
	echo "</td><td valign='middle'>";
	echo "<a title='Home' href='?action=show_time'><img src='images/icons/house.png' border=0></a> ";
	echo "</td><td valign='middle'>";
	echo " | ";
	$_timestamp = mktime($_w_stunde, $_w_minute, $_w_sekunde, $_w_monat, $_w_tag, $_w_jahr);
	echo "</td><td valign='middle'>";
	echo "<a title='Jahres�bersicht' href='?action=show_year'><img src='images/icons/table_multiple.png' border=0></a> ";
	echo "</td><td valign='middle'>";
	echo " | ";
	echo "</td><td valign='middle'>";

	//----- INFO wurde entfernt - PDF
	//echo "<a title='Information' href='?action=info'><img src='images/icons/information.png' border=0></a> ";
	//echo "</td><td valign='middle'>";
	//echo " | ";
	//echo "</td><td valign='middle'>";
	echo "<a title='Vorhandene PDF' href='?action=show_pdf'><img src='images/icons/page_white_acrobat.png' border=0></a> ";
	echo "</td><td valign='middle'>";
	echo " | ";

	if($_settings->_array[20][1]==0){	
	//--------------------------------------------------------------------------------------------------------
	//Druck auf 2 Seiten print=1, bei Druck auf einer Seite nur 4 Stempelzeiten anzeigbar (breite der Spalte)
	//--------------------------------------------------------------------------------------------------------
	echo "</td><td valign='middle'>";
	echo "<a title='Monats�bersicht drucken' href='?action=print_month&timestamp=". $_time->_timestamp."&print=0'><img src='images/icons/printer.png' border=0></a> ";
	echo "</td><td valign='middle'>";
	echo " | ";
	} elseif($_settings->_array[20][1] >= date("j", time())){	
	//--------------------------------------------------------------------------------------------------------
	//wenn z.B. 20 eingestellt ist, wird nur der letzte Monat gedruckt
	//--------------------------------------------------------------------------------------------------------
	echo "</td><td valign='middle'>";
	echo "<a title='Monats�bersicht vom letzten Monat drucken' href='?action=print_month&timestamp=". $_time->_timestamp."&print=0'><img src='images/icons/printer.png' border=0></a> ";
	echo "</td><td valign='middle'>";
	echo " | ";
	}
	 if($_settings->_array[24][1]){
	//Version 0.6 Desing w�hlen - wird in Cookie gespeichert
	echo "</td><td valign='middle'>";
	echo "<a title='Design' href='?action=design'><img src='images/icons/color_wheel.png' border=0></a> ";
	echo "</td><td valign='middle'>";
	}
	//in Entwicklung ----------------------------------------------------------
	//Mehrfacheintr�ge
	//echo " | ";
	//echo "</td><td valign='middle'>";
	//echo "        <a href='?action=add_absenz_serie&timestamp=$_timestamp' title='Mehrfacheintr�ge f�r Abwesenheiten'><img src='images/icons/arrow_refresh.png' border='0'></a>";
	//echo "</td><td width=100 valign='middle'>";
	//in Entwicklung ----------------------------------------------------------
	echo "&nbsp;";
	echo "</td>";

	// ----------------------------------------------------------------------------
	// Jahresanzeige und Wahl
	// ---------------------------------------------------------------------------- 
	$_startjahr = date("Y",$_user->_BeginnDerZeitrechnung);		// User - Einstellungen
	$_w_jahr	= $_time->_jahr;								// Gew�hltes Jahr
	$_nextjahr	= date("Y",time());								// n�chstes Jahr
	if ($_startjahr<$_w_jahr) {
		$_timestampv = mktime(0, 0, 0, 1, 1, $_w_jahr-1);
		echo "<td class='td_background_menue' valign='middle' align='center' width='20'><a title='zur�ck' href='?action=show_time&timestamp=$_timestampv'><img src='images/icons/control_rewind.png' border=0></a></td>";
	}
	echo "<td valign='middle' align='center' class='td_background_menue' width='45'>";
	echo $_w_jahr;
	echo "</td>";
	if ($_nextjahr >= $_w_jahr){ 
		$_timestampn = mktime(0, 0, 0, 1, 1, $_w_jahr+1);
		echo "<td valign='middle' align='center' class='td_background_menue' width='20'><a title='vorw�rts' href='?action=show_time&timestamp=$_timestampn'><img src='images/icons/control_fastforward.png' border=0></a></td>";
		}
	echo "</tr></table>";
 }
 ?>