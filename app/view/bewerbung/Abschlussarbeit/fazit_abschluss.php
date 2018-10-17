
<br><br>
<div class='windhund'>
    <div style='border-top: 4px solid #3979b5; margin-bottom:0px;' class='form_thema'>
    <h4 class='bew_ue'>Eingaben zur Anmeldung </h4>

 <br>
    <table style='width:65%'>
        <tr>
            <td><label><b>Name:</b></label></td>
            <td><p><?php echo $nachname .','. $vorname; ?></p></td>
        </tr>
        <tr>
            <td><label><b>Matrikelnummer:</b></label></td>
            <td><?php echo $matrikelnummer;?></td>
        </tr>
        <tr>
            <td><label><b>Email:</b></label></td>
            <td><?php echo $email;?></td>
        </tr>
        <tr>
            <td><label><b>Thema:</b></label></td>
            <td><?php echo $themenbezeichnung;?></td>
        </tr>   
    </table>
<br><br>
Mit "Absenden" werden die Angaben bestätigt und vermittelt.<br>
    </div>
</div>

<p align="right" style='float: right;'>

    <INPUT TYPE="button" class='btn btn-primary' VALUE="Zurück" onClick="history.go(-1);">
    <INPUT TYPE="button" class='btn btn-primary' VALUE="Formular abschicken" onClick="history.go(-1);">
</p>
