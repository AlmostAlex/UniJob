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
// Alle Bewerber je Thema 
if($art == 'allBEW' || $art == 'alleListen' ){
    for($i = 0; $i < count($themen); $i++){ 
    $ausgabe .= $themen[$i]['themenbezeichnung'] . ';'."\n";
    $ausgabe .= '"Nachname";"Vorname";"Matrikelnummer";"E-Mail";"Studiengang";"Fachsemester";"Credits";"Seminarteilnahme";"Punkte";"Status";'."\n";
        $bewerber = $this->bewerber($themen[$i]['thema_id']); for ($p = 0; $p < count($bewerber); $p++) {
            $ausgabe .= 
            $bewerber[$p]['nachname'] . ';' . 
            $bewerber[$p]['vorname'] . ';'.  
            $bewerber[$p]['matrikelnummer'] .';'. 
            $bewerber[$p]['email'] . ';' .
            $bewerber[$p]['studiengang'] . ';' . 
            $bewerber[$p]['fachsemester'] . ';' . 
            $bewerber[$p]['credits'] . ';' .  
            $bewerber[$p]['seminarteilnahme'] . ';' .
            $bewerber[$p]['gesamt_punkte'] . ';' .  
            $bewerber[$p]['status'] . ';' . "\n";

            }            
            $ausgabe .= "\n";
    }
}

// Alle Angenommenen Bewerber
if ($art =='AngBEW' || $art == 'alleListen'){
    if($art =='all'){ $ausgabe .= "\n\n"; } 
    $ausgabe .= '"Liste - Alle angenommenen Bewerber"; '."\n";
    $ausgabe .= '"Thema"; Nachname";"Vorname";"Matrikelnummer";"E-Mail";"Studiengang";"Fachsemester";"Credits";"Seminarteilnahme";"Punkte";'."\n";
    for($l = 0; $l < count($angBew); $l++){ 
        $ausgabe .= 
        $angBew[$l]['themenbezeichnung'] . ';' . 
        $angBew[$l]['nachname'] . ';' . 
        $angBew[$l]['vorname'] . ';'.  
        $angBew[$l]['matrikelnummer'] .';'. 
        $angBew[$l]['email'] . ';' .
        $angBew[$l]['studiengang'] . ';' . 
        $angBew[$l]['fachsemester'] . ';' . 
        $angBew[$l]['credits'] . ';' .  
        $angBew[$l]['seminarteilnahme'] . ';' . 
        $angBew[$l]['gesamt_punkte'] . ';' . "\n";
        
    } 
}

if ($art =='nachr' || $art == 'alleListen'){
    if($art =='alleListen'){ $ausgabe .= "\n"; } 
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

