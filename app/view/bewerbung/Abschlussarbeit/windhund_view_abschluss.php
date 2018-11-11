
<br>
<div style='width: 100%; margin:0%; font-size: 1.0rem;' class='verwaltungsbox'>
    <h4 class='card-title'><i class='fa fa-info-circle' aria-hidden='true'></i> Informationen zur Anmeldung</h4>
        Um eine Anmeldung durchzuführen, sind folgende Hinweise zu beachten:<br>
    <ul>
        <li>Informieren Sie sich auf der <a href='index.php'>Informationsseite</a> über das Windhundverfahren.</li>
        <li>Alle <b>Pflichtfelder ( <red style='color: red'>*</red> )</b> sind auszufüllen.</li>
        <li>Nach Absenden des Formulars, werden Sie <b>sofort</b> für das gewünschte Thema eingetragen.</li>
        <li>Nach Abmeldefrist erhalten Sie <b>Benachrichtung</b> über Ihre angegebene E-Mail-Adresse.</li>
    </ul>
</div><br>

<div class='windhund'><div style='margin-bottom: 100px; border-top: 4px solid #3979b5;' class='form_thema'>
    <form action='' method='POST'>
        <h4 class='bew_ue'>Abschlussarbeitsthemen der Professur '<?php echo $modul['professur']; ?>' </h4>
        <h6>Windhundverfahren</h6><br>
        <table>
            <tr>
                <td><label for='Vorname'><b>Name:</b><red style='color: red'>*</red></label></td>
                <td>
                    <input style='width: 48%; float:left; margin-right:5px;' type='text' class='form-control' id='Vorname'  name='Vorname' placeholder='Vorname' value='<?php echo $vorname?>' required> 
                    <input style='width: 50%' type='text' class='form-control' id='Nachname' name='Nachname' placeholder='Nachname'  value='<?php echo $nachname?>'  required>
                </td>
            </tr>

            <tr>
                <td><label for='matrikelnummer'><b>Matrikelnummer:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 100%' type='text' class='form-control' id='Matrikelnummer' name='Matrikelnummer' value='<?php echo $matrikelnummer?>' required></td>
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
                <td><label for='matrikelnummer'><b>Studiengang:</b><red style='color: red'>*</red></label></td>
                <td>
                <select class='form-control' id='Studiengang' name='Studiengang' required>
                    <option></option>
                    <option value='Betriebswirtschaftslehre' <?php if($studiengang == 'Betriebswirtschaftslehre'){echo "selected";} ?> >Betriebswirtschaftslehre</option>
                    <option value='Wirtschaftsinformatik' <?php if($studiengang == 'Wirtschaftsinformatik'){echo "selected";} ?>>Wirtschaftsinformatik</option>
                    <option value='Wirtschaftspädagogik' <?php if($studiengang == 'Wirtschaftspädagogik'){echo "selected";} ?>>Wirtschaftspädagogik</option>
                    <option value='Volkswirtschaftslehre' <?php if($studiengang == 'Volkswirtschaftslehre'){echo "selected";} ?>>Volkswirtschaftslehre</option>
                </td>
            </tr>
            <tr>
                <td style='width: 33%'>
                <label for='Thema'>
                    <b>Thema:</b><red style='color: red'>*</red>
                    </label>
                    </td>
                    <td>
                    <select class='form-control' id='Thema' name='Thema' onchange="showVorkenntnisse(this.value)" required>
                    <option></option>
                    <?php for($i = 0; $i < count($themen); $i++){  ?>
                        <option value='<?php echo $themen[$i]['thema_id'] ?>' <?php if($thema_id == $themen[$i]['thema_id']){echo "selected";} ?> > <?php echo $themen[$i]['themenbezeichnung'] ?> </option>
                    <?php } ?>
                    </select>
                    </td>
            </tr>

         <tr>
         <td>
         </td>
        <td>
            <div id="txtHint"></div>
        </td>
        </tr>
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
            <td colspan='2'>
                    <br>
            <button style='float:right;' data-toggle='modal' data-target='#anmeldung_senden_ab' href='#' type="button" class="btn btn-primary">Anmeldung verschicken</button>
            <?php $this->getModal('anmeldung_senden_ab', $modul["modul_id"]);?>  
        </td>
        </tr> 
  
        </table> 
</div>
</form>
</div>
<br>
