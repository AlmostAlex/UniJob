<style>
.bootstrap-select show-tick{
    width:140px;
}
.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn){
    width:140px;
}
.show{
    display:none;
}

.bootstrap-select:not(.input-group-btn), .bootstrap-select[class*="col-"]{
    display:inline;
}

</style>


<h2 style='margin-top: 20px;' class='card-title'>Übersicht der Seminar- / Abschlussarbeitsthemen</h2>
<div style='text-align: center'>
<div class='suche'>
<table>
<tr>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Art</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Semester</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Betreuer</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Tags</b></th>
</tr>

<form method="post" action="">
    <tr>
        <td>

            <select class='form-control' id='art' name='art2' onchange="filter();">
            <option value=""></option>
                <option value='Abschlussarbeit' name='Abschlussarbeit'>Abschlussarbeiten1</option>
                <option value='Seminararbeiten' name='Seminararbeiten'>Seminararbeiten1</option>
            </select>

        </td>
        <td>

            <select class='form-control' id='semester' name='semester2' onchange="filter();">
                <option value=""></option>
                <option value='s12'>s12</option>
                <option value='s11'>s11</option>
            </select>
        </td>

         <td>
            <select class='form-control' id='betreuer' name='betreuer' onchange="filter();">
                <option value=""></option>
                <option value='schuhmann'>boss</option>
                <option value='kolbe'>boss!</option>
            </select>
       </td>
       <td> <!-- data-selected-text-format="count > 2" -->
       <select class="selectpicker" title="Tags" multiple data-live-search="true" multiple="multiple" name='tags' id="tags" onchange="filter();">
       <option value=""></option>
       <option value="him">Him</option>
       <option value="her">Her</option>
       <option value="kids">Kids</option>
       <option value="h2im">H2im</option>
       <option value="h3er">He3r</option>
       <option value="ki4ds">Ki1ds</option>
</select>
</td>
</tr>
</table>
</div>
</div>
</form>

    <div id="semester_f" class='modul_anzeige'>
        <table class='modul_table_uebersicht'>
            <tr>
                <th><a class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#modul_1' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></th>
                <th><b><titel>{$nachrueck_nachricht} {$modulbezeichnung}</titel></b><br>
                    <div class='border_round'><b>{$kategorie}</b></div>
                    <div class='border_round'><b>{$verfahren_scheinvariable}</b></div>
                    <div class='border_round'><i class='far fa-calendar'></i> <b>{$semester}</b></div>
                    <div class='border_round'><i class='far fa-clock'></i> <b>{$start_anzeige} - {$ende_anzeige}</b></div>
                </th>
                <th>$btn</th>
            </tr>
        </table>
        <inside>
            <div id='modul_1' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                <table class='th_table'>
                    <tr>
                        <th style='width:5%' class='bold_title'><center>Info</center></th>
                        <th style='width:75%' class='bold_title'><center>Titel</center></th>
                        <th style='width:15%' class='bold_title'><center>Betreuer</center></th>
                        <th style='width:20%' class='bold_title'><center>Verfügbarkeit</center></th>
                    </tr>
                    <tr>
                        <td><a class='collapsed' id='coll' data-toggle='collapse' data-parent='#accordion' href='#inhalt_1' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></td>
                        <td>{$themenbezeichnung}</td>
                        <td><center>{$this->benutzer->getDozent($benutzer_id)}</center></td>
                        <td><center><div $vergeben>{$thema_verfügbarkeit}</div></center></td>
                    </tr>
                    <tr class='nopadding'>
                        <td class='nopadding' colspan='6'>
                            <div id='inhalt_1' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                                <div class='information_content'>
                                    <b class='information_titel'>Inhaltliche Informationen:</b><br>
                                        <div class='information_content_inhalt'> <b>Bevorzugter Studiengang:</b> {$studiengang}<br>
                                            <b>Beschreibung:</b> {$beschreibung} 
                                        </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </inside>
    </div>
