<br><h4>Verwaltung aller Bewerbungen zum Bewerbungsverfahren</h4>
<open>
    <div class='alert alert-secondary' role='alert'>

     Auf <?php if($infos['kategorie']=='Abschlussarbeit') { echo "die Professur";} else {echo "das Modul "; } ?> <b>"<?php echo $infos['modulbezeichnung'] ;?>"</b>
    <?php if($infos['anzBew']>1){ echo "haben sich <b>{$infos['anzBew']}</b> Bewerber "; } else{ echo "hat sich <b>1</b> Bewerber";} ?>   
    beworben.
 </div>

<div class="dropdown">

<button style='float:right; margin-left:20px;' id="collapse-init" class="btn btn-info">
    Öffne alle Themen
</button>

  <button style='float:right;' class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Exportieren
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <a data-verfahren='expBEW' data-modul-id='<?php echo $id?>' id='alleListen' name="alleListen" class="dropdown-item" href="#">Export - Alle Listen</a>
    <a data-verfahren='expBEW' data-modul-id='<?php echo $modul_id;?>' id='ListeAlleBew' name ='ListeAlleBew' class="dropdown-item" href="#">Export - Alle Bewerber je Thema</a>
    <a data-verfahren='expBEW' data-modul-id='<?php echo $id?>' <?php if($infos['anzBewABG'] > 0 || $infos['anzBewANG'] > 0){echo 'id="ListeAngAbgBew"';}?> name="ListeAngAbgBew" class="dropdown-item <?php if($infos['anzBewABG'] == 0 && $infos['anzBewANG'] == 0){echo 'disabled';}?>" href="#">Export - Angn./Abgl. Bewerber</a>
    <a data-verfahren='expBEW' data-modul-id='<?php echo $id?>' <?php if($this->modul_model->getNachrueckverfahren($id) == 'true'){echo 'id="ListeNachrBew"';}?> name="ListeNachrBew" class="dropdown-item <?php if($this->modul_model->getNachrueckverfahren($id) == 'false'){echo 'disabled';}?>" href="#">Export - Nachrückverfahren</a>
    
 </div>
</div>

<br><br>

<nachrueckv style='<?php echo $display;?>'>
   <b> <i class="fas fa-arrow-right"></i>   Anmeldungen während des <red>Nachrückverfahrens <i class="fas fa-exclamation"></i></red> </b>
<!-- NACHRÜCKVERFAHREN TABELLE WENN BEWERBUNGEN ZUM NACHRÜCKVERFAHREN EXISTIEREN! -->
    <form style='margin-bottom:30px;' method="post"> 
        <div class="table-responsive" id="module">
            <div class='bewerbung_verwaltung'>
                <div class='belegSort'>
                        <b>Informationen aus-/einblenden: </b>
                            
                        <div class="form-check form-check-inline"><p><input type="checkbox" name="name_NV" checked="checked" id="name_NV" /><label for="name_NV">Name</label></p></div>
                        <div class="form-check form-check-inline"><p><input type="checkbox" name="matrikelnummer_NV" checked="checked" id="matrikelnummer_NV" /><label for="matrikelnummer_NV">Matr.</label></p></div>
                        <div class="form-check form-check-inline"><p><input type="checkbox" name="email_NV" id="email_NV" /><label for="email_NV">E-mail</label></p></div>
                        <div class="form-check form-check-inline"><p><input type="checkbox" name="status_NV"  id="status_NV" checked="checked" /><label for="status_NV">Status</label></p></div>           
                </div>

                    <table id="sort_nachr_bew">
                        <thead>
                            <tr>
                                <th class="no-sort" name='anmerkung'>Info</th>
                                <th>Thema</th>
                                <th class='name_NV'>Name</th>
                                <th class='matrikelnummer_NV'>Matrikelnummer</th>
                                <th class='email_NV'>Email</th>
                                <th class='status_NV'>Status</th>
                                <th class="no-sort" name='funktionen'>Funktionen</th>
                            </tr>
                        </thead>
                        <?php for($k = 0; $k < count($anmeldungen); $k++){ ?>
                        <tr>
                            <td></td>
                            <td><?php echo $anmeldungen[$k]['themenbezeichnung']?></td>
                            <td class='name_NV'><?php echo $anmeldungen[$k]['vorname'] ?> <?php echo $anmeldungen[$k]['nachname'] ?></td>
                            <td class='matrikelnummer_NV'><?php echo $anmeldungen[$k]['matrikelnummer']?></td>
                            <td class='email_NV'><?php echo $anmeldungen[$k]['email']?></td>
                            <td><?php echo $anmeldungen[$k]['status']?></td>
                            <td style='width:28%;' align='center'>
                            <span data-toggle='tooltip' data-placement='top' title='Modul löschen' class='<?php echo $module[$i]["checkDeleteBtn"] ?>'>
                                <a href='#' data-toggle='modal' data-target='#Sicherheitsabfrage_<?php echo $module[$i]["modul_id"]; ?>'><i class="far fa-check-circle"></i></a>
                            </span></td>
                        </tr>
                        <?php } ?>
                    </table>
            </div>
        </div>
    </form>
</nachrueckv>


<!-- BEWERBUNGEN MIT ALLEN THEMEN -->
<b> <i class="fas fa-arrow-right"></i>   Bewerbungen zu den Themen </b>
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

           <?php for($k = 0; $k < count($themen); $k++){  ?> 

            <script> $(document).ready(function() {$('#sort_einsicht_all_<?php echo $themen[$k]['thema_id'];?>').DataTable({
            autoWidth: true,"columnDefs": [{"targets": 'no-sort',"orderable": false,}],
            "order": [], "paging": false, "info": false, "searching": false,}); });</script>

           <table style='padding: 0px;margin-bottom: 0px;'>
            <tr>
                <td style='width:50px;'>
                    <a class='collapsed' id="panel-collapse collapse" data-toggle='collapse' data-parent='#accordion' href='#thema_<?php echo $themen[$k]['thema_id']; ?>' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a>
                </td>
                <td>
                Thema: <?php echo $themen[$k]['themenbezeichnung']; ?>
                </td>
                <td style='width:200px;'>Anz. Bewerber: <?php echo $themen[$k]['anz_bew_th']?></td>
            </tr>
           </table>

           <div id='thema_<?php echo $themen[$k]['thema_id']; ?>'  class="panel-collapse collapse" role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
            
            <table style='border:0px;' id="sort_einsicht_all_<?php echo $themen[$k]['thema_id']; ?>">
                <thead>
                    <tr>
                        <th class="no-sort" name='anmerkung'></th>
                        <th class='matrikelnummer'>Matrikelnr.</th>
                        <th>FS</th>
                        <th>Credits</th>
                        <th>Studieng.</th>
                        <th>Punkte</th>
                        <th>Status</th>
                        <th class="no-sort">Funktionen</th>
                    </tr>
                </thead>
            <?php $bewerber = $this->bewerber($themen[$k]['thema_id']); for ($p = 0; $p < count($bewerber); $p++) {?>   
                <tr>
                <td></td>
                <td><?php echo $bewerber[$p]['matrikelnummer']; ?></td>
                <td><?php echo $bewerber[$p]['fachsemester']; ?></td>
                <td><?php echo $bewerber[$p]['credits']; ?></td>
                <td><?php echo $bewerber[$p]['studiengang']; ?></td>
                <td><?php echo $bewerber[$p]['gesamt_punkte']; ?></td>
                <td><?php echo $bewerber[$p]['status']; ?></td>
                <td style='width:28%;' align='center'>
                    <span data-toggle='tooltip' data-placement='top' title='Diesen Bewerber annehmen  /  alle anderen ablehnen' class='badge badge-warning'>
                        <a href='#' data-toggle='modal' data-target='#annehmen_<?php echo $bewerber[$k]["matrikelnummer"]; ?>'><i class="far fa-check-circle" style="color:white"></i></a>
                    </span>
                    <?php $this->getAnnahmeModal($k,$bewerber[$p]["matrikelnummer"],$themen[$k]['thema_id']);?>
                    <?php echo "hihihi";?>
                </td>
                </tr>
                  
                <?php }  ?>   
                
                </table>
                <BR>
            </div>
      
 <?php }  ?> 
                              
        </div> 
        </div> 

</form>




</open>