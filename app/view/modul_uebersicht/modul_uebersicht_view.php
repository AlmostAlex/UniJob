<style>
.bootstrap-select show-tick{
    width:140px;
}
.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn){
    width:140px;
}
.show{
    display:none;
}

.bootstrap-select:not(.input-group-btn), .bootstrap-select[class*="col-"]{
    display:inline;
}
</style>

<h2 style='margin-top: 20px;' class='card-title'>Übersicht der Seminar- / Abschlussarbeitsthemen</h2>
<div style='text-align: center'>
<div class='suche'>
<table>
<tr>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Art</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Semester</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Betreuer</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Tags</b></th>
</tr>

<form method="post" action="">
    <tr>
        <td>
            
            <select class='form-control' id='art' name='art2' onchange="filter()">
            <option value=""></option>
                <option value='Abschlussarbeit' name='Abschlussarbeit'>Abschlussarbeiten1</option>
                <option value='Seminararbeiten' name='Seminararbeiten'>Seminararbeiten1</option>
            </select>
            
        </td> 
        <td>
            
            <select class='form-control' id='semester' name='semester2' onchange="filter()">
                <option value=""></option>
                <option value='s12'>s12</option>
                <option value='s11'>s11</option>
            </select>           
        </td> 

         <td>           
            <select class='form-control' id='betreuer' name='betreuer' onchange="filter()">
                <option value=""></option>
                <option value='schuhmann'>boss</option>
                <option value='kolbe'>boss!</option>
            </select>
       </td>
       <td>
       <select class="selectpicker" multiple data-live-search="true" onchange="filter()">
       <option>Mustard</option>
  <option>Ketchup</option>
  <option>Relish232323</option>  
  <option>Mus3213tard</option>
  <option>Ke33tchup</option>
  <option>Re2lish</option>
</select>

        </td> 
</tr>


</table>
</div>
</div>

<p id="art_f"> hihi hi</p>
<p id="semester_f">  joo </p>


</form>

