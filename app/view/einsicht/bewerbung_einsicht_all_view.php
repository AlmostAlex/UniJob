<br><h4>Verwaltung aller Bewerbungen zum Bewerbungsverfahren</h4>
<open>
    <div class='alert alert-secondary' role='alert'>

     Auf <?php if($infos['kategorie']=='Abschlussarbeit') { echo "die Professur";} else {echo "das Modul "; } ?> <b>"<?php echo $infos['modulbezeichnung'] ;?>"</b>
    <?php if($infos['anzBew']>1){ echo "haben sich <b>{$infos['anzBew']}</b> Bewerber "; } else{ echo "hat sich <b>1</b> Bewerber";} ?>   
    beworben.
 </div>


 

<form style='margin-bottom:100px;' method="post"> 
     <div class="table-responsive" id="module">  
        <div class='bewerbung_verwaltung'>

            <div class='belegSort'>
            <b>Informationen aus-/einblenden: </b>
                <div class="form-check form-check-inline"><p><input type="checkbox" name="matrikelnummer" checked="checked" id="matr" /><label for="matr">Matr.</label></p></div>
                <div class="form-check form-check-inline"><p><input type="checkbox" name="email" id="email" /><label for="email">E-mail</label></p></div>
                <div class="form-check form-check-inline"><p><input type="checkbox" name="fs"  checked="checked" id="fs" /><label for="fs">FS</label></p></div>
                <div class="form-check form-check-inline"><p><input type="checkbox" name="credits"  checked="checked" id="credits" /><label for="credits">Credits</label></p></div>
                <div class="form-check form-check-inline"><p><input type="checkbox" name="studiengang"  checked="checked" id="studiengang" /><label for="studiengang">Studiengang</label></p></div>             
                <div class="form-check form-check-inline"><p><input type="checkbox" name="status"  id="status" checked="checked" /><label for="status">Status</label></p></div>           
            </div>

            
            <table id="sort_einsicht_wh">
                <thead>
                    <tr>
                        <th class="no-sort" name='anmerkung'></th>
                        <th class='matrikelnummer'>Themenbezeichnung</th>
                        <th class='anz'>Anz. Bewerber</th>
                    </tr>
                </thead>
                    <tr>
                    <td>PFEIL</td>
                    <td>THEMA</td> 
                    <td>5</td>
                    </tr>
            </table>
                <hr class="my-4">
        </div>
    </div>
</form>

</open>