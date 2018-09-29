<form method='post'>
  <div class='edit_div_modul'>
    <table class='edit_div_table'>
      <tr>
        <td colspan='3'>
          <h5>Bearbeitung des Moduls:<br><span>
              <?php echo $modul["modulbezeichnung"] ?></span></h5>
        </td>
      </tr>
      <tr>
        <td><label for='Bezeichnung'><b>Modulbezeichnung:</b>
            <red style='color: red'>*</red>
          </label></td>
        <td colspan='2'><input type='text' id='bezeichnung' name='Bezeichnung' class='form-control' value='<?php echo $modul["modulbezeichnung"] ?>'
            required></td>
      </tr>
      <tr>
        <td><label for='Fakultät'><b>Fakultät:</b>
            <red style='color: red'>*</red>
          </label></td>
        <td colspan='2'><input type='text' id='fakultät' name='fakultät' class='form-control' value='<?php echo $modul["fakultaet"] ?>'
            required></td>
      </tr>
      <tr>
        <td><label for='Termine'><b>Bewerbungsfristen:</b>
            <red style='color: red'>*</red>
          </label></td>
        <td><input type='text' class='form-control' name='Start' value='<?php echo $start_anzeige ?>' <?php echo
            $check['fristen'] ?> id='datepicker_Start' required></td>
        <td><input type='text' class='form-control' name='Ende' value='<?php echo $ende_anzeige ?>' <?php echo
            $check['fristen'] ?> id='datepicker_Ende' required></td>
      </tr>
      </tr>
      <tr>
        <td><label for="SemesterEdit"><b>Semester:</b><red>*</red></label></td>
        <td style='height:45px;'> 
          <select  class="form-control" name="SemesterEdit" id="SemesterEdit" required>
            <option value="SoSe" <?php if($semester[0] == "SoSe"){echo "selected";} ?>>SoSe</option>
            <option value="WiSe" <?php if($semester[0] == "WiSe"){echo "selected";} ?>>WiSe</option>
          </select> 
        </td>
        <td>
        <!-- Wenn SoSe Gewählt wird-->
          <div id='SoSe'> 
            <input type="text" name='Semester_input1' class="form-control" value='<?php if($semester[0] == "SoSe"){echo $semester[1];} ?>'/>
          </div>
          <!-- Wenn WiSe Gewählt wird-->
          <div id='WiSe'> 
            <div class="input-group">
              <input type="text" name='Semester_input2' class="form-control" value='<?php if($semester[0] == "WiSe"){echo $semesterjahr[0];} ?>'/>
                <div class="input-group-append"><span class="input-group-text" style='border-right: 0px;'>&nbsp;/</span></div>
                <input type="text"  name='Semester_input3' class="form-control" value='<?php if($semester[0] == "WiSe"){echo $semesterjahr[1];} ?>'/>
            </div> 
          </div>  
          <!-- Auswahl Semester Ende -->
          </td>          
        </tr>    
      <tr>
        <td><label for='bevStudiengang'><b>bevorzugter Studiengang:</b></label></td>
        <td colspan='2'>
          <select class='form-control' name='Studiengang' id='Studiengang' required>
            <option value='None' <?php echo (($modul["studiengang"]=='None' )? "selected" : "" ); ?>>Keiner</option>
            <option value='Betriebswirtschaftlehre' <?php echo (($modul["studiengang"]=='Betriebswirtschaftlehre' )?
              "selected" : "" ); ?>>Betriebswirtschaftslehre</option>
            <option value='Wirtschaftsinformatik' <?php echo (($modul["studiengang"]=='Wirtschaftsinformatik' )?
              "selected" : "" ); ?>>Wirtschaftsinformatik</option>
            <option value='Volkswirtschaftslehre' <?php echo (($modul["studiengang"]=='Volkswirtschaftslehre' )?
              "selected" : "" ); ?>>Volkswirtschaftslehre</option>
            <option value='Wirtschaftspädagogik' <?php echo (($modul["studiengang"]=='Wirtschaftspädagogik' )?
              "selected" : "" ); ?>>Wirtschaftspädagogik</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for='verf'><b>Verfahren:<red style='color: red'>*</red></b></label></td>

        <td colspan='2'>
          <select class='form-control' name='Verfahren' id='Verfahren' <?php echo $check['verfahren_select'] ?>
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
        <td colspan='2'><br><input type='submit' name='modul_edit' class='btn btn-primary' value='Modul editieren' />
        </td>
      </tr>

    </table>
</form>

<table style='margin-bottom: 0%;' class='edit_div_table'>
  <tr>
    <td>
      <h5><i class='fas fa-list-ul'></i> Zu dem Modul gibt es folgende Themen:</h5>
    </td>
  </tr>
  <?php for ($i = 0; $i < count($themen); $i++) { ?>
  <tr>
    <td>
      <?php echo $themen[$i]['themenbezeichnung'];?>
    </td>
  </tr>
  <?php } ?>
  <tr>
</table>
</div>