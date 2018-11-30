<form method='post'>
  <div class='edit_div_modul'>
    <table class='edit_div_table'>
      <tr>
        <td style='width:260px;' colspan='3'>
          <h5>Bearbeitung der <?php echo $modul['kategorie']; ?>:<br><span>
              <?php echo $bezeichnung; ?></span></h5>
        </td>
      </tr>
      <tr style='<?php echo $displayBez; ?>'>
        <td ><label for='Bezeichnung'><b>Seminarbezeichnung:</b>
            <red style='color: red'>*</red>
          </label></td>
        <td colspan='3'><input type='text' id='modulbezeichnung' name='modulbezeichnung' class='form-control' value='<?php echo $modul["modulbezeichnung"] ?>'
        <?php echo $reqBez; ?>></td>
      </tr>
      <tr>
        <td><label for='Professur'><b>Professur:</b>
            <red style='color: red'>*</red>
          </label></td>
        <td colspan='3'><input style='margin-top:10px;' type='text' id='professur' name='professur' class='form-control' value='<?php echo $modul["professur"] ?>'
            required></td>
      </tr>
<tr>
                    <td><label for="Termine"><b>Bewerbungsfristen:</b><red>*</red></label></td>
                    <td style='padding-bottom: 30px;'>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="form-control" name="Start" <?php echo $check['fristen'] ?>  autocomplete="off" value='<?php echo $start_anzeige ?>' placeholder="TT-MM-JJJJ" id="datepicker_Start" required>
                            <span id='datebox' class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <dates>
                            <text style='padding:0 5 0 15; ' class='dateText' for="starttermin">Bewerbungsstart</text>
                        </dates>
                    </td>
                    <td style='padding-bottom: 30px;'>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="form-control" name="Ende" <?php echo $check['fristen'] ?>  autocomplete="off" value='<?php echo $ende_anzeige ?>' placeholder="TT-MM-JJJJ" id="datepicker_Ende" required>
                            <span id='datebox' class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <dates>
                        <text style='padding:0 13 0 13; margin-top: 10px;height: 30px;'  for="endtermin">Bewerbungsende</text>
                        </dates>
                    </td>
                    <td style='padding-bottom: 30px;'>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="form-control" name="Kickoff"  autocomplete="off" value='<?php echo $kickoff_anzeige; ?>' placeholder="TT-MM-JJJJ" id="datepicker_kickoff" required>
                            <span id='datebox' class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>    
                        <dates>                       
                        <text style='padding:0 20 0 20;' class='dateText'  for="kickofftermin">Kickofftermin</text>
                    </dates>                   
                    </td>
                </tr>              
      </tr>
      <tr>
        <td><label for="SemesterEdit"><b>Semester:</b><red>*</red></label></td>
        <td style='height:45px;'> 
          <select class="form-control" name="SemesterEdit" id="SemesterEdit" required>
            <option value="SoSe" <?php if($semester == "SoSe"){echo "selected";} ?>>SoSe</option>
            <option value="WiSe" <?php if($semester == "WiSe"){echo "selected";} ?>>WiSe</option>
          </select> 
        </td>
        <td>
        <!-- Wenn SoSe Gewählt wird-->
          <div id='SoSe'> 
            <input type="text" name='Semester_input1' class="form-control" value="<?php if($semester == 'SoSe'){echo $semester_s;} ?>"/>
          </div>
          <!-- Wenn WiSe Gewählt wird-->
          <div id='WiSe'> 
            <div style='margin-top:0px;' class="input-group">
              <input type="text" name='Semester_input2' class="form-control" value='<?php if($semester == "WiSe"){echo $semesterjahr[0];} ?>'/>
                <div class="input-group-append"><span class="input-group-text" style='border-right: 0px;'>&nbsp;/&nbsp;</span></div>
                <input type="text"  name='Semester_input3' class="form-control" value='<?php if($semester== "WiSe"){echo $semesterjahr[1];} ?>'/>
            </div> 
          </div>  
          <!-- Auswahl Semester Ende -->
          </td>      
        </tr>    
        <tr>
                    <td><label for="Beschreibung"><b>Zusätzliche Hinweise:</b></label></td>
                    <td colspan = "3"><textarea style='margin-top:5px;' type="text" name="hinweise" id="hinweise" class="form-control" placeholder="Hinweise zur Professur, zum Ablauf o.ä."><?php echo $modul["hinweise"] ?></textarea></td>
                </tr>    
      <tr>
        <td><label for='bevStudiengang'><b>bevorzugter Studiengang:</b></label></td>
        <td colspan='3'>
          <select style='margin-top:10px;' class='form-control' name='Studiengang' id='Studiengang' required>
            <option value='None' <?php echo (($modul["studiengang"]=='None' )? "selected" : "" ); ?>>Keiner</option>
            <option value='Betriebswirtschaftlehre' <?php echo (($modul["studiengang"]=='Betriebswirtschaftlehre' )?
              "selected" : "" ); ?>>Betriebswirtschaftslehre</option>
            <option value='Wirtschaftsinformatik' <?php echo (($modul["studiengang"]=='Wirtschaftsinformatik' )?
              "selected" : "" ); ?>>Wirtschaftsinformatik</option>
            <option value='Volkswirtschaftslehre' <?php echo (($modul["studiengang"]=='Volkswirtschaftslehre' )?
              "selected" : "" ); ?>>Volkswirtschaftslehre</option>
            <option value='Wirtschaftspädagogik' <?php echo (($modul["studiengang"]=='Wirtschaftspädagogik' )?
              "selected" : "" ); ?>>Wirtschaftspädagogik</option>
            <option value='Angewandte Informatik' <?php echo (($modul["studiengang"]=='Angewandte Informatik' )?
              "selected" : "" ); ?>>Angewandte Informatik</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for='verf'><b>Verfahren:<red style='color: red'>*</red></b></label></td>

        <td colspan='3'>
          <select style='margin-top:10px;' class='form-control' name='Verfahren' id='Verfahren' <?php echo $check['verfahren_select'] ?>
            required>
            <option <?php echo $check['verfahren_option'] ?> value='Windhundverfahren'
              <?php echo (($modul["verfahren"] == 'Windhundverfahren')? "selected" : ""); ?>>Windhundverfahren</option>
            <option <?php echo $check['verfahren_option'] ?> value='Bewerbungsverfahren'
              <?php echo (($modul["verfahren"] == 'Bewerbungsverfahren')? "selected" : ""); ?>>Bewerbungsverfahren</option>
            <option <?php echo $check['verfahren_option'] ?> value='Belegwunschverfahren'
              <?php echo (($modul["verfahren"] == 'Belegwunschverfahren')? "selected" : ""); ?>>Belegwunschverfahren</option>
          </select>

        </td>
      </tr>

      <tr>
        <td colspan='3'><br><input type='submit' name='modul_edit' class='btn btn-primary' value='Modul editieren' />
        </td>
      </tr>

    </table>
</form>


<hr>
<edit>
<table class='edit_div_table' id='edit_div_table'>
  <h5><i class='fas fa-list-ul'></i> Zu dem Modul gibt es folgende Themen:</h5>
  <ol>

  <span data-toggle='tooltip' data-placement='top' title='Anmeldungen einsehen' class='<?php echo $modul["einsicht_wh_btn"] ?>'>
   <a href='/einsicht/<?php echo $modul["verfahren"];?>/<?php echo $modul["modul_id"]; ?>'> Einsichten </a>
  </span>

   <span data-toggle='tooltip' data-placement='top' title='Anmeldungen einsehen' class='<?php echo $modul["einsicht_bel_btn"] ?>'>
  <a href='/einsicht/<?php echo $modul["verfahren"];?>/<?php echo $modul["modul_id"]; ?>'> Einsichten </a>
  </span>

   <span data-toggle='tooltip' data-placement='top' title='Modul archvieren' class='<?php echo $modul["checkArchivBtn"] ?>'>
   <a href='#' data-toggle='modal' data-target='#Abfrage_<?php echo $modul["modul_id"]; ?>'>Archivierung</a>
   </span>

  <span data-toggle='tooltip' data-placement='top' title='Modul löschen' class='<?php echo $modul["checkDeleteBtn"] ?>'>
  <a href='#' data-toggle='modal' data-target='#Sicherheitsabfrage_<?php echo $modul["modul_id"]; ?>'>Modul löschen</a>
   </span>

   <span data-toggle='tooltip' data-placement='top' title='Nachrückverfahren einleiten' class='<?php echo $modul["checkNachrueckBtn"] ?>'>
    <a data-toggle='modal' data-target='#nachrueckverfahren_<?php echo $modul["modul_id"]; ?>' href='#'>Nachrückverfahren</a>
    </span>

<br><br>
  <?php for ($i = 0; $i < count($themen); $i++) { ?>
    <li>  
      
    <span data-toggle='tooltip' data-placement='top' title='Anmeldungen einsehen' class='<?php echo $modul["einsicht_bw_btn"] ?>'>
     <a href='/einsicht/<?php echo $modul["verfahren"];?>/<?php echo $themen[$i]["thema_id"]; ?>'><i style='color:white;' class="far fa-user"></i></a> 
      </span>

      <span data-toggle='tooltip' data-placement='top' title='Thema editieren' class='badge badge-secondary'>
      <a href='/mt_verwaltung/thema/edit/<?php echo $themen[$i]["thema_id"]; ?>'><i class='far fa-edit'></i></a>
      </span>  
     <?php echo $themen[$i]['themenbezeichnung'];?>

  </li>
  <?php } ?>
  <?php $this->getModal('delete_modul', $modul["modul_id"]); $this->getModal('archivierung', $modul["modul_id"]); $this->getModal('nachrueckverfahren', $modul["modul_id"]);?>                 
  </ol>

</table>
</edit>
  </div>