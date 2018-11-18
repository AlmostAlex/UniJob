<editTh>
<form method='post'>
  <div class='edit_div_modul'>
    <table class='edit_div_table'>
      <tr>
        <td style='width:200px;' colspan='3'>
          <h5>Bearbeitung des Themas <?php ?>:<br><span>
              <?php  echo $thema['themenbezeichnung'];?></span></h5>
        </td>
      </tr>

      <tr>
        <td><label for='Betreuer'><b>Betreuer:</b><red style='color: red'>*</red></label></td>
        <td><input type='text' id='benutzername' name='benutzername' class='form-control' value='<?php echo $thema['benutzername']; ?>'></td>
      </tr>

      <tr>
        <td><label for='Bezeichnung'><b>Themenbezeichnung:</b><red style='color: red'>*</red></label></td>
        <td><input type='text' id='themenbezeichnung' name='themenbezeichnung' class='form-control' value='<?php echo $thema['themenbezeichnung']; ?>'></td>
      </tr>
      <tr>
        <td><label for='Beschreibung'><b>Themenbeschreibung</b><red style='color: red'>*</red></label></td>
        <td><textarea type='text' id='beschreibung' name='beschreibung' class='form-control'><?php echo $thema['beschreibung'];?></textarea></td>
      </tr>

        <td><label for="titel"><b>Vorkenntnisse:</b></label></td>
            <td colspan='3'><vorkspan>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">Vorkenntnisse</span>
                    </div>
                    <input style='width:330px;' type="text" name='vorkenntnisse[]' placeholder='Eingabe' class="tagsinput-typeahead2" value="<?php $k=0; while($k<count($vorkenntnisse)){if(isset($vorkenntnisse[$k]['bezeichnung'])){ echo $vorkenntnisse[$k]['bezeichnung'].","; $k=$k+1;} else {echo $vorkenntnisse[$k];$k=$k+1;}} ?>"/>             
                  </div>
            </vorkspan>
          </td>
        </tr>

      <tr>
      <td><label for="titel"><b>Tags:</b></label></td>
        <td colspan='3'> 
          <tagsspan>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Tags</span>
              </div>
              <tags><input style='width:80%;margin-left:0px;' type="text" name='tags[]' placeholder='Add Tags' class="tagsinput-typeahead" value="<?php $k=0; while($k<count($tags)){if(isset($tags[$k]['tag_bezeichnung'])){echo $tags[$k]['tag_bezeichnung'].","; $k=$k+1;}else{echo $tags[$k]; $k=$k+1;}} ?>"/></tags>
            </div>
          </tagsspan>
        </td>
      </tr>

<!--
      <tr>
        <td><label for='vorkenntnisse'><b>Vorkenntnisse</b><red style='color: red'>*</red></label></td>
        <div class="input-group"><vork><input style='margin-left: 130px;' type="text" id='vork'  style='display:none;' name='vorkenntnisse_WiBe[]' placeholder='Vorkenntnisse' class="form-control"/></vork></div>
      </tr> -->

      <tr>
        <td></td>
        <td><br><input type='submit' name='thema_edit' class='btn btn-primary' value='Thema editieren' /></td> 
      </tr>

</table>
</div>
</form>
</editTh>