<br><h4>Verwaltung der Anmeldungen zum Belegwunschverfahren</h4>
<open >
    <div class='alert alert-secondary' role='alert'>
        Von insgesamt <b><?php echo $infos['anzThema']; ?></b> 
        Themen 
             <?php if($infos['kategorie'] == "Seminararbeit"){ echo 'sind im Modul <b> "'. $infos['modulbezeichnung'].'"';} else {  echo 'in der Professur <b>"'. $infos['professur'].'"';} ?> 
            </b> <?php if($infos['anzThemaVergeben'] > 1){ echo "sind ".$infos['anzThemaVergeben'].""; } else if($infos['anzThemaVergeben'] == 0){ echo "kein";} else { echo "ist ein ".$infos['anzThemaVergeben'].""; } ?>
             <?php if($infos['anzThemaVergeben'] > 1){ echo "Themen"; } else { echo "Thema"; } ?> vergeben.
    </div>
         
<!-- ZUGETEILTE THEMEN -->
<form style='margin-bottom:100px;' method="post"> 
     <div class="table-responsive" id="module">  
     <div class='bewerbung_verwaltung'>
         Zugeteilte Themen
            <table id="sort_einsicht_bel">
                <thead>
                    <tr>
                        <th class="no-sort" name='anmerkung'></th>
                        <th>Thema</th>
                        <th>Matrikelnr.</th>
                        <th>Email</th>
                        <th>Status</th>                       
                        <th class="no-sort" name='funktionen'>Funktionen</th>
                    </tr>
                </thead>
                <?php for($k = 0; $k < count($bewerber); $k++){ ?>
                    <tr> 
                        <td></td>
                        <td><?php echo $bewerber[$k]['themenbezeichnung']?></td>
                        <td><?php echo $bewerber[$k]['matrikelnummer']?></td>
                        <td><?php echo $bewerber[$k]['email']?></td>
                        <td><?php echo $bewerber[$k]['status']?></td>
                        <td></td>
                    </tr>
                <?php } ?>   
                </table>
            <hr class="my-4"> 
        </div>
    </div>
</form>


<form style='margin-bottom:100px;' method="post"> 
     <div class="table-responsive" id="module">  
     <div class='bewerbung_verwaltung'>
         Kein Thema erhalten
            <table id="sort_einsicht_bel">
                <thead>
                    <tr>
                        <th class="no-sort" name='anmerkung'></th>
                        <th>Thema</th>
                        <th>Matrikelnr.</th>
                        <th>Email</th>
                        <th>Status</th>                       
                        <th class="no-sort" name='funktionen'>Funktionen</th>
                    </tr>
                </thead>
                <?php for($k = 0; $k < count($bewerber); $k++){ ?>
                    <tr> 
                        <td></td>
                        <td><?php echo $bewerber[$k]['themenbezeichnung']?></td>
                        <td><?php echo $bewerber[$k]['matrikelnummer']?></td>
                        <td><?php echo $bewerber[$k]['email']?></td>
                        <td><?php echo $bewerber[$k]['status']?></td>
                        <td></td>
                    </tr>
                <?php } ?>   
                </table>
            <hr class="my-4"> 
        </div>
    </div>
</form>


</open>
