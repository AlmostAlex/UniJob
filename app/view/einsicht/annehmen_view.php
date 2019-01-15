<div class="verwaltungsbox">
    <h4 class='card-title'><i class="fa fa-info-circle" aria-hidden="true"></i> 
    Bearbeitung der E-Mails für Zusage und Absagen</h4>
    <u>Bitte beachten Sie die folgenden Hinweise, damit die E-Mails die passenden Informationen beinhalten:</u><br>
    <ul>
    <li>  Vornahme des Bewerbers = <b>#bewerber_vorname</b></li>
    <li>  Nachname des Bewerbers = <b>#bewerber_nachname</b></li>
    <li>  Themenbezeichnung = <b>#thema</b></li>
</div>
<div class="form_thema">
    <form action="" method="post" name="mod" id="mod">
        <table id='general'> 
            <div style="left:50px" class="form_ueberschrift"><b>E-Mail für die Zusage</b></div>
        </table>
        <div class="list-group-item">
            <feld2>
                <table>
                    <div class="form-group fieldGroup">
                        <tr>
                            <td><label for="betreff"><b>Betreff:</b></label></td>
                            <td>
                                <space><input style='height:35px;' type="text" name="Betreff_annahme" class="form-control" value="<?php echo $betreff_angenommen; ?>" required/></space>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="inhalt"><b>Inhalt:</b></label></td>
                            <td>
                            <textarea id="summernote" name="Inhalt_annahme"> <?php echo $inhalt_angenommen; ?></textarea>
                            </td>
                        </tr>
                    </div>
                </table>
            </feld2>
        </div></br>

        <table id='general'> 
            <div style="left:50px" class="form_ueberschrift"><b>E-Mail für die Absage</b></div>
        </table>
        <div class="list-group-item">
            <feld2>
                <table>
                    <div class="form-group fieldGroup">
                        <tr>
                            <td><label for="betreff"><b>Betreff:</b></label></td>
                            <td>
                                <space><input style='height:35px;' type="text" name="Betreff_ablehnen" class="form-control" value="<?php echo $betreff_abgelehnt; ?>" required/></space>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="inhalt"><b>Inhalt:</b></label></td>
                            <td>
                            <textarea id="summernote" name="Inhalt_ablehnen"> <?php echo $inhalt_abgelehnt; ?></textarea>
                            </td>
                        </tr>  
                    </div>
                </table>
            </feld2>
        </div>
        </br>
        <div class="list-group-item">
            <feld2>
                <table>
                    <div class="form-group fieldGroup">
                        </tr>
                        <tr>
                            <td><label for="rueckadresse"><b>Antwortadresse:</b></label></td>
                            <td>
                                <space><input style='height:35px;' type="text" name="returnadress" class="form-control" value="" placeholder="vorname.nachname@stud.uni-goettingen.de" required/></space>
                            </td>
                        </tr>                        
                    </div>
                </table>
            </feld2>
        </div>
</br>
        <input type="submit" name="send_mail" id="add_btn" class="btn btn-primary" value="Mails absenden" />
</br>
    </form>
</div>