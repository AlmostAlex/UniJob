<br><h4>Verwaltung der Anmeldungen zum Belegwunschverfahren</h4>
<open>
    <div class='alert alert-secondary' role='alert'>
        Von insgesamt <b><?php echo $infos['anzThema']; ?></b>
        Themen 
             <?php if($infos['kategorie'] == "Seminararbeit"){ echo 'sind im Modul <button> "'. $infos['modulbezeichnung'].'"';} else {  echo 'in der Professur <b>"'. $infos['professur'].'"';} ?> 
            </b> <?php if($infos['anzThemaVergeben'] > 1){ echo "sind ".$infos['anzThemaVergeben'].""; } else if($infos['anzThemaVergeben'] == 0){ echo "kein";} else { echo "ist ein ".$infos['anzThemaVergeben'].""; } ?>
             <?php if($infos['anzThemaVergeben'] > 1){ echo "Themen"; } else { echo "Thema"; } ?> vergeben.
    </div>


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

                <table id="sort_einsicht_wh">
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
                            <td></td>
                    </tr>
                    <?php } ?>
                </table>
        </div>
    </div>
</form>
</nachrueckv>



<!-- ZUGETEILTE THEMEN -->
<form style='margin-bottom:30px;' method="post">
     <div class="table-responsive" id="module">
     <div class='bewerbung_verwaltung'>
        <div class='belegSort'>
        <b>Informationen aus-/einblenden: </b>
            <div class="form-check form-check-inline"> <p><input type="checkbox" name="pri1" id="pri1" checked="checked"/><label for="pri1">Priorität 1</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox" name="pri2" id="pri2" checked="checked" /><label for="pri2">Priorität 2</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox" name="pri3" id="pri3"  /><label for="pri3">Priorität 3</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox" name="matrikelnummer" id="matr" /><label for="matr">Matr.</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox"  name="email"  id="email" /><label for="email">E-mail</label></p></div>
            <div class="form-check form-check-inline"><p><input type="checkbox" name="status"  id="status" /><label for="status">Status</label></p></div>
        </div>

            <table id="sort_einsicht_bel">
                <thead>
                    <tr>
                        <th>Info</th>
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
                       <td style='width:5%; vertical-align: top;'></td>
                        <td style='width:10%; vertical-align: top;'><b><?php echo $bewerber[$k]['themenbezeichnung'] ?></b></td>

                        <td style='width:10%; vertical-align: top;' class='pri1'><?php echo $bewerber[$k]['pri1']?></td>
                        <td style='width:10%; vertical-align: top;' class='pri2'><?php echo $bewerber[$k]['pri2']?></td>
                        <td style='width:10%; vertical-align: top;' class='pri3'><?php echo $bewerber[$k]['pri3']?></td>

                        <td class='matrikelnummer'><?php echo $bewerber[$k]['matrikelnummer']?></td>
                        <td class='email'><?php echo $bewerber[$k]['email']?></td>
                        <td class='status'><?php echo $bewerber[$k]['status']?></td>
                        <td style='width:2%;'>
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

                          <!--  <a>
                            <span class="badge badge-info">
                                <i class="far fa-envelope"></i>
                                </span>  
                            </a> -->
                        </td>
            
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
                        <td>

                            <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#swapModal"
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

<!-- EXPORT LINKAGE -->


 <style>
 export h4{
     font-size: 17px;
     padding:0px;
 }

 export .modal-header{
    padding:5px 0 0 0;
    background-color: #3f91d8;
    color: white;
 }
 </style>



<export> 
    <button  style='color:white; float:right;' class="btn btn-primary" data-keyboard="false" data-toggle="modal" data-target="#exportEinsichtbeleg">
     Exportieren
    </button>
</export>


<!-- MODAL EXPORT -->
<export>
    <div class="modal fade" id="exportEinsichtbeleg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div  class="modal-dialog" role="document">
            <div style='width:700px' class="modal-content">
                <div class="modal-header">
                    <h4>Listen exportieren</h4>
                </div>
                <div class="modal-body">

                <div class="alert alert-info" role="alert">
                hi hih ihi hi hih ihi   hi hih ihi    hihi hihi  
                hi hih ihi hi hih ihi   hi hih ihi    hihi hihi   
                hi hih ihi hi hih ihi   hi hih ihi    hihi hihi   
                hi hih ihi hi hih ihi   hi hih ihi    hihi hihi     
                hihi hihi hihi hihi    hihi hihi   hihi hihi    hihi hihi
                </div>

<table>
    <tr>
        <td><b>Listenart:</b></td>
            <td>
                <input type="radio" id="all" name="Liste" value="All" checked>
                <label for="Gesamt"> Alle</label> 
                <input type="radio" id="nachrv" name="Liste" value="nachrv">
                <label for="nachrv"> Nachrückverfahren</label>
                <input type="radio" id="vergebene" name="Liste" value="vergebene">
                <label for="vergebene"> Vergebene</label>
                <input type="radio" id="Nvergebene" name="Liste" value="Nvergebene">
                <label for="Nvergebene"> Nicht vergebene</label>
            </td>
    </tr>
    <tr>
        <td><b>Attribute:</b></td>   
        <td>
        <input id="ExerhThema" type="checkbox" />
        <label for="ExerhThema"> Erhaltenes Thema</label> 


                <input id="Exmatr" type="checkbox" />
        <label for="Exmatr">Matrikelnr.</label> 

        <input id="Exemail" type="checkbox" />
        <label for="Exemail">E-Mail</label> 

        </td>
    </tr>
    <hr>
    <tr> 
        
    <td></td>
        <td>
        <input id="Expri1" type="checkbox" />
        <label for="Expri1"> Pri1</label> 

        <input id="Expri2" type="checkbox" />
        <label for="Expri2"> Pri2</label> 

        <input id="Expri3" type="checkbox" />
        <label for="Expri3">Pri3</label> 

        </td>
    </tr>  
</table>
</div>

                <div class="modal-footer">
                <a class="btn btn-primary" id="downloadlink" href="#">Click Me</a>
                <form id="hiddenform" method="POST" action="../../app/view/export/download.php">
                    <input type="hidden" id="filedata" name="data" value="">
                </form>

                <button type="button" id='closeBeleg' class="btn btn-secondary" data-dismiss="modal">Fenster schließen</button>               
                </div>
            </div>
        </div>
    </div>
</export>

 <script>


$(document).ready(function(){

  $("#downloadlink").click(function(){  
    var liste = $("input[name='Liste']:checked").val();

    $.get('../../app/view/export/download.php','action=export',function(){
     document.location.href = '../../app/view/export/download.php?action=export';

                 /*         
     $.get("export/download.php?action=export",function(filedata){ // AJAX call returns with CSV file data
          $("#filedata").val(filedata);      // insert into the hidden form                       
          $("#hiddenform").submit();         // submit the form data to the download page*/
      }); 
  });
});
 </script>

<!-- Modal -->
<swap>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4>Thementausch</h4>
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
</swap>


