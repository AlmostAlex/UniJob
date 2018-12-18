

<div class="verwaltungsbox">
    <h4 class='card-title'><i class="fa fa-info-circle" aria-hidden="true"></i> Zum Eintrag eines Seminars einer Professur</h4>
    Um erfolgreich ein Seminarthema anzulegen, ist es zunächst erforderlich, dass:<br>
    <ul>
    <li>  alle <b>Pflichtfelder</b> <red>*</red> ausgefüllt werden</li>
    <li>  und ein <b>Verfahren</b> gewählt wird.</li>
    <li>  beim Verfahren <b>"Belegwunsch"</b>, sind mindestens <b>drei</b> Themen erforderlich.</li>
    <li>  Es können beliebig viele Themen über die Verwaltungsseite angelegt und im Nachhinein ergänzt werden</li>
</div>
<div class="form_thema">
    <form action='' method="post" name='mod' id='mod'>
        <feld>
            <table id='general'> 
                <div class="form_ueberschrift">Allgemeine Informationen</div><br>
            </table>
            <table>
                <tr>
                    <th style="padding-left: 250px;">
                    <th>
                    <th>
                </tr>
                <td><label for="Abschlusstyp"><b>Kategorie:</b><red>*</red></label></td>
                <td>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="radio1" value='Bachelor' name="Abschlusstyp">
                        <label class="custom-control-label" for="radio1">Master</label>
                    </div>
                </td>
                <td>
                 <!-- Group of default radios - option 2 -->
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="radio2" value='Master' name="Abschlusstyp">
                        <label class="custom-control-label" for="radio2">Bachelor</label>
                    </div>
                </td>
                <td>
                 <!-- Group of default radios - option 2 -->
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="radio2" value='Bachelor/Master' name="Abschlusstyp">
                        <label class="custom-control-label" for="radio2">Beides</label>
                    </div>
                </td>
                <tr>
                    <td><label for="Modul"><b>Seminarbezeichnung:</b><red>*</red></label></td>
                    <td colspan = 3><input type="text" class="form-control" id="modulbezeichnung" name='modulbezeichnung' placeholder="Bezeichnung der Veranstaltung" required> </td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="Modul"><b>Professur:</b><red>*</red></label></td>
                    <td colspan = 3><input type="text" class="form-control" id="professurbezeichnung" name='professurbezeichnung' placeholder="Name der Professur" required> </td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="Termine"><b>Bewerbungsfristen:</b><red>*</red></label></td>
                    <td style='padding-bottom: 30px;'>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="form-control" name="Start" autocomplete="off" placeholder="TT-MM-JJJJ" id="datepicker_Start" required>
                            <span id='datebox' class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <dates>
                            <text style='padding-right: 15px;padding-left: 20px;margin-top: 10px;height: 30px;'  for="starttermin">Bewerbungsstart <red>*</red> </text>
                        </dates>
                    </td>
                    <td style='padding-bottom: 30px;'>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="form-control" name="Ende" autocomplete="off" placeholder="TT-MM-JJJJ" id="datepicker_Ende" required>
                            <span id='datebox' class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <dates>
                        <text style='padding-right: 20px;padding-left: 20px;margin-top: 10px;height: 30px;'  for="endtermin">Bewerbungsende <red>*</red> </text>
                        </dates>
                    </td>
                    <td style='padding-bottom: 30px;'>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="form-control" name="Kickoff" autocomplete="off" placeholder="TT-MM-JJJJ" id="datepicker_kickoff">
                            <span id='datebox' class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>    
                        <dates>                       
                        <text style='padding-right: 27px;padding-left: 30px;margin-top: 10px;height: 30px;'  for="kickofftermin">Kickofftermin</text>
                    </dates>                   
                    </td>
                </tr>                
                <!-- Auswahl Semester-->
                <tr>
                    <td><label for="Semester"><b>Semester:</b><red>*</red></label></td>
                    <td colspan = 1 style='height:45px;'> 
                        <select  class="form-control" name="Semester" id="Semester" required>
                            <option value=""></option>
                            <option value="SoSe">SoSe</option>
                            <option value="WiSe">WiSe</option>
                        </select> 
                    </td>
                    <td colspan = 2>
                    <!-- Solange noch kein Semester gewählt ist-->
                        <div id='semester_meldung'> 
                            <div class="alert alert-warning" role="alert">
                                <i class="fas fa-info"></i> Wähle ein Semester aus.
                            </div>
                        </div>
                    <!-- Wenn SoSe Gewählt wird-->
                        <div id='SoSe'> 
                            <input type="text" name='Semester_input1' class="form-control"/>
                        </div>
                    <!-- Wenn WiSe Gewählt wird-->
                        <div id='WiSe'> 
                            <div class="input-group">
                                <input type="text" name='Semester_input2' class="form-control"/>
                                <div class="input-group-append"><span class="input-group-text" style='border-right: 0px;'>&nbsp;/</span></div>
                                <input type="text"  name='Semester_input3' class="form-control"/>
                            </div> 
                        </div>  
                    <!-- Auswahl Semester Ende -->
                    </td>          
                </tr>   
                <tr>
                    <td><label for="Beschreibung"><b>Zusätzliche Hinweise:</b></label></td>
                    <td colspan = "3"><textarea type="text" name="hinweise" id="hinweise" class="form-control" placeholder="Hinweise zur Professur, zum Ablauf o.ä."></textarea></td>
                </tr>     
                <tr>
                    <td><label for="Studiengang"><b>Bevorzugter Studiengang:</b></label></td>
                    <td colspan='3'>
                        <select class="form-control" name="Studiengang" id="Studiengang" required>
                            <option value="None">Keiner</option>
                            <option value="Betriebswirtschaftslehre">Betriebswirtschaftslehre</option>
                            <option value="Wirtschaftsinformatik">Wirtschaftsinformatik</option>
                            <option value="Volkswirtschaftslehre">Volkswirtschaftslehre</option>
                            <option value="Wirtschaftspädagogik">Wirtschaftspädagogik</option>                     
                        </select>
                    </td>
                </tr>
                </table>
                    <div id='Schwerpunktbwl'>
                        <table>        
                            <tr>
                            <td style='min-width: 37.3%; width: 34.3%;'><label for="Schwerpunkt"><b><b>Schwerpunkt / Master:</b></label></td>
                                <td>
                                    <select style='min-width: 97.3%; width: 97.4%;' class="form-control" name="Schwerpunkt" id="Schwerpunkt">
                                        <option value="None">Keiner</option>
                                        <option value="Finanzen, Rechnungswesen, Steuern">Finanzen, Rechnungswesen, Steuern</option>
                                        <option value="Unternehmensführung">Unternehmensführung</option>
                                        <option value="Marketing und E-Business">Marketing und E-Business</option>                    
                                    </select>
                                </td>
                            </tr>
                        </table>            
                    </div>
                <table>
                <!-- Verfahrenauswahl -->   
                <tr>
                    <td style='min-width: 34%; width: 34.3%;'><label for="Verfahren"><b>Verfahren:</b></label></td>  
                    <td colspan='3'><select style='min-width: 98%; width: 97.4%;' name="verfahren" id="verfahren" class="form-control">
                            <option value=""></option>
                            <option value="Windhundverfahren">Windhundverfahren</option>
                            <option value="Bewerbungsverfahren">Bewerbungsverfahren</option>
                            <option value="Belegwunschverfahren">Belegwunschverfahren</option>
                        </select></td>  
                </tr>            
                <tr>
                    <td></td>
                    <td colspan='3'>
                        <div id='meldung_verfahren' class='alert alert-danger'> Wähle ein Verfahren aus!</div>
                    </td>
                </tr>
            </table>
                <!-- Wenn Windhund oder Bewerbungsverfahren gewählt wurde...  -->
   
    <!-- Das kopierende Feld bei Windhund oder Bewerbung  -->
    <!--  COPY FIELDS --> 
<div class="form-group fieldGroupCopy" style="display: none;">     
    <table>

        <tr>
            <td class='first_td'><label style='width: 150px;' for="Betreuer"><b>Betreuer:</b></label></td>
            <td><space><input style='margin-left: 90px;' type="text" class="form-control" name='betreuerwindhund[]' placeholder="Betreuer des Themas"></space> </td>
            <td><a href="javascript:void(0)" class="btn btn-danger remove">-</a></td>
        </tr>

        <tr>
            <td class='first_td'><label for="titel"><b>Titel:</b></label></td>
            <td><space><input  style='margin-left: 90px;'  type="text" name="themenbezeichnungwindhund[]" class="form-control" placeholder="Titel des Themas"/></space></td>  
        </tr>
       <tr>
            <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
            <td><textarea style='margin-left: 90px;' type="text" name="themenbeschreibung[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
        </tr>     
        <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:90px' class="input-group-text">Vorkenntnisse</span>
  </div>
  <vork><input  style='margin-left: 130px;'  type="text" id='vork'  style='display:none;' name='vorkenntnisse_WiBe[]' placeholder='Vorkenntnisse' class="form-control" />                            
</vork></div>
</td>
</tr>

<tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:90px' class="input-group-text">Tags</span>
  </div>
  <tags>
  <input type="text" id='taggin' name='tags_WiBe[]' placeholder='Add Tags' class="form-control" />
                  </tags>
</div>
</td>
</tr>
    </table>
</div>
<!--  COPY FIELD END -->

<!--  COPY FIELDS BELEGWUNSCH --> 
<div class="form-group fieldGroupCopy2" style="display: none;">
    <table>
        <tr>
            <td class='first_td'><label style='width: 150px;' for="Betreuer"><b>Betreuer:</b></label></td>
            <td><space><input type="text" class="form-control" name='betreuerbelegwunsch[]' placeholder="Betreuer des Themas"></space> </td>
            <td><a href="javascript:void(0)" class="btn btn-danger remove">-</a></td>
        </tr>
        <tr>
            <td class='first_td'><label for="titel"><b>Titel:</b></label></td>
            <td><space><input type="text" name="themenbezeichnungbelegwunsch[]" class="form-control" placeholder="Titel des Themas"/></space></td>  
        </tr>
            <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
            <td><textarea type="text" name="themenbeschreibungbelegwunsch[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
        </tr>
 <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:88px' class="input-group-text">Vorkenntnisse</span>
  </div>
  <vork>
  <input style='width:80%;margin-left:0px;'  type="text" id='vork' name='vorkenntnisse_Beleg[]' placeholder='erforderlichen Vorkenntnisse' class="form-control" />
</vork>
</div>
</td>
</tr>


 <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:88px' class="input-group-text">Tags</span>
  </div>
  <tags><input style='width:80%;margin-left:0px;' type="text" id='taggin' name='tags_Beleg[]' placeholder='Add Tags' class="form-control" />                              
</tags></div>
</td>
</tr>

    </table>
</div>
<!--  COPY FIELD END -->
<!-- Das kopierende Feld bei Windhund oder Bewerbung  ENDE -->

<!-- Wenn Windhund oder Bewerbungsverfahren gewählt wurde...  -->
<feld2>
    <div id="WindUndBew">
        <div class="form_ueberschrift">Themenangaben</div><br>
        <table>
            <div class="form-group fieldGroup"> 
                <tr>
                    <td class='first_td'><label style='width: 150px;' for="Betreuer"><b>Betreuer:</b></label></td>
                    <td><space><input type="text" class="form-control" name='betreuerwindhund[]' placeholder="Betreuer des Themas"></space> </td>
                    <td><a href="javascript:void(0)" class="btn btn-success addMore2">+</a></td>
                </tr>
                <tr>
                    <td class='first_td'><label for="titel"><b>Titel:</b></label></td>
                    <td><space><input type="text" name="themenbezeichnungwindhund[]" class="form-control" placeholder="Titel des Themas"/></space></td>  
                </tr>
                <tr>
                    <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
                    <td colspan='2'><textarea type="text" name="themenbeschreibung[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
                </tr>
 <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:87px' class="input-group-text">Vorkenntnisse</span>
  </div>
  <vork><input style='width:80%;margin-left:0px;' type="text" name='vorkenntnisse_WiBe[]' placeholder='Eingabe' class="tagsinput-typeahead2" />                            
</vork></div>
</td>
</tr>


 <tr>
     <td></td>
     <td colspan='2'>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:87px' class="input-group-text">Tags</span>
  </div>
  <tags><input style='width:80%;margin-left:0px;' type="text" name='tags_WiBe[]' placeholder='Add Tags' class="tagsinput-typeahead" />                              
</tags></div>
</td>
</tr>

                <tr>
                    <td colspan='3'><input style='float:right;'type="submit" name="modul_eintrag1" class="btn btn-primary" value="Modul eintragen"/> </td>
                </tr>
            </div>
        </table> 
    </div>     
</feld2>
<!-- ENDE-->
<!-- Wenn BELEGWUNSCH gewählt wurde...  -->
<feld3> 
<div id="Belegwunschverfahren">
    <div class="form_ueberschrift">Themenangaben</div><br>
    <table>
        <div class="form-group fieldGroup">
        <!-- 1 -->
            <tr>
                <td class='first_td'><label style='width: 150px;' for="Betreuer"><b>Betreuer:</b></label></td>
                <td><space><input type="text" class="form-control" name='betreuerbelegwunsch[]' placeholder="Betreuer des Themas"></space> </td>
                <td><a href="javascript:void(0)" class="btn btn-success addMore3">+</a></td>
            </tr>
            <tr>
                <td class='first_td'><label for="titel"><b>Titel: <red> * </red> </b></label></td>
                <td><space><input type="text" name="themenbezeichnungbelegwunsch[]" id="validationCustom03" class="form-control" placeholder="Titel des Themas"/><space></td>  
            </tr>
            <tr>
                <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
                <td><textarea type="text" name="themenbeschreibungbelegwunsch[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
            </tr>

 <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:88px' class="input-group-text">Vorkenntnisse</span>
  </div>
  <vork>
  <input style='width:80%;margin-left:0px;' type="text" name='vorkenntnisse_Beleg[]' placeholder='erforderlichen Vorkenntnisse' class="tagsinput-typeahead2" />                            
</vork>
</div>
</td>
</tr>

 <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:88px' class="input-group-text">Tags</span>
  </div>
  <tags><input style='width:80%;margin-left:0px;' type="text" name='tags_Beleg[]' placeholder='Add Tags' class="tagsinput-typeahead" />                              
</tags></div>
</td>
</tr>

        <!-- 2 -->
            <tr>
                <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
                <td><space><input type="text" class="form-control" name='betreuerbelegwunsch[]' placeholder="Betreuer des Themas" ></space> </td>
            </tr>
            <tr>
                <td><label for="titel"><b>Titel: <red style="color: red"> * </red> </b></label></td>
                <td><space><input type="text" name="themenbezeichnungbelegwunsch[]" id="validationCustom03" class="form-control" placeholder="Titel des Themas"/></space></td>  
            </tr>
            <tr>
                <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
                <td><textarea type="text" name="themenbeschreibungbelegwunsch[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
            </tr>
            <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:88px' class="input-group-text">Vorkenntnisse</span>
  </div>
  <vork>
  <input style='width:80%;margin-left:0px;' type="text" name='vorkenntnisse_Beleg[]' placeholder='erforderlichen Vorkenntnisse' class="tagsinput-typeahead2" />                            
</vork>
</div>
</td>
</tr>

 <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:88px' class="input-group-text">Tags</span>
  </div>
  <tags><input style='width:80%;margin-left:0px;' type="text" name='tags_Beleg[]' placeholder='Add Tags' class="tagsinput-typeahead" />                              
</tags></div>
</td>
</tr>
        <!-- 3 -->
            <tr>
                <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
                <td><space><input type="text" class="form-control" name='betreuerbelegwunsch[]' placeholder="Betreuer des Themas"></space> </td>
            </tr>
            <tr>
                <td><label for="titel"><b>Titel: <red style="color: red"> * </red></b></label></td>
                <td><space><input type="text" name="themenbezeichnungbelegwunsch[]" id="validationCustom03" class="form-control" placeholder="Titel des Themas"/></space></td>  
            </tr>
            <tr>
                <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
                <td><textarea type="text" name="themenbeschreibungbelegwunsch[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
            </tr>
            <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:88px' class="input-group-text">Vorkenntnisse</span>
  </div>
  <vork>
  <input style='width:80%;margin-left:0px;' type="text" name='vorkenntnisse_Beleg[]' placeholder='erforderlichen Vorkenntnisse' class="tagsinput-typeahead2" />                            
</vork>
</div>
</td>
</tr>

 <tr>
     <td></td>
      <td>
<div class="input-group">
  <div class="input-group-prepend">
    <span style='margin-left:88px' class="input-group-text">Tags</span>
  </div>
  <tags><input style='width:80%;margin-left:0px;' type="text" name='tags_Beleg[]' placeholder='Add Tags' class="tagsinput-typeahead" />                              
</tags></div>
</td>
</tr>
        <!-- button -->
        </div>
    </table>  
    <input type="submit" name="modul_eintrag2" class="btn btn-primary" value="Modul eintragen"/>
</div>
</feld3>
</form>
</div>