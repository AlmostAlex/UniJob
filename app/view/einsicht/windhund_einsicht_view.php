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
                <table id="sort_einsicht_wh">
                    <thead>
                        <tr>
                            <th class="no-sort" name='anmerkung'></th>
                            <th >Thema</th>
                            <th>Matrikelnummer</th>
                            <th>Email</th>
                            <th class="no-sort" name='funktionen'>Funktionen</th>
                        </tr>
                    </thead>
                    <?php for($k = 0; $k < count($themen); $k++){ ?>
                        <tr>
                            <td></td>
                            <td><?php echo $themen[$k]['themenbezeichnung'] ?> </td>
                            <td><?php echo $themen[$k]['matrikelnummer'] ?></td>
                            <td><?php echo $themen[$k]['email'] ?></td>
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
