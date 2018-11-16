<br><h4>Verwaltung der Anmeldungen zum Windhundverfahren</h4>
<open >
    <div class='alert alert-secondary' role='alert'>
        Von insgesamt <b><?php echo $infos['anzThema']; ?></b> 
        Themen 
             <?php if($infos['kategorie'] == "Seminararbeit"){ echo 'sind im Modul <b> "'. $infos['modulbezeichnung'].'"';} else {  echo 'in der Professur <b>"'. $infos['professur'].'"';} ?> 
            </b> <?php if($infos['anzThemaVergeben'] > 1){ echo "sind"; } else { echo "ist ein"; } ?>
            <b><?php echo $infos['anzThemaVergeben']; ?></b> <?php if($infos['anzThemaVergeben'] > 1){ echo "Themen"; } else { echo "Thema"; } ?> vergeben.
    </div>
              
    <form style='margin-bottom:100px;' method="post"> 
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
                    <?php for($k = 0; $k < count($themen); $k++){ ?>
                        <tr>
                            <td></td>
                            <td><?php echo $themen[$k]['themenbezeichnung'] ?> </td>
                            <td class='name'><?php echo $themen[$k]['vorname'] ?> <?php echo $themen[$k]['nachname'] ?> </td>
                            <td class='matrikelnummer'><?php echo $themen[$k]['matrikelnummer'] ?></td>
                            <td class='email'><?php echo $themen[$k]['email'] ?></td>
                            <td class='status'>Status</td>
                            <td></td>
                            
                        </tr>
                    <?php } ?>
                </table>

                <hr class="my-4"> 
<?php if($infos['anzThemaVerfuegbar'] == 0){} else{  ?>   

                <table style='border:0px solid transparent'>
                    <tr>
                        <td colspan='5'>
                            <b>
                                <h6><span style='float: left;' class="badge badge-info"> <?php echo $infos['anzThemaVerfuegbar'] ?></span> 
                                    <div class='verf_border'>
                                        <a data-toggle="collapse" id='verfuegbar' data-target="#verf" href="#verf" role="button" aria-expanded="false" aria-controls="vergeben">
                                        
                                        Verfügbare Themen <span style='font-size: 0.7em;' class="glyphicon glyphicon-plus"></span>
                                        
                                        </a>
                                    </div> 
                                </h6>
                            </b>
                        </td>
                    </tr>  
                </table>
<?php } ?>

             </div>
          </div>
    <div class='bewerbung_verwaltung'>
        <div class="collapse" id="verf">   
            <table id='vgTable'>
            <thead>
                        <tr>
                            <th style='width:280px;'>Thema</th>
                            <th class="no-sort"></th>
                            <th class="no-sort"></th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
            <?php for($j = 0; $j < count($themenVG); $j++){ ?>
                <tr>
                    <td> <?php echo $themenVG[$j]['themenbezeichnung'] ?> </td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <?php } ?>            
                </table> 
                <br><br> <br>
        </div> 
            </div>             
    </form>
</open>
