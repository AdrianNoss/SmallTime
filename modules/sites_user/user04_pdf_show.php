<?php
//echo "<hr>Oeffne :".date("Y.m", $_time->_timestamp).".pdf<hr>";
$_file = "./Data/".$_user->_ordnerpfad."/Dokumente/".date("Y.m", $_time->_timestamp).".pdf";
echo $_file;
echo "<iframe src='".$_file."' height='700' width='100%'></iframe>";
?>