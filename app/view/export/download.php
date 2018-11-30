<?php 

$ausgabe = ''; 

if($art=='all'|| $art=='verfTh'){ 
$ausgabe .= '"Liste - Thema erhalten"; '."\n";
$ausgabe .= '"Vorname";"Nachname";"E-Mail";"Matrikelnummer";"Erhaltenes Thema";"Priorität 1";"Priorität 2";"Priorität 3"; '."\n";
    for($k = 0; $k < count($bewerber); $k++){ 

    $ausgabe .= 
        $bewerber[$k]['vorname'] .';'. $bewerber[$k]['nachname'] .';'. $bewerber[$k]['email'] .';'. $bewerber[$k]['matrikelnummer'] .';'. 
        $bewerber[$k]['themenbezeichnung'] .';'. $bewerber[$k]['pri1'] .';'. $bewerber[$k]['pri2'] .';'. 
        $bewerber[$k]['pri3'] .';'. "\n";
    }
} else {}

    if($keinThemaCount > 0 && $art != 'verfTh' && $art=='all'||$art=='vergTh'){
        if($art =='all'){ $ausgabe .= "\n\n"; } 
        $ausgabe .= '"Liste - Kein Thema erhalten"; '."\n";
        $ausgabe .= '"Vorname";"Nachname";"E-Mail";"Matrikelnummer"; '."\n";
            for($i = 0; $i < count($keinThema); $i++){ 
                $ausgabe .= $keinThema[$i]['vorname'] . ';'. $keinThema[$i]['nachname'] . ';' . 
                $keinThema[$i]['email'] . ';' . $keinThema[$i]['matrikelnummer'] .';'. "\n";
            }       
    }

    if( ($art =='nachr' || $art=='all') && $cWH == 'true'){
        if($art =='all'){ $ausgabe .= "\n\n"; } 
        $ausgabe .= '"Liste - aus dem Nachrückverfahren"; '."\n";
        $ausgabe .= '"Thema";"Vorname";"Nachname";"E-Mail";"Matrikelnummer"; '."\n";

        for($k = 0; $k < count($anmeldungen); $k++){ 
            $ausgabe .= $anmeldungen[$k]['themenbezeichnung'] . ';'. $anmeldungen[$k]['vorname'] . ';' . 
            $anmeldungen[$k]['nachname'] . ';' . $anmeldungen[$k]['email'] . ';' . $anmeldungen[$k]['matrikelnummer'] .';'. "\n";
        } 
        
    } 

    function convertToWindowsCharset($string) {
        $charset =  mb_detect_encoding(
        $string,
        "UTF-8, ISO-8859-1, ISO-8859-15",
        true
      );
      $string =  mb_convert_encoding($string, "Windows-1252", $charset);
      return $string;
    }
    
    $str = convertToWindowsCharset($ausgabe);
    echo $str;

    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header("Content-disposition: attachment; filename=filename.csv");
    header("Pragma: public");
    header("Expires: 0"); 
  die();


?>

