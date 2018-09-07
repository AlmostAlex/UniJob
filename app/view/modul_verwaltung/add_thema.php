<div class="verwaltungsbox">
    <h4 class='card-title'><i class="fa fa-info-circle" aria-hidden="true"></i> Zum hinzufügen eines Themas:</h4>
    <br>
    <ul>
        <li> Es können mehrere Themen nachträglich zum dazugehörigen Modul hinzugefügt werden.</li>
        <li> Um Tags erfolgreich einzutragen, müssen diese durch ein ' <b>,</b> ' oder durch die Enter-Taste bestätigt bzw. getrennt werden.</li>
    </ul>
    Sowohl aktuelle Themen als auch Module können auf der <a href="/mt_verwaltung">Verwaltungsseite</a> wieder bearbeitet/verwaltet werden.
</div>

<div class="add_thema">
    <div class="list-group-item list-group-item-action active">
        Themen zum Modul "<b>
            <?php echo $modulbezeichnung; ?></b>" hinzufügen:
    </div>

    <form action="" method="post" name="mod" id="mod">
        <div class="list-group-item">
            <feld2>
                <table>
                    <div class="form-group fieldGroup">
                        <tr>
                            <td><label for="titel"><b>Titel:</b></label></td>
                            <td>
                                <space><input type="text" name="themenbezeichnung[]" class="form-control" placeholder="Titel des Themas" required/></space>
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
                            <td><label for="titel"><b>Tags:</b></label></td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name='tags[]' placeholder='Add Tags' data-role="tagsinput" class="form-control" />
                                </div>
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
                        <space><input type="text" name="themenbezeichnung[]" class="form-control" placeholder="Titel des Themas" /></space>
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
                    <td><label for="titel"><b>Tags:</b></label></td>
                    <td>
                        <div class="form-group">
                            <input type="text" id='taggin' name='tags[]' placeholder='Add Tags' class="form-control" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>
<br><br><br>