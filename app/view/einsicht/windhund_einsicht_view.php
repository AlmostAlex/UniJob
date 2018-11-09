<br><h4>Verwaltung der Anmeldungen zum Windhundverfahren</h4>
<open>
    <div class='alert alert-secondary' role='alert'>
        Von insgesamt <b><?php echo $infos['anzThema']; ?></b> 
        Themen im Modul "
            <b> <?php if($infos['kategorie'] == "Seminararbeit"){ echo  $infos['modulbezeichnung'];} else {  echo  $infos['professur'];} ?> 
            </b>" <?php if($infos['anzThemaVergeben'] > 1){ echo "sind"; } else { echo "ist ein"; } ?>
            <b><?php echo $infos['anzThemaVergeben']; ?></b> <?php if($infos['anzThemaVergeben'] > 1){ echo "Themen"; } else { echo "Thema"; } ?> vergeben.
    </div>
                            
    <form method="post">
        <div class='bewerbung_verwaltung'>
            <table>
                <tr>        
                    <th><center>Thema</center></th>
                    <th><center>Matrikelnummer</center></th>    
                    <th><center>E-Mail</center></th>        
                    <th><center>Funktionen</th>
                    </tr>
                    <?php for($k = 0; $k < count($themen); $k++){ ?>
                        <tr>
                            <td> <?php echo $themen[$k]['themenbezeichnung'] ?> </td>
                            <td><?php echo $themen[$k]['matrikelnummer'] ?></td>
                            <td><?php echo $themen[$k]['email'] ?></td>
                            <td> - </td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr class="my-4"> 

                    <table>
                    <tr>
                    <td colspan='5'>
                        <b>
                           <h6> <span class="badge badge-info">
                                    <?php echo $infos['anzThemaVerfuegbar'] ?>
                               </span> 
                               
                                 <a data-toggle="collapse" href="#vergeben" 
                                role="button" aria-expanded="false" aria-controls="vergeben">
                               Verfügbare Themen</a> </h6>
                        </b>
                        </td>
                        </tr>
                </table>
             </div>



                    <div class="collapse" id="vergeben">   
                        <table class='vgTable'>
                                <?php for($j = 0; $j < count($themenVG); $j++){ ?>
                                 <tr>
                                    <td> <?php echo $themenVG[$j]['themenbezeichnung'] ?> </td>
                                    <td>-ewew</td>
                                    <td>-</td>
                                    <td> - </td>
                                </tr>
                                <?php } ?>            
                        </table> 
                    </div>
                    
    </form>
</open>