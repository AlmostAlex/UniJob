<div style='width: 100%; margin:0%; font-size: 1.0rem;' class='verwaltungsbox'>
    <h4 class='card-title'><i class='fa fa-info-circle' aria-hidden='true'></i> Informationen zur Bewerbung</h4>
        Um eine Anmeldung durchzuführen, sind folgende Hinweise zu beachten:<br>
    <ul>
        <li>Informieren Sie sich auf der <a href='index.php'>Informationsseite</a> über das Windhundverfahren.</li>
        <li>Alle <b>Pflichtfelder ( <red style='color: red'>*</red> )</b> sind auszufüllen.</li>
        <li>Nach Absenden des Formuolars, werden Sie <b>sofort</b> für das gewünschte Thema eingetragen.</li>
        <li>Nach Abmeldefrist erhalten Sie <b>Benachrichtung</b> über Ihre angegebene E-Mail-Adresse.</li>
    </ul>
</div><br>

<div class='form_thema'>
    <form method='post'>
        <h5>Bewerbungsmodul: {$modulbezeichnung}</h5>
        <h6>Bewerbungsverfahren</h6><br>
        
        <table>
            <tr>
                <td style='width: 40%'><label for='Vorname'><b>Vorname:</b><red style='color: red'>*</red></label></td>
                <td style='width: 60%'><input style='width: 100%' type='text' class='form-control' name='Vorname' id='Vorname'  placeholder='Vorname' required> </td>
            </tr> 
            <tr>
                <td style='width: 40%'><label for='Nachname'><b>Nachname:</b><red style='color: red'>*</red></label></td>
                <td style='width: 60%'><input style='width: 100%' type='text' class='form-control' name='Nachname' id='Nachname'  placeholder='Nachname' required> </td>
            </tr>
            <tr>
                <td style='width: 30%'><label for='matrikelnummer'><b>Matrikelnummer:</b><red style='color: red'>*</red></label></td>
                <td style='width: 65%'><input style='width: 100%' type='text' class='form-control' name='Matrikelnummer' id='Matrikelnummer' required></td>
            </tr>
            <tr>
                <td style='width: 30%'><label for='E-Mail'><b>E-Mail:</b><red style='color: red'>*</red></label></td>
                <td style='width: 65%'><input style='width: 100%' type='text' class='form-control' name='Email' id='Email' placeholder='@stud.uni-goettingen.de' required></td>
            </tr>
            <tr>
                <td style='width: 30%'><label for='Fachsemester'><b>Aktuelles Fachsemester:</b><red style='color: red'>*</red></label></td>
                <td style='width: 65%'><input style='width: 100%' type='text' class='form-control' name='Fachsemester' id='Fachsemester' required></td>
            </tr>
        </table><br>
        <table>
            <tr>
                <td><label style='padding-bottom: 0px;' for='Teilgenommen'><b>Haben Sie bereits an einem Seminarthema teilgeommen?</b> <red style='color: red'>*</red></label></td>
                <td><input style='margin-left: 10px;' type='radio' name='Teilgenommen' value='Ja' class='Kategorie' />Ja</input></td>
                <td><input style='margin-left: 10px;' type='radio' name='Teilgenommen' value='Nein' class='Kategorie' />Nein</input></td>
            </tr>
        </table><br>
        <table style='width: 81%;'>
            <tr>
                <td style='width: 5%'><label for='Studiengang'><b>Studiengang:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select style='width: 75%;' class='form-control' name='Studiengang' id='Studiengang' required>
                        <option value='Betriebswirtschaftlehre'>Betriebswirtschaftslehre</option>
                        <option value='Wirtschaftsinformatik'>Wirtschaftsinformatik</option>
                        <option value='Volkswirtschaftslehre'>Volkswirtschaftslehre</option>
                        <option value='Wirtschaftspädagogik'>Wirtschaftspädagogik</option>                   
                    </select>
                </td>
            </tr>
            <tr>
                <td style='width: 33%'><label for='Credits'><b>Anzahl Credits:</b><red style='color: red'>*</red></label></td>
                <td><input style='width: 75%;' type='text' class='form-control' name='Credit_Anzahl' id='Credits_Anzahl' placeholer='Anzahl' required></td>
            </tr>
            <tr>
                <td style='width: 33%'><label for='Thema'><b>Thema:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select style='width: 75%;' class='form-control' id='Thema' name='Thema' required>
                    <?php
                        while($statement_themen->fetch())
                        {
                            echo "<option value='{$thema_id}'>$themenbezeichnung </option>";
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><br><input type='submit' name='bewerbung_bewerbung' class='btn btn-primary' value='Bewerbung absenden'/> </td>
            </tr>
        </table>
    </form>
</div>
     