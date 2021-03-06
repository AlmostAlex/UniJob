<br>
<div style='width: 100%; margin:0%; font-size: 1.0rem;' class='verwaltungsbox'>
    <h4 class='card-title'><i class='fa fa-info-circle' aria-hidden='true'></i> Informationen zur Bewerbung</h4>
        Um eine Bewerbung durchzuführen, sind folgende Hinweise zu beachten:<br>
    <ul>
        <li>Informieren Sie sich auf der <a href='index.php'>Informationsseite</a> über das Belegwunschverfahren.</li>
        <li>Alle <b>Pflichtfelder ( <red style='color: red'>*</red> )</b> sind auszufüllen.</li>
        <li>Alle Angaben sind wahrheitsgemäß auszufüllen.</li>
        <li>Es sind drei Themen absteigend nach Ihrer Priorität zu wählen.</li>
        <li>Bei Modulen mit dem <b>Belegwunschverfahren</b> erfolgt eine Auswertung erst nach Fristende.</li>
        <li>Eine Zu- oder Absage zur Bewerbung erhalten Sie nach Fristende und durch eine <b>Benachrichtung</b> über Ihre angegebene E-Mail-Adresse.</li>
    </ul>
</div><br>

<div style='margin-bottom: 100px; border-top: 4px solid #3979b5;' class='form_thema'>
    <form method='post'>
        <h5>Bewerbungsmodul: '<?php echo $modul['modulbezeichnung']; ?>' </h5>
        <h6>Belegwunschverfahren</h6><br>
        
        <table>
        <tr>
                <td style='width:220px;'>
                    <label for='Vorname'><b>Name:</b><red style='color: red'>*</red></label>
                </td>
                <td colspan='2'>
                    <input style='width: 48%; float:left; margin-right:5px;' type='text' class='form-control' id='Vorname'  name='Vorname' placeholder='Vorname' value='<?php echo $vorname?>' required> 
                    <input style='width: 50%' type='text' class='form-control' id='Nachname' name='Nachname' placeholder='Nachname'  value='<?php echo $nachname?>'  required>
                </td>
            </tr>
            <tr>
                <td><label for='matrikelnummer'><b>Matrikelnummer:</b><red style='color: red'>*</red></label></td>
                <td colspan='2'><input style='width: 100%' type='text' class='form-control' name='Matrikelnummer' id='onlyNumeric' value='<?php echo $matrikelnummer?>' required></td>
            </tr>
            <tr>
            <td><label for='E-Mail'><b>E-Mail:</b><red style='color: red'>*</red></label></td>
                <td colspan='2'>
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
                <td><input style='width: 100%' type='text' class='form-control' name='Fachsemester' id='onlyNumeric' value='<?php echo $fachsemester?>' required></td>
            </tr>
            <tr>
                <td><label for='Credits'><b>Anzahl Credits:</b><red style='color: red'>*</red></label></td>
                <td><input type='text' class='form-control' name='Credits' id='onlyNumeric' placeholer='Anzahl' value='<?php echo $credits?>' required></td>
            </tr>
            <tr>
                <td><label for='Studiengang'><b>Studiengang:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select class='form-control' name='Studiengang' id='Studiengang' required>
                        <option value='Betriebswirtschaftslehre' <?php if($studiengang == "Betriebswirtschaftslehre"){echo "selected";}?> >Betriebswirtschaftslehre</option>
                        <option value='Wirtschaftsinformatik' <?php if($studiengang == "Wirtschaftsinformatik"){echo "selected";}?> >Wirtschaftsinformatik</option>
                        <option value='Volkswirtschaftslehre' <?php if($studiengang == "Volkswirtschaftslehre"){echo "selected";}?> >Volkswirtschaftslehre</option>
                        <option value='Wirtschaftspädagogik' <?php if($studiengang == "Wirtschaftspädagogik"){echo "selected";}?> >Wirtschaftspädagogik</option>                   
                        <option value='Angewandte Informatik' <?php if($studiengang == "Angewandte Informatik"){echo "selected";}?> >Angewandte Informatik</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for='Thema'><b>Thema 1:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select class='form-control positionTypes' id='Thema1' name='Thema1' onchange="showVorkenntnisseBEL1(this.value)" required>
                    <option></option>
                    <?php for($i = 0; $i < count($themen); $i++){  ?>
                        <option value='<?php echo $themen[$i]['thema_id'] ?>'> <?php echo $themen[$i]['themenbezeichnung'] ?> </option>
                    <?php } ?>
                    </select>
                </td>
              <td style='width: 200px;'>

                <div id="v1"></div>
                </td>
            </tr>

             <tr>
            <td><label for='Thema'><b>Thema 2:</b><red style='color: red'>*</red></label></td>
            <td>
                    <select class='form-control positionTypes' id='Thema2' name='Thema2' onchange="showVorkenntnisseBEL2(this.value)" required>
                    <option></option>
                    <?php for($i = 0; $i < count($themen); $i++){  ?>
                        <option value='<?php echo $themen[$i]['thema_id'] ?>'> <?php echo $themen[$i]['themenbezeichnung'] ?> </option>
                    <?php } ?>
                    </select>
                </td>
                <td style='width: 200px;'>
                <div id="v2"></div>
                </td>

             </tr>

             <tr>
            <td><label for='Thema'><b>Thema 3:</b><red style='color: red'>*</red></label></td>
            <td>
                    <select class='form-control positionTypes' id='Thema3' name='Thema3' onchange="showVorkenntnisseBEL3(this.value)" required>
                    <option></option>
                    <?php for($i = 0; $i < count($themen); $i++){  ?>
                        <option value='<?php echo $themen[$i]['thema_id'] ?>'> <?php echo $themen[$i]['themenbezeichnung'] ?> </option>
                    <?php } ?>
                    </select>
                </td>
                <td style='width: 200px;'>
                <div id="v3"></div>
                </td>
             </tr>
             </table>
             </table>
<table>
    <tr>
         <td colspan=3><br>
         <div class="abfrageZulassung" role="alert">
                <center><label for='Vorkenntnisse'>
                <b>Haben Sie bereits an einem Seminar erfolgreich teilgenommen (bestanden)?</b><red style='color: red'>*</red> <br><br>
                            <input required type="radio" id="seminarteilnahme" name="seminarteilnahme" value="Ja" <?php if($seminarteilnahme == "Ja"){echo "checked";} ?>>
                            <label for="Ja">Ja</label> 
                            <input required type="radio" id="seminarteilnahme" name="seminarteilnahme" value="Nein" <?php if($seminarteilnahme == "Nein"){echo "checked";} ?> >
                            <label for="Nein">Nein</label> 
                </label></center>
            </div>
         </td>
        </tr>
    <tr>
                <td>
                <br>
                 <input type='submit' name='bewerbung_ab_BEL' class='btn btn-primary' value='Formular abschicken'>
                </td> 
            </tr>
        </table>
    </form>
</div>




