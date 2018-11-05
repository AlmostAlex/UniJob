<br>
<h4></h4>

<div class='archivierung_box'>
<h5>
Archivierte Abschluss- und Seminararbeitsthemen
</h5>

<table>
    <tr>
        <td style='width:10%'>
            <sem>
                <b>Semester:</b>
            </sem> 
        </td>
        <td>
            <select class='form-control' id='semester' name='semester' required>
             <option></option>
             <option value='all'>Alle <?php echo ' ('. $c_all .')' ?></option>
                <?php for($i = 0; $i < count($semester); $i++){  ?>                 
                        <option value='<?php echo $semester[$i]['semester'] ?>'> 
                            <?php echo $semester[$i]['semester']  .' ('. $semester[$i]['count_s'] .')'?> 
                        </option>
                <?php } ?>
            </select>
        </td>
        <td style='width:30%'>
            <ul>

            </ul>
        </td>
    </tr>
</table>
<hr class="my-4">
</div>

<div class="alert alert-info" id='meldung' role="alert">
    <i id='bars' class="fas fa-bars"></i>
    <b>Wähle zunächst ein Semester aus.</b>
</div>

<module>       
    <?php for($k = 0; $k < count($module); $k++){ ?> 
        <table style='margin-bottom: 10px;'> 
                <tr id='tr_sem' data-status="<?php echo $module[$k]['semester']?>">
                    <td id='td_f'>
                        <div class="accordion-group accordion-caret collapsed" data-toggle="collapse" href="#<?php echo $module[$k]['modul_id']?>" >           
                            <a data-toggle='collapse' data-parent='#accordion' href='#<?php echo $module[$k]['modul_id']?>' aria-expanded='false'>
                                <i class='fa' aria-hidden='false'></i>           
                            </a>
                        </div>
                    </td>
                    <td id='td_s'>
                    <a style='' data-toggle='collapse' data-parent='#accordion' href='#<?php echo $module[$k]['modul_id']?>' aria-expanded='true'>
                       <?php echo $module[$k]["semester"]; ?>
                    </a>
                    </td>
                </tr> 
        </table>

            <table>
                <tr data-status="<?php echo $module[$k]['semester']?>">
                    <td></td>
                    <td>
                        <div id='<?php echo $module[$k]['modul_id']?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                            <?php if($module[$k]["kategorie"] == "Seminararbeit"){ echo  $module[$k]["modulbezeichnung"]; } else {  echo  $module[$k]["professur"];} ?>
                        </div> 
                    </td>
                </tr>
         </table>

        <?php } ?>
</module>
