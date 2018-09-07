<h2 style='margin-top: 20px;' class='card-title'>Übersicht der Seminar- / Abschlussarbeitsthemen</h2>
<div style='text-align: center'>
<div class='suche'>
<table>
<tr>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Art</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Semester</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Betreuer</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Verfügbarkeit</b></th>
</tr>

<form method="post" action="">
    <tr>
        <td>
            
            <select class='form-control' id='art' name='art' onchange="art1(this.value)">
                <option></option>
                <option value='Abschlussarbeit' name='Abschlussarbeit'>Abschlussarbeiten1</option>
                <option value='Seminararbeiten' name='Seminararbeiten'>Seminararbeiten1</option>
            </select>
            
        </td> 
        <td>
            
            <select class='form-control' id='semester' name='semester' onchange="sem(this.value)">
                <option></option>
                <option value='s12'>s12</option>
                <option value='s11'>s11</option>
            </select>
       
            
        </td> 
</tr>


</table>
</div>
</div>

<p id="art_f"> hihi hi</p>
<p id="semester_f">  joo </p>


</form>
