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
        <div class='belegSort'>
        <b>Informationen aus-/einblenden: </b>
            <div class="form-check form-check-inline"> <p><input type="checkbox" name="pri1" id="pri1" checked="checked"/><label for="pri1">Priorität 1</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox" name="pri2" id="pri2" checked="checked" /><label for="pri2">Priorität 2</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox" name="pri3" id="pri3" checked="checked" /><label for="pri3">Priorität 3</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox" name="matrikelnummer" id="matr" /><label for="matr">Matr.</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox"  name="email"  id="email" /><label for="email">E-mail</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox" name="status"  id="status" checked="checked" /><label for="status">Status</label></p></div>
        </div>

            <table id="sort_einsicht_bel"> 
                <thead>
                    <tr>
                        <th class="no-sort" name='anmerkung'>Info</th>
                        <th><u>Erhaltenes Thema</u></th>

                        <th class='pri1'>Pr1</th>  
                        <th class='pri2'>Pr2</th>  
                        <th class='pri3'>Pr3</th>

                        <th class='matrikelnummer'>Matrikelnr.</th>
                        <th class='email'>Email</th>
                        <th class='status'>Status</th>  

                      <th class="no-sort" name='funktionen'>Funktionen</th>
                    </tr>
                </thead>
                <?php for($k = 0; $k < count($bewerber); $k++){ ?>
                    <tr> 
                        <td style='width:3%;'> </td>
                        <td style='width:20%; vertical-align: top;'><b><?php echo $bewerber[$k]['themenbezeichnung'] ?></b></td>

                        <td style='width:20%; vertical-align: top;' class='pri1'><?php echo $bewerber[$k]['pri1']?></td>
                        <td style='width:20%; vertical-align: top;' class='pri2'><?php echo $bewerber[$k]['pri2']?></td>
                        <td style='width:20%; vertical-align: top;' class='pri3'><?php echo $bewerber[$k]['pri3']?></td>

                        <td class='matrikelnummer'><?php echo $bewerber[$k]['matrikelnummer']?></td>
                        <td class='email'><?php echo $bewerber[$k]['email']?></td>
                        <td class='status'><?php echo $bewerber[$k]['status']?></td>
                        <td>
                            <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#exampleModal"
                            id='swap'
                            class='swap'
                            data-bew-id='<?php echo $bewerber[$k]['belegwunsch_id']?>' 
                            data-matr='<?php echo $bewerber[$k]['matrikelnummer']?>' 
                            data-thema='<?php echo $bewerber[$k]['erhaltenesthema']?>'
                            onclick="swap(this)"
                            > 
                                <span class="badge badge-primary">
                                    <i class="fas fa-exchange-alt"></i>
                                </span>
                            </a>

                            <a>
                            <span class="badge badge-info">
                                <i class="far fa-envelope"></i>
                                </span>  
                            </a>
                        </td>
            
                <?php } ?>   
                </table>
            <hr class="my-4"> 
        </div>
    </div>
</form>

<nachrueckv style='<?php echo $display;?>'>
   <b> <i class="fas fa-arrow-right"></i>  Anmeldungen während des Nachrückverfahrens </b>
<!-- NACHRÜCKVERFAHREN TABELLE WENN BEWERBUNGEN ZUM NACHRÜCKVERFAHREN EXISTIEREN! -->
<form style='margin-bottom:30px;' method="post"> 
     <div class="table-responsive" id="module">
        <div class='bewerbung_verwaltung'>
            <div class='belegSort'>
                    <b>Informationen aus-/einblenden: </b>
                        
                    <div class="form-check form-check-inline"><p><input type="checkbox" name="name" checked="checked" id="name" /><label for="name">Name</label></p></div>
                    <div class="form-check form-check-inline"><p><input type="checkbox" name="matrikelnummer" checked="checked" id="matr" /><label for="matr">Matr.</label></p></div>
                    <div class="form-check form-check-inline"><p><input type="checkbox" name="email" id="email" /><label for="email">E-mail</label></p></div>
                    <div class="form-check form-check-inline"><p><input type="checkbox" name="status"  id="status" checked="checked" /><label for="status">Status</label></p></div>           
            </div>

                <table id="sort_einsicht_wh">
                    <thead>
                        <tr>
                            <th class="no-sort" name='anmerkung'>Info</th>
                            <th>Thema</th>
                            <th class='name'>Name</th>
                            <th class='matrikelnummer'>Matrikelnummer</th>
                            <th class='email'>Email</th>
                            <th class='status'>Status</th>
                            <th class="no-sort" name='funktionen'>Funktionen</th>
                        </tr>
                    </thead>
                    <tr>
                        <td></td>
                        <td>hi</td>
                        <td>hi</td>
                        <td>hi</td>
                        <td>hi</td>
                        <td>hi</td>
                        <td>hi</td>
                    </tr>
                </table>
        </div>
    </div>
</form>
</nachrueckv>


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
                        <td>

                            <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#exampleModal"
                            id='swap'
                            class='swap'
                            data-bew-id='<?php echo $keinThema[$i]['belegwunsch_id']?>' 
                            data-thema='<?php echo NULL;?>'
                            onclick="swap(this)"
                            >  
                                <span class="badge badge-primary">
                                    <i class="fas fa-exchange-alt"></i>
                                </span>
                            </a>
                        
                        </td>
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

<!-- Modal -->
<div style=' top: 25%; left: -30%;' class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div style='width: 180%;height: 65%;' class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <div class='swapContent' id='swapContent'></div>

      </div>
      <div class="modal-footer">
        <button type="button" id='closeBeleg' onClick="window.location.href=window.location.href" class="btn btn-secondary" data-dismiss="modal">Fenster schließen</button>
      </div>
    </div>
  </div>
</div>


