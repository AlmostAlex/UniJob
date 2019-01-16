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

    $ausgabe .= $themenbezeichnung . ';'."\n";
    $ausgabe .= '"Nachname";"Vorname";"Matrikelnummer";"E-Mail";"Studiengang";"Fachsemester";"Credits";';
    if($kategorie=='Abschlussarbeit'){ $ausgabe .= '"Zulassung";';  } else{ $ausgabe .= "Seminarteilnahme"; } 
    $ausgabe .=  '"Punkte";"Status";'."\n";

      for ($p = 0; $p < count($bewerber); $p++) {
            $ausgabe .= 
            $bewerber[$p]['nachname'] . ';' . 
            $bewerber[$p]['vorname'] . ';'.  
            $bewerber[$p]['matrikelnummer'] .';'. 
            $bewerber[$p]['email'] . ';' .
            $bewerber[$p]['studiengang'] . ';' . 
            $bewerber[$p]['fachsemester'] . ';' . 
            $bewerber[$p]['credits'] . ';'; 
            if($kategorie=='Abschlussarbeit'){$ausgabe .= $bewerber[$p]['voraussetzung'] . ';';} 
            else{$ausgabe .= $bewerber[$p]['seminarteilnahme'] . ';';} 
            $ausgabe .= $bewerber[$p]['gesamt_punkte'] . ';' .  
            $bewerber[$p]['status'] . ';' . "\n";
            }            
            $ausgabe .= "\n";
    }


    // Alle Angenommenen Bewerber
    if ( ($art =='AbgAngBew'|| $art == 'alleListen') && $infos['anzBewANG'] > 0){
        if($art =='alleListen'){ $ausgabe .= "\n"; } 
        $ausgabe .= '"Liste - Alle angenommenen Bewerber"; '."\n";
        $ausgabe .= '"Nachname";"Vorname";"Matrikelnummer";"E-Mail";"Studiengang";"Fachsemester";"Credits";';
        if($kategorie=='Abschlussarbeit'){ $ausgabe .= '"Zulassung";';  } else{ $ausgabe .= '"Seminarteilnahme";'; } 
        $ausgabe .=  '"Punkte";'."\n";
    
    for($l = 0; $l < count($angBew); $l++){ 
        $ausgabe .= 
        $angBew[$l]['nachname'] . ';' . 
        $angBew[$l]['vorname'] . ';'.  
        $angBew[$l]['matrikelnummer'] .';'. 
        $angBew[$l]['email'] . ';' .
        $angBew[$l]['studiengang'] . ';' . 
        $angBew[$l]['fachsemester'] . ';' . 
        $angBew[$l]['credits'] . ';'; 
        if($kategorie=='Abschlussarbeit'){$ausgabe .= $angBew[$l]['voraussetzung'] . ';';} 
        else{$ausgabe .= $angBew[$l]['seminarteilnahme'] . ';';} 
        $ausgabe .= $angBew[$l]['gesamt_punkte'] . ';' . "\n";  
        
    } 
}

    // Alle Angenommenen Bewerber
    if ( ($art =='AbgAngBew' || $art == 'alleListen') && $infos['anzBewABG'] > 0){
        if($art =='alleListen' || $art =='AbgAngBew' ){ $ausgabe .= "\n"; } 
        $ausgabe .= '"Liste - Alle abeglehnten Bewerber"; '."\n";
        $ausgabe .= '"Nachname";"Vorname";"Matrikelnummer";"E-Mail";"Studiengang";"Fachsemester";"Credits";';
        if($kategorie=='Abschlussarbeit'){ $ausgabe .= '"Zulassung";';  } else{ $ausgabe .= '"Seminarteilnahme";'; } 
        $ausgabe .=  '"Punkte";'."\n";
        
        for($l = 0; $l < count($abgBew); $l++){ 
            $ausgabe .= 
            $abgBew[$l]['nachname'] . ';' . 
            $abgBew[$l]['vorname'] . ';'.  
            $abgBew[$l]['matrikelnummer'] .';'. 
            $abgBew[$l]['email'] . ';' .
            $abgBew[$l]['studiengang'] . ';' . 
            $abgBew[$l]['fachsemester'] . ';' . 
            $abgBew[$l]['credits'] . ';';  
            if($kategorie=='Abschlussarbeit'){$ausgabe .= $abgBew[$l]['voraussetzung'] . ';';} 
            else{$ausgabe .= $abgBew[$l]['seminarteilnahme'] . ';';} 
            $ausgabe .= $abgBew[$l]['gesamt_punkte'] . ';' . "\n";         
        } 
    }


    echo $this->convertToWindowsCharset($ausgabe);
  die();
?>

