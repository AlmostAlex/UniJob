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
        <h5>Bewerbungsmodul: '<?php echo $modul['professur']; ?>'</h5>
        <h6>Belegwunschverfahren</h6><br>
        
        <table  style='width: 67%;'>
            <tr>
                <td style='width: 40%'><label for='Vorname'><b>Vorname:</b><red style='color: red'>*</red></label></td>
                <td style='width: 60%'><input style='width: 100%' type='text class='form-control' name='Vorname' id='Vorname' placeholder='Vorname' required> </td>
            </tr>
            <tr>
                <td style='width: 40%'><label for='Nachname'><b>Nachname:</b><red style='color: red'>*</red></label></td>
                <td style='width: 60%'><input style='width: 100%' type='text class='form-control' name='Nachname' id='Nachname'  placeholder='Nachname' required> </td>
            </tr>
            <tr>
                <td style='width: 30%'><label for='matrikelnummer'><b>Matrikelnummer:</b><red style='color: red'>*</red></label></td>
                <td style='width: 65%'><input style='width: 100%' type='text class='form-control' name='Matrikelnummer' id='Matrikelnummer' required></td>
            </tr>
            <tr>
                <td style='width: 30%'><label for='E-Mail'><b>E-Mail:</b><red style='color: red'>*</red></label></td>
                <td style='width: 65%'><input style='width: 100%' type='text class='form-control' name='Email' id='Email' placeholder='@stud.uni-goettingen.de' required></td>
            </tr>
        </table><br>
        <table style='width: 81%;'>
            <tr>
                <td style='width: 33%'><label for='Thema'><b>Thema 1:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select style='width: 75%;' class='form-control' name='Thema1' id='Thema1' required>
                        <?php
                            while($statement_themen1->fetch())
                            {
                                echo "<option value='{$thema_id}'>$themenbezeichnung </option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>  
            <tr>
                <td style='width: 33%'><label for='Thema'><b>Thema 2:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select style='width: 75%;' class='form-control' name='Thema2' id='Thema2' required>
                        <?php
                            while($statement_themen2->fetch())
                            {
                                echo "<option value='{$thema_id}'>$themenbezeichnung </option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style='width: 33%'><label for='Thema'><b>Thema 3:</b><red style='color: red'>*</red></label></td>
                <td>
                    <select style='width: 75%;' class='form-control' name='Thema3' id='Thema3' required>
                        <?php
                            while($statement_themen3->fetch())
                            {
                                echo "<option value='{$thema_id}'>$themenbezeichnung </option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><br><input type='submit' name='bewerbung_belegwunsch' class='btn btn-primary' value='Bewerbung absenden'/> </td> 
            </tr>
        </table>
    </form>
</div>