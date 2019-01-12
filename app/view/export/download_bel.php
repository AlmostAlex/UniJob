<?php 
    ini_set('memory_limit', '1G');
    ini_set("auto_detect_line_endings", true);
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header("Content-disposition: attachment; filename=filename.csv");
    header("Pragma: public");
    set_time_limit(0);
    header("Expires: 0"); 


$ausgabe = ''; 

if($art=='all'|| $art=='verfTh'){ 
$ausgabe .= '"Liste - Thema erhalten"; '."\n";
$ausgabe .= '"Erhaltenes Thema";"Nachname";"Vorname";"Matrikelnummer";"E-Mail";"Studiengang";"Fachsemester";"Credits";"Seminarteilnahme";"Punkte";"Priorität 1";"Priorität 2";"Priorität 3";'."\n";
    for($k = 0; $k < count($bewerber); $k++){ 

    $ausgabe .= 
        $bewerber[$k]['themenbezeichnung'] .';'. 
        $bewerber[$k]['nachname'] .';'. $bewerber[$k]['vorname'] .';'. $bewerber[$k]['matrikelnummer'] .';'. $bewerber[$k]['email'] .';'. 
        $bewerber[$k]['studiengang'] .';'. $bewerber[$k]['fachsemester'] .';'. $bewerber[$k]['credits'] .';'. $bewerber[$k]['seminarteilnahme'] .';'. $bewerber[$k]['punkte'] .';'. 
        $bewerber[$k]['pri1'] .';'. $bewerber[$k]['pri2'] .';'. 
        $bewerber[$k]['pri3'] .';'.
        "\n";
    }
} else {}

    if($keinThemaCount > 0 && $art != 'verfTh' && $art=='all'||$art=='vergTh'){
        if($art =='all'){ $ausgabe .= "\n\n"; } 
        $ausgabe .= '"Liste - Kein Thema erhalten"; '."\n";
        $ausgabe .= '"Nachname";"Vorname";"Matrikelnummer";"E-Mail";"Studiengang";"Fachsemester";"Credits";"Seminarteilnahme";"Punkte";"Priorität 1";"Priorität 2";"Priorität 3"; '."\n";
            for($i = 0; $i < count($keinThema); $i++){ 
                $ausgabe .= $keinThema[$i]['nachname'] . ';' . $keinThema[$i]['vorname'] . ';'.  $keinThema[$i]['matrikelnummer'] .';'. 
                $keinThema[$i]['email'] . ';' .
                $keinThema[$i]['studiengang'] . ';' . 
                $keinThema[$i]['fachsemester'] . ';' . $keinThema[$i]['credits'] . ';' .  $keinThema[$i]['seminarteilnahme'] . ';' .
                $keinThema[$i]['punkte'] . ';' .
                $keinThema[$i]['pri1'] . ';' . $keinThema[$i]['pri2'] . ';' . $keinThema[$i]['pri3'] . ';' .  "\n";
            }       
    }

    if( ($art =='nachr' || $art=='all') && $cWH == 'true'){
        if($art =='all'){ $ausgabe .= "\n\n"; } 
        $ausgabe .= '"Liste - aus dem Nachrückverfahren"; '."\n";
        $ausgabe .= '"Thema";"Nachname";"Vorname";"Matrikelnummer";"E-Mail"; '."\n";

        for($k = 0; $k < count($anmeldungen); $k++){ 
            $ausgabe .= $anmeldungen[$k]['themenbezeichnung'] . ';'.  $anmeldungen[$k]['nachname'] . ';' . $anmeldungen[$k]['vorname'] . ';' . 
            $anmeldungen[$k]['matrikelnummer'] .';'. $anmeldungen[$k]['email'] . ';' .  "\n";
        } 
        
    } 


    echo $this->convertToWindowsCharset($ausgabe);
  die();
?>

