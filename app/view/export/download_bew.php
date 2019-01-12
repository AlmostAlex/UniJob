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
            $ausgabe .= "\n\n";
    }
    echo $this->convertToWindowsCharset($ausgabe);
  die();
?>

