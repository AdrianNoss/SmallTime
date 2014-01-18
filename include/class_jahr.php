<?php
/*******************************************************************************
* Jahresberechnung
/*******************************************************************************
* Version 0.8
* Author:  IT-Master GmbH
* www.it-master.ch / info@it-master.ch
* Copyright (c) , IT-Master GmbH, All rights reserved
*******************************************************************************/
class time_jahr{
		
	public $_jahr 		= NULL;		// welches Jahr soll berechnet werden
	public $_summe_t	= NULL;		// Summe seit Beginn inkl. Übertrag
	public $_summe_F	= NULL;		// Feriensumme
	public $_summe_vorholzeit;
	
	
	public $_saldo_t	= NULL;		// Zeitsaldo
	public $_saldo_F	= NULL;		// Feriensaldo
		
	public $_ordnerpfad	= NULL;		// Pfad zu den Daten
	public $_startjahr 	= NULL;		// Beginn der Zeitrechnung in den User - Einstellungen
	public $_startmonat	= NULL;		// Beginn der Zeitrechnung in den User - Einstellungen
	public $_array		= NULL;		// Array des Jahres
	public $_data		= NULL;		// Array der Daten
	
	public $_Ferien_pro_Jahr;
	public $_Stunden_uebertrag; 		
	public $_Ferienguthaben_uebertrag;
	//public $Ferien_pro_Jahr; 		
    public $_Vorholzeit_pro_Jahr; 	
	
	function __construct($ordnerpfad, $jahr, $startjahr, $Stunden_uebertrag, $Ferienguthaben_uebertrag, $Ferien_pro_Jahr, $Vorholzeit_pro_Jahr){	
		
		//echo $Ferienguthaben_uebertrag."hhhhhhhhhhh";
		
		$this->_ordnerpfad 					= $ordnerpfad;
		$this->_jahr 						= $jahr;
		// Jahr auf aktuell setzten falls kein Endjahr angegeben ist
		if ($jahr==0) $this->_jahr = date("Y", time());
		$this->_startjahr 					= date("Y",$startjahr);
		$this->_startmonat 					= date("n",$startjahr);
		$this->_Stunden_uebertrag 			= $Stunden_uebertrag;
		$this->_Ferienguthaben_uebertrag 	= $Ferienguthaben_uebertrag;
		$this->_Ferien_pro_Jahr 			= $Ferien_pro_Jahr;
		$this->_Vorholzeit_pro_Jahr 		= $Vorholzeit_pro_Jahr;		
		// Schleife - Startjahr bis heute
		//echo "start = ". $this->_summe_t. "<hr>";
		for($i=$this->_startjahr; $i<=$this->_jahr; $i++){
			$this->set_ueberschriften($i);
			$file = "./Data/".$ordnerpfad."/Timetable/" . $i;
			// Falls die Datei nicht existiert eine leere erstellen
			if (!file_exists($file)) {
				$fp = fopen($file, "w");
				fclose($fp); 
			}
			$this->_data[$i] = file($file);
			$z=0;
			// Schleife - Monats Daten in der Jahres Datei 
			foreach($this->_data[$i] as $zeile){
				$this->_data[$i][$z] = explode(";", $this->_data[$i][$z]);
				//echo "Monat : $i.$z / ".$this->_summe_t . " + " . $this->_data[$i][$z][0] . " = ";
				$this->_summe_t = $this->_summe_t + $this->_data[$i][$z][0];
				// Feriensumme über alle Jahre
				$this->_summe_F = $this->_summe_F + $this->_data[$i][$z][1];	
				//echo $this->_summe_t ."<br>";
				//echo "Jahr $i.$z = ". $this->_summe_t. "<hr>";			 
				$z++;
			}
			// Jährliches Ferienguthaben hinzufügen
			//echo $i." ferien : " . $this->calc_Ferien($i) ."<br>";
			$this->_saldo_F = $this->_saldo_F + $this->calc_Ferien($i);
			// Jährliche Vorholzeit - Summe
			$this->_summe_vorholzeit = $this->_Vorholzeit_pro_Jahr+$this->_summe_vorholzeit;
			//echo "Vorholzeit einberechnen : " .$this->_Vorholzeit_pro_Jahr . "<br>";
		}
		// Saldo der Ferien inkl. Übertrag berechnen
		$this->_saldo_F = $this->_saldo_F - $this->_summe_F + $this->_Ferienguthaben_uebertrag;
		//runden auf 2 Stellen 
		$this->_saldo_F = round($this->_saldo_F,2);
		// Vorholzeiten abrechnen und Übertrag hinzufügen
		$this->_saldo_t = $this->_summe_t - $this->_summe_vorholzeit + $this->_Stunden_uebertrag ;	
		//echo "&Uml;bertrag der Stunden - Beginn: ".$this->_Stunden_uebertrag."<br>";
		//echo "saldo : ". $this->_saldo_t . "<hr>";
		$this->savetotal();
	}
	function __destruct(){
	}
	function savetotal(){
		$_zeilenvorschub = "\r\n";
		$totalfie = "./Data/".$this->_ordnerpfad."/Timetable/total.txt";
        $fp = fopen($totalfie,"w+");
        fputs($fp, $this->_saldo_t);
		fputs($fp, $_zeilenvorschub);
		fputs($fp, $this->_saldo_F);
        fclose($fp);
	}
	function calc_Ferien($i){
		// Falls der Startmonat nicht der Januar ist, Guthaben berechnen
		if($this->_startmonat > 1 && $this->_startjahr == $i){
			$Ferien = round(($this->_Ferien_pro_Jahr / 12 * (13-$this->_startmonat)),2);
		} else{
			$Ferien = $this->_Ferien_pro_Jahr;
		}	
		return 	$Ferien;
		//echo "ferien erstes Jahr :" . $ferienguthabenerstesJahr;
	}
	
	function set_ueberschriften($jahr){
		//Erweiterung für Jahresübersicht --- in Planung
		$this->_array[$jahr][0][0] = "Monat";
		$this->_array[$jahr][0][1] = "Saldo";	
		$this->_array[$jahr][0][2]	= "Soll";
		$this->_array[$jahr][0][3] = "Work";
		$this->_array[$jahr][0][4] = "Absenz";
		$this->_array[$jahr][0][5] = "F";
		$this->_array[$jahr][0][6] = "K";
		$this->_array[$jahr][0][7] = "U";
		$this->_array[$jahr][0][8] = "M";
		$this->_array[$jahr][0][9] = "I";
		$this->_array[$jahr][0][10]= "W";
		$this->_array[$jahr][0][11]= "E";
	}
	
}
?>