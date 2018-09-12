<div class="form-group">
    <input type="text" name='tags_WiBe[]' placeholder='Add Tags' class="tagsinput-typeahead" />
</div>



<div class="verwaltungsbox">
    <h4 class='card-title'><i class="fa fa-info-circle" aria-hidden="true"></i>  Zum Eintrag eines Moduls</h4>
    Um erfolgreich einen Kurs anzulegen, ist es zunächst erforderlich, dass:<br>
    <ul>
    <li>  alle <b>Pflichtfelder</b> <red>*</red> ausgefüllt werden,</li>
    <li>  eine <b>Kategorie</b> gewählt wird,</li>
    <li>  und ein <b>Verfahren</b> gewählt wird.</li>
    <li>  beim Verfahren <b>"Belegwunsch"</b>, sind mindestens <b>drei</b> Themen erforderlich.</li>
   
    <li>Bei Abschlussarbeiten geben Sie bitte zudem Ihre Professur an und geben Sie an, ob die Arbeit für Bachelor-, Masterstudiengänge oder beides verfügbar ist.</li> </ul>  
    Es können zum Kurs beliebig viele Themen angelegt werden. Es besteht zudem die Möglichkeit,
    nachträglich Themen zu eingetragenen Kursen hochzuladen. <a href="/mt_verwaltung.php"><i class="fa fa-arrow-right"></i>Themen eintragen</a>
</div>
<div class="form_thema">
    <form action='' method="post" name='mod' id='mod'>
        <feld>
            <table id='general'> 
                <div class="form_ueberschrift">Allgemeine Informationen</div><br>
                <tr>
                    <td><label for="Kategorie"><b>Kategorie:</b><red>*</red></label></td>
                    <td>
                        <input id="Kategorie" autocomplete='off' type="radio" name="Kategorie" value="Seminararbeit" class="Kategorie" /><space>Seminararbeit</space></input> 
                    </td>
                    <td><input id="Kategorie" type="radio" name="Kategorie" value="Abschlussarbeit" class="Kategorie" /><space>Abschlussarbeit</space></input></td>
                    <td></td>
                </tr>
                <!-- Solange noch keine Kategorie gewählt ist 
                <div id='kategorie_meldung'> 
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-info"></i> Wähle eine Kategorie aus.
                    </div>
                </div>
                <!-- Wenn Seminar Gewählt wird 
                <div id='Seminarmodul'> 
                    <tr>
                        <td><label for="Modul"><b>Seminarbezeichnung:</b><red>*</red></label></td>
                        <td colspan='2'><input type="text" class="form-control" id="modulbezeichnung" name='modulbezeichnung' placeholder="Bezeichnung der Veranstaltung" name="Bezeichnung" required> </td>
                        <td></td>
                    </tr> 
                </div>
                <!-- Wenn Abschlussarbeit Gewählt wird 
                <div id='Professur'> 
                    <tr>
                        <td><label for="Modul"><b>Professur:</b><red>*</red></label></td>
                        <td colspan='2'><input type="text" class="form-control" id="professur" placeholder="Name der Professur" name="Professur" required> </td>
                        <td></td>
                    </tr> 
                </div> -->
                <tr>
                    <td><label for="Modul"><b>Fakultätsbezeichnung:</b><red>*</red></label></td>
                    <td colspan='2'><input type="text" class="form-control" id="fakultätsbezeichnung" name='fakultätsbezeichnung' placeholder="Bezeichnung der Fakultät" required> </td>
                    <td></td>
                </tr> 
                <tr>
                    <td><label for="Modul"><b>Seminarbezeichnung:</b><red>*</red></label></td>
                    <td colspan='2'><input type="text" class="form-control" id="modulbezeichnung" name='modulbezeichnung' placeholder="Bezeichnung der Veranstaltung" name="Bezeichnung" required> </td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="Termine"><b>Bewerbungsfristen:</b><red>*</red></label></td>
                    <td>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="form-control" name="Start" autocomplete="off" placeholder="TT-MM-JJJJ" id="datepicker_Start" required>
                            <span id='datebox' class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type="text" class="form-control" name="Ende" autocomplete="off" placeholder="TT-MM-JJJJ" id="datepicker_Ende" required>
                            <span id='datebox' class="input-group-addon">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                    </td>                              
                </tr> 
                <!-- Auswahl Semester-->
                <tr>
                    <td><label for="Semester"><b>Semester:</b><red>*</red></label></td>
                    <td style='height:45px;'> 
                        <select  class="form-control" name="Semester" id="Semester" required>
                            <option value=""></option>
                            <option value="SoSe">SoSe</option>
                            <option value="WiSe">WiSe</option>
                        </select> 
                    </td>
                    <td>

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
                    <td><label for="Studiengang"><b>Bevorzugter Studiengang:</b></label></td>
                    <td colspan='2'>
                        <select class="form-control" name="Studiengang" id="Studiengang" required>
                            <option value="None">Keiner</option>
                            <option value="Betriebswirtschaftlehre">Betriebswirtschaftslehre</option>
                            <option value="Wirtschaftsinformatik">Wirtschaftsinformatik</option>
                            <option value="Volkswirtschaftslehre">Volkswirtschaftslehre</option>
                            <option value="Wirtschaftspädagogik">Wirtschaftspädagogik</option>
                        </select>
                    </td>
                </tr>

                <!-- Verfahrenauswahl -->   
                <tr>
                    <td><label for="Verfahren"><b>Verfahren:</b></label></td>  
                    <td colspan='2'><select  name="verfahren" id="verfahren" class="form-control">
                            <option value=""></option>
                            <option value="Windhundverfahren">Windhundverfahren</option>
                            <option value="Bewerbungsverfahren">Bewerbungsverfahren</option>
                            <option value="Belegwunschverfahren">Belegwunschverfahren</option>
                        </select></td>  
                </tr>            
                <tr>
                    <td></td>
                    <td colspan='2'>
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
            <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
            <td><space><input type="text" class="form-control" id="betreuer" name='betreuer' placeholder="Betreuer des Themas" required></space> </td>
            <td><a href="javascript:void(0)" class="btn btn-danger remove">-</a></td>
        </tr>
        <tr>
            <td class='first_td'><label for="titel"><b>Titel:</b></label></td>
            <td><space><input  type="text" name="themenbezeichnungwindhund[]" class="form-control" placeholder="Titel des Themas"/></space></td>  
        </tr>
        <tr>
            <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
            <td><textarea type="text" name="themenbeschreibung[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
        </tr>
        <tr>
            <td><label for="Tags"><b>Tags:</b></label></td>
            <td colspan='2'>
                <div class="form-group">
                    <input type="text" id='taggin' name='tags_WiBe[]' placeholder='Add Tags' class="form-control" />
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
            <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
            <td><space><input type="text" class="form-control" id="betreuer" name='betreuer' placeholder="Betreuer des Themas" required></space> </td>
            <td><a href="javascript:void(0)" class="btn btn-danger remove">-</a></td>
        </tr>
        <tr>
            <td class='first_td'><label for="titel"><b>Titel:</b></label></td>
            <td><space><input type="text" name="themenbezeichnungbelegwunsch[]" class="form-control" placeholder="Titel des Themas"/></space></td>  
        </tr>
            <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
            <td><textarea type="text" name="themenbeschreibungbelegwunsch[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
        </tr>
            <td><label for="Tags"><b>Tags:</b></label></td>
            <td colspan='2'>
                <div class="form-group">
                    <input type="text" id='taggin' name='tags_Beleg[]' placeholder='Add Tags' class="form-control" />
                </div>
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
                    <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
                    <td><space><input type="text" class="form-control" id="betreuer" name='betreuer' placeholder="Betreuer des Themas" required></space> </td>
                    <td><a href="javascript:void(0)" class="btn btn-success addMore2">+</a></td>
                </tr>
                <tr>
                    <td class='first_td'><label for="titel"><b>Titel:</b></label></td>
                    <td><space><input type="text" name="themenbezeichnungwindhund[]" class="form-control" placeholder="Titel des Themas"/></space></td>  
                </tr>
                <tr>
                    <td><label for="Beschreibung"><b>Beschreibung:</b></label></td>
                    <td><textarea type="text" name="themenbeschreibung[]" class="form-control" placeholder="Beschreibung des Themas"/></textarea></td>
                </tr>
                <tr>
                    <td> <label for="Tags"><b>Tags:</b> </label></td>
                    <td colspan='2'>
                        <div class="form-group">
                            <input type="text" name='tags_WiBe[]' placeholder='Add Tags' class="tagsinput-typeahead" />                            
                        </div>
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
                <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
                <td><space><input type="text" class="form-control" id="betreuer" name='betreuer' placeholder="Betreuer des Themas" required></space> </td>
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
                <td><label for="Tags"><b>Tags:</b></label></td>
                <td colspan='2'>
                    <div class="form-group">
                        <input type="text" name='tags_Beleg[]' placeholder='Add Tags' class="tagsinput-typeahead" />
                    </div>
                </td>
            </tr>
        <!-- 2 -->
            <tr>
                <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
                <td><space><input type="text" class="form-control" id="betreuer" name='betreuer' placeholder="Betreuer des Themas" required></space> </td>
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
                <td><label for="Tags"><b>Tags:</b></label></td>
                <td colspan='2'>
                    <div class="form-group">
                        <input type="text" name='tags_Beleg[]' placeholder='Add Tags' class="tagsinput-typeahead" />
                    </div>
                </td>
            </tr>
        <!-- 3 -->
            <tr>
                <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
                <td><space><input type="text" class="form-control" id="betreuer" name='betreuer' placeholder="Betreuer des Themas" required></space> </td>
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
                <td><label for="Tags"><b>Tags:</b></label></td>
                <td colspan='2'>
                    <div class="form-group">
                        <input type="text" name='tags_Beleg[]' placeholder='Add Tags' class="tagsinput-typeahead" />
                    </div>
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