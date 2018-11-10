<br><h4>Verwaltung der Bewerbungen zum Bewerbungsverfahren</h4>
<open>
    <div class='alert alert-secondary' role='alert'>

    Auf das Thema <b>"<?php echo $infos['themenbezeichnung'] ;?>"</b>
    <?php if($infos['anzBew']>1){ echo "haben sich <b>{$infos['anzBew']}</b> Bewerber "; } else{ echo "hat sich <b>1</b> Bewerber";} ?>   
    beworben.
 </div>


<form style='margin-bottom:100px;' method="post"> 
     <div class="table-responsive" id="module">  
        <div class='bewerbung_verwaltung'>
            <table id="sort_einsicht_wh">
                <thead>
                    <tr>
                        <th class="no-sort" name='anmerkung'></th>
                        <th>Matrikelnr.</th>
                        <th>Email</th>
                        <th>FS</th>
                        <th>Credits</th>
                        <th>Studiengang</th>
                        <th>Punkte</th>
                        <th class="no-sort" name='funktionen'>Funktionen</th>
                    </tr>
                </thead>
                <?php for($k = 0; $k < count($bewerber); $k++){ ?>
                    <tr> 
                        <td></td>
                        <td><?php echo $bewerber[$k]['matrikelnummer']?></td>
                        <td><?php echo $bewerber[$k]['email']?></td>
                        <td><?php echo $bewerber[$k]['fachsemester']?></td>
                        <td><?php echo $bewerber[$k]['credits']?></td>
                        <td><?php echo $bewerber[$k]['studiengang']?></td>
                        <td><?php echo $bewerber[$k]['gesamt_punkte']?></td>
                        <td></td>
                    </tr>
                <?php } ?>               
            </table>
                <hr class="my-4"> 

        </div>
    </div>
</form>



</open>