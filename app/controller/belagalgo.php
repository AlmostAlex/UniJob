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
                }
            }
            
            //Die Studenten, die noch nichts haben, bekommen ihren zweiten Wunsch, wenn dieser noch Frei ist.
            $statement_thema_bewerber = $this->belegwunsch->getThemaBewerber($modul_id);
            $statement_thema_bewerber->bind_result($belegwunsch_id, $wunsch_1, $wunsch_2, $wunsch_3);
            $statement_thema_bewerber->store_result();
            while($statement_thema_bewerber->fetch())
            {
                $statement_modul_themen = $this->thema->getAllModulThema($modul_id);
                $statement_modul_themen->bind_result($thema_id);
                $statement_modul_themen->store_result();
                while($statement_modul_themen->fetch())
                {
                    if($array[$belegwunsch_id]['Status'] != "Hat was!")
                    {
                        if($wunsch_2 == $thema_id)
                        {
                            if($array[$thema_id]['Status'] == "Frei")
                            {
                                $array[$thema_id]['Punkte'] = 110;
                                $array[$thema_id]['Bewerber'] = $belegwunsch_id;
                                $array[$thema_id]['Status'] = "Vergeben";
                                $array[$belegwunsch_id]['Status'] = "Hat was!";
                                $array[$belegwunsch_id]['Thema'] = $thema_id;
                            }
                        }
                    }
                }
            }
            
            //Die Studenten, die noch nichts haben, bekommen ihren dritten Wunsch, wenn dieser noch Frei ist.
            $statement_thema_bewerber = $this->belegwunsch->getThemaBewerber($modul_id);
            $statement_thema_bewerber->bind_result($belegwunsch_id, $wunsch_1, $wunsch_2, $wunsch_3);
            $statement_thema_bewerber->store_result();
            while($statement_thema_bewerber->fetch())
            {
                $statement_modul_themen = $this->thema->getAllModulThema($modul_id);
                $statement_modul_themen->bind_result($thema_id);
                $statement_modul_themen->store_result();
                while($statement_modul_themen->fetch())
                {
                    if($array[$belegwunsch_id]['Status'] != "Hat was!")
                    {
                        if($wunsch_3 == $thema_id)
                        {
                            if($array[$thema_id]['Status'] == "Frei")
                            {
                                $array[$thema_id]['Punkte'] = 105;
                                $array[$thema_id]['Bewerber'] = $belegwunsch_id;
                                $array[$thema_id]['Status'] = "Vergeben";
                                $array[$belegwunsch_id]['Status'] = "Hat was!";
                                $array[$belegwunsch_id]['Thema'] = $thema_id;
                            }
                        }
                    }
                }
            }
            
            //Gesamtpunktzahl nach der ersten iteraltion bestimmen.
            $gesamtPunktzahl = 0;
            $statement_thema_bewerber = $this->belegwunsch->getThemaBewerber($modul_id);
            $statement_thema_bewerber->bind_result($belegwunsch_id, $wunsch_1, $wunsch_2, $wunsch_3);
            $statement_thema_bewerber->store_result();
            while($statement_thema_bewerber->fetch())
            {
                if($array[$belegwunsch_id]['Thema'] != "kein Thema")
                {
                    $gesamtPunktzahl += $array[($array[$belegwunsch_id]['Thema'])]['Punkte'];
                }
            }

            //Prüfen, ob es noch Freie Themen gibt, welche vergeben werden können
            //->Bedingung dafür ist, dass es min. soviele Bewerber gibt wie Themen.
            $statement_modul_themen = $this->thema->getAllModulThema($modul_id);
            $statement_modul_themen->bind_result($thema_id);
            $statement_modul_themen->store_result();
            while($statement_modul_themen->fetch())
            {
                if($array[$thema_id]['Status'] == "Frei")
                {
                    if($bewerberAnzahl >= $themaAnzahl)
                    {
                        $bewerbungErhalten = false;
                        //Es wird nach einem Bewerber gesucht, der das Thema als einen seiner Wünsche angegeben hatte.
                        //Wird er gefunden, dann werden seine Daten zwischengespeichert.
                        $statement_thema_bewerber = $this->belegwunsch->getThemaBewerber($modul_id);
                        $statement_thema_bewerber->bind_result($belegwunsch_id, $wunsch_1, $wunsch_2, $wunsch_3);
                        $statement_thema_bewerber->store_result();
                        while($statement_thema_bewerber->fetch())
                        {
                            if($wunsch_1 == $thema_id)
                            {
                                $Punktzahl1 = $array[($array[$belegwunsch_id]['Thema'])]['Punkte'];
                                $Punktzahl2 = 115;
                                $TauschThema = $array[$belegwunsch_id]['Thema'];
                                $bewerbungErhalten = true;
                                break;
                            }
                            else if($wunsch_2 == $thema_id)
                            {
                                $Punktzahl1 = $array[($array[$belegwunsch_id]['Thema'])]['Punkte'];
                                $Punktzahl2 = 110;
                                $TauschThema = $array[$belegwunsch_id]['Thema'];
                                $bewerbungErhalten = true;
                                break;
                            }
                            else if($wunsch_3 == $thema_id)
                            {
                                $Punktzahl1 = $array[($array[$belegwunsch_id]['Thema'])]['Punkte'];
                                $Punktzahl2 = 105;
                                $TauschThema = $array[$belegwunsch_id]['Thema'];
                                $bewerbungErhalten = true;
                                break;
                            }
                        }
                        if($bewerbungErhalten == true)
                        {
                            //Nach einem Bewerber suchen, der noch kein Thema hat und das alte Thema nehmen könnte
                            $statement_thema_bewerber = $this->belegwunsch->getThemaBewerber($modul_id);
                            $statement_thema_bewerber->bind_result($belegwunsch_id, $wunsch_1, $wunsch_2, $wunsch_3);
                            $statement_thema_bewerber->store_result();
                            while($statement_thema_bewerber->fetch())
                            {
                                if($array[$belegwunsch_id]['Status'] == "Hat nichts!")
                                {
                                    if($wunsch_1 == $TauschThema)
                                    {
                                        //Sollte man mehr Priorität auf die Wünsche und nicht die Themenvergabe
                                        //setzen wollen, dann kann man die Punkte geringer setzen.
                                        //Momentan wird bei den "if"-Abfragen True rauskommen, da die Themenvergabe
                                        //als Priorität angegeben wurde
                                        $Saldo = 115 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {
                                            //Hier findet der "tausch" statt.
                                            //Zwischenspeichern des Themas, dass der Bewerber vorher hatte 
                                            $neuesThema = $array[($array[$TauschThema]['Bewerber'])]['Thema'];
                                            //Punkte aktuallisierung
                                            $array[$thema_id]['Punkte'] = $Punktzahl2;
                                            //Das noch nicht vergebene Thema bekommt nun den Bewerber zugewiesen
                                            $array[$thema_id]['Bewerber'] = ($array[$TauschThema]['Bewerber']);
                                            $array[$thema_id]['Status'] = "Vergeben";
                                            //Und dem Bewerber wird das Thema zugeordnet
                                            $array[($array[$TauschThema]['Bewerber'])]['Thema'] = $thema_id;
                                            //Der Bewerber der vorher noch nichts hatte bekommt nun das Thema vom
                                            //vorherigen Bewerber
                                            $array[$neuesThema]['Punkte'] = 115;
                                            $array[$neuesThema]['Bewerber'] = $belegwunsch_id;
                                            $array[$belegwunsch_id]['Status'] = "Hat was!";
                                            $array[$belegwunsch_id]['Thema'] = $neuesThema;
                                        }
                                    }
                                    else if($wunsch_2 == $TauschThema)
                                    {
                                        $Saldo = 110 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {
                                            $neuesThema = $array[($array[$TauschThema]['Bewerber'])]['Thema'];
                                            
                                            $array[$thema_id]['Punkte'] = $Punktzahl2;
                                            $array[$thema_id]['Bewerber'] = ($array[$TauschThema]['Bewerber']);
                                            $array[$thema_id]['Status'] = "Vergeben";
                                            $array[($array[$TauschThema]['Bewerber'])]['Thema'] = $thema_id;
                                            
                                            $array[$neuesThema]['Punkte'] = 110;
                                            $array[$neuesThema]['Bewerber'] = $belegwunsch_id;
                                            $array[$belegwunsch_id]['Status'] = "Hat was!";
                                            $array[$belegwunsch_id]['Thema'] = $neuesThema;
                                        }
                                    }
                                    else if($wunsch_3 == $TauschThema)
                                    {
                                        $Saldo = 105 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {
                                            $neuesThema = $array[($array[$TauschThema]['Bewerber'])]['Thema'];
                                            
                                            $array[$thema_id]['Punkte'] = $Punktzahl2;
                                            $array[$thema_id]['Bewerber'] = ($array[$TauschThema]['Bewerber']);
                                            $array[$thema_id]['Status'] = "Vergeben";
                                            $array[($array[$TauschThema]['Bewerber'])]['Thema'] = $thema_id;
                                            
                                            $array[$neuesThema]['Punkte'] = 105;
                                            $array[$neuesThema]['Bewerber'] = $belegwunsch_id;
                                            $array[$belegwunsch_id]['Status'] = "Hat was!";
                                            $array[$belegwunsch_id]['Thema'] = $neuesThema;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        //In der Datenbank den Bewerben die Themen zuordnen und nochmal die Punkte bestimmen.
        $gesamtPunktzahl = 0;
        $statement_thema_bewerber = $this->belegwunsch->getThemaBewerber($modul_id);
        $statement_thema_bewerber->bind_result($belegwunsch_id, $wunsch_1, $wunsch_2, $wunsch_3);
        $statement_thema_bewerber->store_result();
        while($statement_thema_bewerber->fetch())
        {
            if($array[$belegwunsch_id]['Thema'] != "kein Thema")
            {
                $this->belegwunsch->setThema($belegwunsch_id, $array[$belegwunsch_id]['Thema']);
                $gesamtPunktzahl += $array[($array[$belegwunsch_id]['Thema'])]['Punkte'];
            }
        }

        //ENDE DES ALGORITHMUS ?>
