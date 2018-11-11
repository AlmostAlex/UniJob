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
<form style='margin-bottom:30px;' method="post"> 
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
<!-- KEIN THEM AERHALTEN -->
<?php if($keinThemaCount == 0){} else{  ?>   

<table style='border:0px solid transparent'>
    <tr>
        <td colspan='5'>
           <b>
            <h6><span style='float: left;' class="badge badge-info"> <?php echo $keinThemaCount; ?></span> 
                <div class='verf_border'>
                <a data-toggle="collapse" id='verg' data-target="#vergeben" href="#vergeben" role="button" aria-expanded="false" aria-controls="vergeben">
                Kein Thema erhalten <span style='font-size: 0.7em;' class="glyphicon glyphicon-plus"></span>
                </a>
                                    </div> 
                                </h6>
                            </b>
                        </td>
                    </tr>  
                </table>
                <?php } ?>  
        <div class="collapse" id="vergeben">   
<form style='margin-bottom:0px;' method="post"> 
     <div class="table-responsive" id="module">  
     <div class='bewerbung_verwaltung'>
            <table id="sort_einsicht_bel_keinTh">
                <thead>
                    <tr>
                        <th class="no-sort" name='anmerkung'></th>
                        <th>Matrikelnr.</th>
                        <th>Email</th>
                        <th>Status</th>                       
                        <th class="no-sort" name='funktionen'>Funktionen</th>
                    </tr>
                </thead>
                <?php for($i = 0; $i < count($keinThema); $i++){ ?>
                    <tr> 
                        <td></td>
                        <td><?php echo $keinThema[$i]['matrikelnummer']?></td>
                        <td><?php echo $keinThema[$i]['email']?></td>
                        <td><?php echo $keinThema[$i]['status']?></td>
                        <td></td>
                    </tr>
                <?php } ?>   
                </table>
            <hr class="my-4"> 
        </div>
    </div>
</form>
                </div>
<br><br><br>
</open>
