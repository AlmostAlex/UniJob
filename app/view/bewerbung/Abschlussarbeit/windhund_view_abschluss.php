
<br>
<div style='width: 100%; margin:0%; font-size: 1.0rem;' class='verwaltungsbox'>
    <h4 class='card-title'><i class='fa fa-info-circle' aria-hidden='true'></i> Informationen zur Bewerbung</h4>
        Um eine Anmeldung durchzuführen, sind folgende Hinweise zu beachten:<br>
    <ul>
        <li>Informieren Sie sich auf der <a href='index.php'>Informationsseite</a> über das Windhundverfahren.</li>
        <li>Alle <b>Pflichtfelder ( <red style='color: red'>*</red> )</b> sind auszufüllen.</li>
        <li>Nach Absenden des Formulars, werden Sie <b>sofort</b> für das gewünschte Thema eingetragen.</li>
        <li>Nach Abmeldefrist erhalten Sie <b>Benachrichtung</b> über Ihre angegebene E-Mail-Adresse.</li>
    </ul>
</div><br>

<div class='windhund'><div style='margin-bottom: 100px; border-top: 4px solid #3979b5;' class='form_thema'>
    <form method='post'>
        <h4 class='bew_ue'>  Abschlussarbeitsthemen der Professur '<?php echo $modul['professur']; ?>' </h4>
        <h6>Windhundverfahren</h6><br>
        <table>
            <tr>
                <td><label for='Vorname'><b>Vorname:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 100%' type='text' class='form-control' id='Vorname'  name='Vorname' placeholder='Vorname' required> </td>
            </tr>
            <tr>
                <td><label for='Nachname'><b>Nachname:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 100%' type='text' class='form-control' id='Nachname' name='Nachname'  placeholder='Nachname' required> </td>
            </tr> 

            <tr>
                <td><label for='matrikelnummer'><b>Matrikelnummer:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 100%' type='text' class='form-control' id='Matrikelnummer' name='Matrikelnummer' required></td>
            </tr>

            <tr>
                <td><label for='E-Mail'><b>E-Mail:</b><red style='color: red'>*</red></label></td>
                <td>
                 <div class="input-group mb-3">
                    <input type="text" class="form-control"  id='Email' name='Email' placeholder="Benutzerkennung" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@stud.uni-goettingen.de</span>
                        </div>
                    </div>                              
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
                        <option value='<?php echo $themen[$i]['thema_id'] ?>'> <?php echo $themen[$i]['themenbezeichnung'] ?> </option>
                    <?php } ?>
                    </select>
                    </td>
            </tr>

         <tr>
         <td>
                <label for='Vorkenntnisse'>
                            <b>Vorkenntnisse:</b><red style='color: red'>*</red>
                </label>
         </td>

        <td>
            <div id="txtHint">Wähle ein Thema aus</div>
        </td>
        </tr>



            <tr><td><br><input type='submit' name='bewerbung_windhund' class='btn btn-primary' value='Formular absenden' data-toggle='modal' data-target='#myModal'> </tr> </td>
        </table>
    </form>
</div>
</div>
<br>
