<div class="verwaltungsbox">
    <h4 class='card-title'><i class="fa fa-info-circle" aria-hidden="true"></i> Zum hinzufügen eines Themas:</h4>
    <br>
    <ul>
        <li> Es können mehrere Themen nachträglich
         <?php if($kategorie == 'Seminararbeit') { echo "zum dazugehörigen Seminar <b>".$modulbezeichnung."</b>"; } 
        else{ echo "zur Professur <b>".$modulbezeichnung."</b>"; } ?>l hinzugefügt werden.</li>
        <li> Um Tags erfolgreich einzutragen, müssen diese durch ein ' <b>,</b> ' oder durch die Enter-Taste bestätigt bzw. getrennt werden.</li>
    </ul>
</div>

<div class="add_thema">
    <div class="list-group-item list-group-item-action active">
        Themen <?php if($kategorie == 'Seminararbeit') { echo "zum Seminar <b>".$modulbezeichnung."</b>"; } 
        else{ echo "zur Professur <b>".$modulbezeichnung."</b>"; } ?> hinzufügen:
    </div>

    <form action="" method="post" name="mod" id="mod">
        <div class="list-group-item">
            <feld2>
                <table>
                    <div class="form-group fieldGroup">
                        <tr>
                            <td><label for="titel"><b>Titel:</b></label></td>
                            <td>
                                <space><input style='height:35px;' type="text" name="themenbezeichnung[]" class="form-control" placeholder="Titel des Themas" required/></space>
                            </td>
                            <td><a href="javascript:void(0)" class="btn btn-success addMore2">+</a></td>
                        </tr>
                        <tr>
                            <td><label for="titel"><b>Beschreibung:</b></label></td>
                            <td>
                                <textarea type="text" name="themenbeschreibung[]" class="form-control" placeholder="Beschreibung des Themas" /></textarea>
                            </td>
                        </tr>
                        <tr>
                        <td><label for="titel"><b>Vorkenntnisse:</b></label></td>
                            <td colspan='2'>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span style='margin-left:88px' class="input-group-text">Vorkenntnisse</span>
                                    </div>
                                    <vork><input style='width:80%;margin-left:0px;' type="text" name='vorkenntnisse[]' placeholder='Eingabe' class="tagsinput-typeahead2" /></vork>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="titel"><b>Tags:</b></label></td>
                            <td colspan='2'>
                        <taggin>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tags</span>
                            </div>
                            <tags><input style='width:80%;margin-left:0px;' type="text" name='tags[]' placeholder='Add Tags' class="tagsinput-typeahead" /></tags>
                        </div>
                        </taggin>
                            </td>
                        </tr>
                    </div>
                </table>
            </feld2>
        </div>
        <input type="submit" name="add_thema" id="add_btn" class="btn btn-primary" value="Themen eintragen" />

        <div class="form-group fieldGroupCopy" style="display: none;">
            <table>
                <tr>
                    <td><label for="titel"><b>Titel:</b></label></td>
                    <td>
                        <space><input type="text" style='height:35px;' name="themenbezeichnung[]" class="form-control" placeholder="Titel des Themas" /></space>
                    </td>
                    <td><a href="javascript:void(0)" class="btn btn-danger remove">-</a></td>
                </tr>
                <tr>
                    <td><label for="titel"><b>Beschreibung:</b></label></td>
                    <td>
                        <textarea type="text" name="themenbeschreibung[]" class="form-control" placeholder="Beschreibung des Themas" /></textarea>
                    </td>
                </tr>
    

        <tr>
        <td><label for="titel"><b>Vorkenntnisse:</b></label></td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span style='margin-left:88px' class="input-group-text">Vorkenntnisse</span>
                    </div>
                    <vork><input style='width:80%;margin-left:0px;'  type="text" id='vork' name='vorkenntnisse[]' placeholder='erforderlichen Vorkenntnisse' class="form-control" /></vork>
                </div>
            </td>
        </tr>
                <tr>
                    <td><label for="titel"><b>Tags:</b></label></td>
                    <td>
                        <tagginCopy>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tags</span>
                            </div>
                            <tags>
                            <div class="form-group">
                            <input type="text" id='taggin' name='tags[]' placeholder='Add Tags' class="form-control" />
                            </div>
                            </tags>
                        </div>
                        </tagginCopy>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>
<br><br><br>