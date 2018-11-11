<?php

//Festlegen der Bewerberanzahl und der ThemaAnzahl
            //Festlegen der Bewerberanzahl und der ThemaAnzahl
            $bewerberAnzahl = $this->belegwunsch_model->beleg_count($modul_id);
            $themaAnzahl = $this->thema_model->getThemenAnzahl($modul_id);
            
            //Status der Themen auf "Frei" setzen und Status der Bewerber auf "Hat nichts!" setzen.
            $bewerberinfos = $this->belegwunsch_model->getBewerberInfos($modul_id);
            $k = 0;
            while($k < count($bewerberinfos['belegwunsch_id']))
            {
                $bewerberinfos[$k]['belegwunsch_id']['Status'] = "Hat nichts!";
                $bewerberinfos[$k]['belegwunsch_id']['Thema'] = "kein Thema";
                $k = $k + 1;
            }
            
            $themen = $this->thema_model->getAllModulThema($modul_id);
            $k=0;
            while($k < count($themen['thema_id']))
            {
                $themen[$k]['thema_id']['Status'] = "Frei";
                $themen[$k]['thema_id']['Punkte'] = 0;
                $themen[$k]['thema_id']['Bewerber'] = "Noch kein Bewerber";
                $k = $k + 1;
            }
            
            //Die Studenten bekommen ihren ersten Wunsch, wenn dieser noch frei ist.
            $i = 0; $j = 0;
            while($i < count($bewerberinfos['belegwunsch_id']))
            {
                while($j < count($themen['thema_id']))
                {
                    if($bewerberinfos[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                    {
                        if($themen[$j]['thema_id']['Status'] == "Frei")
                        {
                            $themen[$j]['thema_id']['Punkte'] = 115;
                            $themen[$j]['thema_id']['Bewerber'] = $bewerberinfos[$k]['belegwunsch_id'];
                            $themen[$j]['thema_id']['Status'] = "Vergeben";
                            $bewerberinfos[$i]['belegwunsch_id']['Status'] = "Hat was!";
                            $bewerberinfos[$i]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                        }
                    }
                    $j = $j + 1;
                }
                $i = $i + 1;
            }
            $i = 0; $j = 0;
            //Die Studenten, die noch nichts haben, bekommen ihren zweiten Wunsch, wenn dieser noch Frei ist.
            while($i < count($bewerberinfos['belegwunsch_id']))
            {
                while($j < count($themen['thema_id']))
                {
                    if($bewerberinfos[$i]['belegwunsch_id']['Status'] != "Hat was!")
                    {
                        if($bewerberinfos[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                        {
                            if($themen[$j]['thema_id']['Status'] == "Frei")
                            {
                                $themen[$j]['thema_id']['Punkte'] = 110;
                                $themen[$j]['thema_id']['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                $themen[$j]['thema_id']['Status'] = "Vergeben";
                                $bewerberinfos[$i]['belegwunsch_id']['Status'] = "Hat was!";
                                $bewerberinfos[$i]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                            }
                        }
                    }
                    $j = $j + 1;
                }
                $i = $i + 1;
            }
            $i = 0; $j = 0;
            //Die Studenten, die noch nichts haben, bekommen ihren dritten Wunsch, wenn dieser noch Frei ist.
            while($i < count($bewerberinfos['belegwunsch_id']))
            {
                while($j < count($themen['thema_id']))
                {
                    if($bewerberinfos[$i]['belegwunsch_id']['Status'] != "Hat was!")
                    {
                        if($bewerberinfos[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                        {
                            if($themen[$j]['thema_id']['Status'] == "Frei")
                            {
                                $themen[$j]['thema_id']['Punkte'] = 105;
                                $themen[$j]['thema_id']['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                $themen[$j]['thema_id']['Status'] = "Vergeben";
                                $bewerberinfos[$i]['belegwunsch_id']['Status'] = "Hat was!";
                                $bewerberinfos[$i]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                            }
                        }
                    }
                    $j = $j + 1;
                }
                $i = $i + 1;
            }
            $i = 0; $j = 0;
            //Gesamtpunktzahl nach der ersten iteraltion bestimmen.
            $gesamtPunktzahl = 0;
            while($i < count($themen[$j]['thema_id']))
            {
                    $gesamtPunktzahl += $themen[$j]['thema_id']['Punkte'];
                    $i = $i + 1;
            }
            $i = 0;
            //Prüfen, ob es noch Freie Themen gibt, welche vergeben werden können
            //->Bedingung dafür ist, dass es min. soviele Bewerber gibt wie Themen.
            while($j < count($themen['thema_id']))
            {
                if($themen[$j]['thema_id']['Status'] == "Frei")
                {
                    if($bewerberAnzahl >= $themaAnzahl)
                    {
                        $bewerbungErhalten = false;
                        //Es wird nach einem Bewerber gesucht, der das Thema als einen seiner Wünsche angegeben hatte.
                        //Wird er gefunden, dann werden seine Daten zwischengespeichert.
                        while($i < count($bewerberinfos['belegwunsch_id']))
                        {
                            if($bewerberinfos[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                            {
                                $k = 0;
                                while($k < count($themen['thema_id'])){
                                    if($bewerberinfos[$i]['belegwunsch_id']['Thema'] == $themen[$k]['thema_id']){
                                        $Punktzahl1 = $themen[$k]['thema_id']['Punkte'];
                                        $k = count($themen['thema_id']);
                                    }else{$k=+1;}
                                }
                                $Punktzahl2 = 115;
                                $TauschThema = $bewerberinfos[$i]['belegwunsch_id']['Thema'];
                                $bewerbungErhalten = true;
                                break;
                            }
                            if($bewerberinfos[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                            {
                                $k = 0;
                                while($k < count($themen['thema_id'])){
                                    if($bewerberinfos[$i]['belegwunsch_id']['Thema'] == $themen[$k]['thema_id']){
                                        $Punktzahl1 = $themen[$k]['thema_id']['Punkte'];
                                        $k = count($themen['thema_id']);
                                    }else{$k=+1;}
                                }
                                $Punktzahl2 = 110;
                                $TauschThema = $bewerberinfos[$i]['belegwunsch_id']['Thema'];
                                $bewerbungErhalten = true;
                                break;
                            }
                            else if($bewerberinfos[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                            {
                                $k = 0;
                                while($k < count($themen['thema_id'])){
                                    if($bewerberinfos[$i]['belegwunsch_id']['Thema'] == $themen[$k]['thema_id']){
                                        $Punktzahl1 = $themen[$k]['thema_id']['Punkte'];
                                        $k = count($themen['thema_id']);
                                    }else{$k=+1;}
                                }
                                $Punktzahl2 = 105;
                                $TauschThema = $bewerberinfos[$i]['belegwunsch_id']['Thema'];
                                $bewerbungErhalten = true;
                                break;
                            }
                            $i = $i + 1;
                        }
                        $i = 0;
                        $t = 0;
                        if($bewerbungErhalten == true)
                        {
                            //Nach einem Bewerber suchen, der noch kein Thema hat und das alte Thema nehmen könnte
                            while($i < count($bewerberinfos['belegwunsch_id']))
                            {
                                if($bewerberinfos[$i]['belegwunsch_id']['Status'] == "Hat nichts!")
                                {
                                    if($bewerberinfos[$i]['wunschthema1'] == $TauschThema)
                                    {
                                        //Sollte man mehr Priorität auf die Wünsche und nicht die Themenvergabe
                                        //setzen wollen, dann kann man die Punkte geringer setzen.
                                        //Momentan wird bei den "if"-Abfragen True rauskommen, da die Themenvergabe
                                        //als Priorität angegeben wurde
                                        $Saldo = 115 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {
                                            //Hier findet der "tausch" statt.
                                            //Punkte aktuallisierung
                                            $themen[$j]['thema_id']['Punkte'] = $Punktzahl2;
                                            $themen[$j]['thema_id']['Status'] = "Vergeben";
                                            //Das noch nicht vergebene Thema bekommt nun den Bewerber zugewiesen und umgekehrt.
                                            while($t < count($bewerberinfos['belegwunsch_id'])){
                                                if($bewerberinfos[$t]['belegwunsch_id']['Thema'] == $TauschThema){
                                                    $themen[$j]['thema_id']['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                    $bewerberinfos[$t]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                                                    $t = count($bewerberinfos['belegwunsch_id']);
                                                }else{$t=+1;}
                                            }
                                            //Der Bewerber der vorher noch nichts hatte bekommt nun das Thema vom
                                            //vorherigen Bewerber
                                            $t = 0;
                                            while($t < count($themen['thema_id'])){
                                                if($themen[$t]['thema_id'] == $neuesThema){
                                                    $themen[$t]['thema_id']['Punkte'] = 115;
                                                    $themen[$t]['thema_id']['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                    $bewerberinfos[$i]['belegwunsch_id']['Status'] = "Hat was!";
                                                    $bewerberinfos[$i]['belegwunsch_id']['Thema'] = $themen[$t]['thema_id'];
                                                    $t = count($bewerberinfos['belegwunsch_id']);
                                                }else{$t=+1;}
                                            }
                                        }
                                    }
                                    if($bewerberinfos[$i]['wunschthema2'] == $TauschThema)
                                    {
                                        $Saldo = 110 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {                                           
                                            $themen[$j]['thema_id']['Punkte'] = $Punktzahl2;
                                            $themen[$j]['thema_id']['Status'] = "Vergeben";
                                            while($t < count($bewerberinfos['belegwunsch_id'])){
                                                if($bewerberinfos[$t]['belegwunsch_id']['Thema'] == $TauschThema){
                                                    $themen[$j]['thema_id']['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                    $bewerberinfos[$t]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                                                    $t = count($bewerberinfos['belegwunsch_id']);
                                                }else{$t=+1;}
                                            }
                                            $t = 0;
                                            while($t < count($themen['thema_id'])){
                                                if($themen[$t]['thema_id'] == $neuesThema){
                                                    $themen[$t]['thema_id']['Punkte'] = 110;
                                                    $themen[$t]['thema_id']['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                    $bewerberinfos[$i]['belegwunsch_id']['Status'] = "Hat was!";
                                                    $bewerberinfos[$i]['belegwunsch_id']['Thema'] = $themen[$t]['thema_id'];
                                                    $t = count($bewerberinfos['belegwunsch_id']);
                                                }else{$t=+1;}
                                            }
                                        }
                                    }
                                    if($bewerberinfos[$i]['wunschthema3'] == $TauschThema)
                                    {
                                        $Saldo = 105 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {
                                            $themen[$j]['thema_id']['Punkte'] = $Punktzahl2;
                                            $themen[$j]['thema_id']['Status'] = "Vergeben";
                                            while($t < count($bewerberinfos['belegwunsch_id'])){
                                                if($bewerberinfos[$t]['belegwunsch_id']['Thema'] == $TauschThema){
                                                    $themen[$j]['thema_id']['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                    $bewerberinfos[$t]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                                                    $t = count($bewerberinfos['belegwunsch_id']);
                                                }else{$t=+1;}
                                            }
                                            $t = 0;
                                            while($t < count($themen['thema_id'])){
                                                if($themen[$t]['thema_id'] == $neuesThema){
                                                    $themen[$t]['thema_id']['Punkte'] = 105;
                                                    $themen[$t]['thema_id']['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                    $bewerberinfos[$i]['belegwunsch_id']['Status'] = "Hat was!";
                                                    $bewerberinfos[$i]['belegwunsch_id']['Thema'] = $themen[$t]['thema_id'];
                                                    $t = count($bewerberinfos['belegwunsch_id']);
                                                }else{$t=+1;}
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $j = $j + 1;
            }
        $i = 0;
        //In der Datenbank den Bewerben die Themen zuordnen und nochmal die Punkte bestimmen.
        $gesamtPunktzahl = 0;
        while($i < count($bewerberinfos['belegwunsch_id']))
        {
            if($bewerberinfos['belegwunsch_id']['Thema'] != "kein Thema")
            {
                $this->belegwunsch->setThema($belegwunsch_id, $array[$belegwunsch_id]['Thema']);
                $gesamtPunktzahl += $array[($array[$belegwunsch_id]['Thema'])]['Punkte'];
            }
        }

        //ENDE DES ALGORITHMUS ?>
