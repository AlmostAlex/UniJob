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
            <select class='form-control' id='semester' name='semester' onchange="archivierung(this.value);">
             <option></option>
             <option value='all'>Alle <?php echo ' ('. $c_all .')' ?></option>
                <?php for($i = 0; $i < count($semester_d); $i++){  ?>                 
                        <option value='<?php echo $semester_d[$i]['semester'] ?>'> 
                            <?php echo $semester_d[$i]['semester']  .' ('. $semester_d[$i]['count_s'] .')'?> 
                        </option>
                <?php } ?>
            </select>
        </td>
        <td style='width:30%'>
            <ul>
          <!--  <a class="btn btn-primary openall" href="#">open all</a> 
            <a class="btn btn-danger closeall" href="#">close all</a> -->
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

<div id="archiv">
</div>


        

