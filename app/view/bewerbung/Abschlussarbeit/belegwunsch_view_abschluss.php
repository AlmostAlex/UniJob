
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
        <h5>Bewerbungsmodul: '<?php echo $modul['professur']; ?>' </h5>
        <h6>Belegwunschverfahren</h6><br>
        
        <table>
        <tr>
                <td><label for='Vorname'><b>Vorname:</b><red style='color: red'>*</red></label></td>
                <td colspan='2'><input style='width: 100%' type='text' class='form-control' name='Vorname' id='Vorname'  placeholder='Vorname' value='<?php echo $vorname?>' required> </td>
            </tr> 
            <tr>
                <td><label for='Nachname'><b>Nachname:</b><red style='color: red'>*</red></label></td>
                <td colspan='2'><input style='width: 100%' type='text' class='form-control' name='Nachname' id='Nachname'  placeholder='Nachname' value='<?php echo $nachname?>' required> </td>
            </tr>
            <tr>
                <td><label for='matrikelnummer'><b>Matrikelnummer:</b><red style='color: red'>*</red></label></td>
                <td colspan='2'><input style='width: 100%' type='text' class='form-control' name='Matrikelnummer' id='Matrikelnummer' value='<?php echo $matrikelnummer?>' required></td>
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
                <td><label for='Thema'><b>Thema:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select class='form-control' id='Thema' name='Thema' onchange="showVorkenntnisseBEL(this.value)" required>
                    <option></option>
                    <?php for($i = 0; $i < count($themen); $i++){  ?>
                        <option value='<?php echo $themen[$i]['thema_id'] ?>'> <?php echo $themen[$i]['themenbezeichnung'] ?> </option>
                    <?php } ?>
                    </select>
                </td>
                <td style='width: 200px;'>

                <div id='pr1' class="alert alert-danger"  style='width: 175px; padding: 8px; padding-left: 10px; margin-bottom: 0px; font-size: 14px;' role="alert">
                Wähle deine 1. Priorität.
                </div>
        
                <div id="v1">
                

                </div>
                </td>
            </tr>
           <!--  <tr>
         <td>
         </td>
        <td colspan='2'>
            <div id="v1"></div>
        </td>
        </tr>-->
<tr>

                <td>
                <br>
                 <input type='submit' name='bewerbung_ab_BEL' class='btn btn-primary' value='Formular abschicken'>
                </td> 
            </tr>
        </table>
    </form>
</div>
