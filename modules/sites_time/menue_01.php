<?php
echo "<table width='100%' hight='100%' border='0' cellpadding='2' cellspacing='0'><tr><td valign='midle'>";
if($_settings->_array[13][1]) echo "<a title='Anwesenheitsübersicht' href='?action=anwesend'><img src='images/icons/report_user.png' border=0></a> ";
if($_settings->_array[13][1]) echo "</td><td valign='middle'>";
if($_settings->_array[13][1]) echo " | ";
echo "</td><td valign='middle'>";
echo "<a title='Home' href='index.php'><img src='images/icons/house.png' border=0></a> ";
echo "</td><td valign='middle'>";
echo " | ";
$_timestamp = mktime($_w_stunde, $_w_minute, $_w_sekunde, $_w_monat, $_w_tag, $_w_jahr);
echo "</td><td valign='middle'>";
echo "<a title='Information' href='?action=info'><img src='images/icons/information.png' border=0></a> ";
echo "</td><td valign='middle'>";
echo " | ";
echo "</td><td valign='middle'>";
echo "<a title='Vorhandene PDF' href='?action=show_pdf'><img src='images/icons/page_white_acrobat.png' border=0></a> ";
echo "</td><td valign='middle'>";
echo " | ";
echo "</td><td valign='middle'>";
//--------------------------------------------------------------------------------------------------------
//Druck auf 2 Seiten print=1, bei Druck auf einer Seite nur 4 Stempelzeiten anzeigbar (breite der Spalte)
//--------------------------------------------------------------------------------------------------------
echo "<a title='Monatsübersicht drucken' href='?action=print_month&timestamp=$_timestamp&print=0'><img src='images/icons/printer.png' border=0></a> ";
echo "</td><td valign='middle'>";
echo " | ";
//Version 0.6 Desing wählen - wird in Cookie gespeichert
echo "</td><td valign='middle'>";
echo "<a title='Design' href='?action=design'><img src='images/icons/color_wheel.png' border=0></a> ";
echo "</td><td valign='middle'>";
//in Entwicklung ----------------------------------------------------------
//Mehrfacheinträge
//echo " | ";
//echo "</td><td valign='middle'>";
//echo "        <a href='?action=add_absenz_serie&timestamp=$_timestamp' title='Mehrfacheinträge für Abwesenheiten'><img src='images/icons/arrow_refresh.png' border='0'></a>";
//echo "</td><td width=100 valign='middle'>";
//in Entwicklung ----------------------------------------------------------
echo "&nbsp;";
echo "</td>";
if ($_startjahr<$_w_jahr) {
        $_timestampv = mktime(0, 0, 0, 1, 1, $_w_jahr-1);
echo "<td class='td_background_menue' valign='middle'><a title='zurück' href='?action=show_time&timestamp=$_timestampv'><img src='images/icons/control_rewind.png' border=0></a></td>";}
echo "<td valign='middle' class='td_background_menue'>";
echo $_w_jahr;
echo "</td>";
if ($_endejahr >= $_w_jahr){
        $_timestampn = mktime(0, 0, 0, 1, 1, $_w_jahr+1);
echo "<td valign='middle' class='td_background_menue'><a title='vorwärts' href='?action=show_time&timestamp=$_timestampn'><img src='images/icons/control_fastforward.png' border=0></a></td>";}
echo "</tr></table>";
?>