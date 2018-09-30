

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
            </table>
            <table>
                <tr>
                    <td><label for="Modul"><b>Professur:</b><red>*</red></label></td>
                    <td colspan='2'><input type="text" class="form-control" id="professurbezeichnung" placeholder="Name der Professur" name="professurbezeichnung"> </td>
                    <td></td>
                </tr> 
                <tr>
                    <td><label for="Modul"><b>Fakultätsbezeichnung:</b><red>*</red></label></td>
                    <td colspan = 2><input type="text" class="form-control" id="fakultätsbezeichnung" name='fakultätsbezeichnung' placeholder="Bezeichnung der Fakultät" required> </td>
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
            </table>
            </br>
            <div class="form_ueberschrift">Themenangaben</div><br>
            <feld2>
            <table>
                <div class="form-group fieldGroup"> 
                    <tr>
                        <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
                        <td><space><input type="text" class="form-control" name='betreuerwindhund[]' placeholder="Betreuer des Themas"></space> </td>
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
            <td><label for="Vorkenntnisse"><b>Vorkentnisse:</b></label></td>
            <td colspan='2'>
                <div class="form-group">
                    <input type="text" id='vork'  style='display:none;' name='vorkenntnisse_WiBe[]' placeholder='Vorkenntnisse' class="form-control" />
                </div>
            </td>
        </tr>
                    <tr>
                        <td> <label for="Tags"><b>Tags:</b> </label></td>
                        <td colspan='1'>
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
        </feld2>
    
            <!-- Wenn Windhund oder Bewerbungsverfahren gewählt wurde...  -->
   
    <!-- Das kopierende Feld bei Windhund oder Bewerbung  -->
    <!--  COPY FIELDS --> 
<div class="form-group fieldGroupCopy" style="display: none;">     
    <table>
        <tr>
            <td class='first_td'><label for="Betreuer"><b>Betreuer:</b></label></td>
            <td><space><input type="text" class="form-control" name='betreuerwindhund[]' placeholder="Betreuer des Themas"></space> </td>
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

</form>
</div>