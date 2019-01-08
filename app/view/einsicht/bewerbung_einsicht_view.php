<br><h4>Verwaltung der Bewerbungen zum Bewerbungsverfahren</h4>
<open>
    <div class='alert alert-secondary' role='alert'>

    Auf das Thema <b>"<?php echo $infos['themenbezeichnung'] ;?>"</b>
    <?php if($infos['anzBew']>1){ echo "haben sich <b>{$infos['anzBew']}</b> Bewerber "; } else{ echo "hat sich <b>1</b> Bewerber";} ?>   
    beworben.
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
                        <th class="no-sort" name='anmerkung'>Info</th>
                        <th class='matrikelnummer'>Matrikelnr.</th>
                        <th class='email'>Email</th>
                        <th class='fs'>FS</th>
                        <th class='credits'>Credits</th>
                        <th class='studiengang'>Studiengang</th>
                        <th class='punkte'>Punkte</th>
                        <th class='status'>Status</th>
                        <th class="no-sort" name='funktionen'>Funktionenn</th>
                    </tr>
                </thead>
                <?php for($k = 0; $k < count($bewerber); $k++){ ?>
                    <tr> 
                        <td></td>
                        <td class='matrikelnummer'><?php echo $bewerber[$k]['matrikelnummer']?></td>
                        <td class='email'><?php echo $bewerber[$k]['email']?></td>
                        <td class='fs'><?php echo $bewerber[$k]['fachsemester']?></td>
                        <td class='credits'><?php echo $bewerber[$k]['credits']?></td>
                        <td class='studiengang'><?php echo $bewerber[$k]['studiengang']?></td>
                        <td class='punkte'><?php echo $bewerber[$k]['gesamt_punkte']?></td>
                        <td class='status'><?php echo $bewerber[$k]['status']?></td>
                        <td style='width:28%;' align='center'>
                            <span data-toggle='tooltip' data-placement='top' title='Diesen Bewerber annehmen  /  alle anderen ablehnen' class='badge badge-warning'>
                                <a href='#' data-toggle='modal' data-target='#Sicherheitsabfrage_<?php echo $module[$i]["modul_id"]; ?>'><i class="far fa-check-circle" style="color:white"></i></a>
                            </span></td>
                    </tr>
                <?php } ?>               
            </table>
                <hr class="my-4"> 

        </div>
    </div>
</form>



</open>