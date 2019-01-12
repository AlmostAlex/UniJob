<br><h4>Bearbeiten der Mailvorlagen</h4>
Hier können Sie ihre Emails noch anpassen. </br>
Nutzen sie folgende Schreibweisen für Empfängerspezifische Informationen:</br>
#thema = Das Thema, auf welches sich der Student beworben hat</br>
#bewerber_vorname = Vorname des jeweiligen Bewerbers</br>
#bewerber_nachname = Nachname des jeweiligen Bewerbers

<div class="add_thema">
    <form action="" method="post" name="mod" id="mod">
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
                                <textarea rows="5" type="text" name="Inhalt_annahme" class="form-control" required/><?php echo $inhalt_angenommen; ?></textarea>
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
                        <tr>
                            <td><label for="betreff"><b>Betreff:</b></label></td>
                            <td>
                                <space><input style='height:35px;' type="text" name="Betreff_ablehnen" class="form-control" value="<?php echo $betreff_angenommen; ?>" required/></space>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="inhalt"><b>Inhalt:</b></label></td>
                            <td>
                                <textarea rows="5" type="text" name="Inhalt_ablehnen" class="form-control" required/><?php echo $inhalt_angenommen; ?></textarea>
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
                            <td><label for="rueckadresse"><b>Rücksendeadresse:</b></label></td>
                            <td>
                                <space><input style='height:35px;' type="text" name="returnadress" class="form-control" value="" placeholder="vorname.nachname@stud.uni-goettingen.de" required/></space>
                            </td>
                        </tr>                        
                    </div>
                </table>
            </feld2>
        </div>
        <input type="submit" name="send_mail" id="add_btn" class="btn btn-primary" value="Mails absenden" />

    </form>
</div>