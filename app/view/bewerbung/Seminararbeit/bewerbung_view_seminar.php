
<br>
<div style='width: 100%; margin:0%; font-size: 1.0rem;' class='verwaltungsbox'>
    <h4 class='card-title'><i class='fa fa-info-circle' aria-hidden='true'></i> Informationen zur Bewerbung</h4>
        Um eine Anmeldung durchzuführen, sind folgende Hinweise zu beachten:<br>
    <ul>
   <li>Informieren Sie sich auf der <a href='index.php'>Informationsseite</a> über das Bewerbungsverfahren.</li>
   <li>Alle <b>Pflichtfelder ( <red style='color: red'>*</red> )</b> sind auszufüllen.</li>
<li>Alle Angaben sind wahrheitsgemäß auszufüllen.</li>      
<li>Eine Auswertung erfolgt erst nach Fristende.</li>
<li>Eine Zu- oder Absage zur Bewerbung erhalten Sie nach Fristende und durch eine <b>Benachrichtung</b> über Ihre angegebene E-Mail-Adresse.</li>
</ul>
</div><br>

<div class='form_thema'>
<form action='' method='POST'>
    <h4 class='bew_ue'>Seminararbeitsthemen zum Modul '<?php echo $modul['modulbezeichnung']; ?>' </h4>
        <h6>Bewerbungsverfahren</h6><br>
        
        <table>
            <tr>
                <td><label for='Vorname'><b>Vorname:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 100%' type='text' class='form-control' name='Vorname' id='Vorname'  placeholder='Vorname' value='<?php echo $vorname?>' required> </td>
            </tr> 
            <tr>
                <td><label for='Nachname'><b>Nachname:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 100%' type='text' class='form-control' name='Nachname' id='Nachname'  placeholder='Nachname' value='<?php echo $nachname?>' required> </td>
            </tr>
            <tr>
                <td><label for='matrikelnummer'><b>Matrikelnummer:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 100%' type='text' class='form-control' name='Matrikelnummer' id='Matrikelnummer' value='<?php echo $matrikelnummer?>' required></td>
            </tr>
            <tr>
            <td><label for='E-Mail'><b>E-Mail:</b><red style='color: red'>*</red></label></td>
                <td>
                 <div class="input-group">
                    <input type="text" class="form-control" id='Email' name='Email' placeholder="Benutzerkennung" aria-describedby="basic-addon2" value='<?php echo $email?>' required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@stud.uni-goettingen.de</span>
                        </div>
                    </div>                              
                </td>           
                </tr>
                
            <tr>
                <td><label for='Fachsemester'><b>Aktuelles Fachsemester:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 100%' type='text' class='form-control' name='Fachsemester' id='Fachsemester' value='<?php echo $fachsemester?>' required></td>
            </tr>
            <tr>
                <td><label for='Studiengang'><b>Studiengang:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select class='form-control' name='Studiengang' id='Studiengang' required>
                        <option value='Betriebswirtschaftlehre' <?php if($studiengang == "Betriebswirtschaftslehre"){echo "selected";}?> >Betriebswirtschaftslehre</option>
                        <option value='Wirtschaftsinformatik' <?php if($studiengang == "Wirtschaftsinformatik"){echo "selected";}?> >Wirtschaftsinformatik</option>
                        <option value='Volkswirtschaftslehre' <?php if($studiengang == "Volkswirtschaftslehre"){echo "selected";}?> >Volkswirtschaftslehre</option>
                        <option value='Wirtschaftspädagogik' <?php if($studiengang == "Wirtschaftspädagogik"){echo "selected";}?> >Wirtschaftspädagogik</option>                   
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for='Credits'><b>Anzahl Credits:</b><red style='color: red'>*</red></label></td>
                <td><input type='text' class='form-control' name='Credits' id='Credits' placeholer='Anzahl' value='<?php echo $credits?>' required></td>
            </tr>
            <tr>
                <td><label for='Thema'><b>Thema:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select class='form-control' id='Thema' name='Thema' onchange="showVorkenntnisseBW(this.value)" required>
                    <option></option>
                    <?php for($i = 0; $i < count($themen); $i++){  ?>
                        <option value='<?php echo $themen[$i]['thema_id'] ?>'> <?php echo $themen[$i]['themenbezeichnung'] ?> </option>
                    <?php } ?>
                    </select>
                </td>
            </tr>

         </table>
        <table>
            <div style='margin-bottom:-7px;' id="txtHint"></div>
        </table>
<table>
    <tr>
         <td colspan=3><br>
         <div class="abfrageZulassung" role="alert">
                <center><label for='Vorkenntnisse'>
                <b>Erfüllst du alle Vorraussetzungen zur Zulassung deiner Abschlussarbeit?</b> <br><br>
                            <input type="radio" id="Zulassung" name="Zulassung" value="Ja" <?php if($zulassung == "Ja"){echo "checked";} ?>>
                            <label for="Ja">Ja</label> 
                            <input type="radio" id="Zulassung" name="Zulassung" value="Nein" <?php if($zulassung == "Nein"){echo "checked";} ?> >
                            <label for="Nein">Nein</label> 
                </label></center>
            </div>
         </td>
        </tr>
            <tr>
                <td><br>

            <a data-toggle='modal' data-target='#bewerbung_senden' href='#'>hi</a>
            <?php $this->getModal('bewerbung_senden', $modul["modul_id"]);?>

                </td>
            </tr>
        </table>
    </form>
</div>

     