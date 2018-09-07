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
            <p id="art_f">
            <select class='form-control' id='art' name='art' onchange="art1(this.value)">
                <option></option>
                <option value='Abschlussarbeit' name='Abschlussarbeit'>Abschlussarbeiten1</option>
                <option value='Seminararbeiten' name='Seminararbeiten'>Seminararbeiten1</option>
            </select>
            </p>
        </td> 
        <td>
            <p id="semester_f">
            <select class='form-control' id='semester' name='semester' onchange="sem(this.value)">
                <option></option>
                <option value='s12'>s12</option>
                <option value='s11'>s11</option>
            </select>
            </p>
            
        </td> 
</tr>
</form>

</table>
</div>
</div>


<script>
/*
$('#semester').change( function sem(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("semester_f").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("semester_f").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "ajax/filter_semester.php?semester="+str, true);
  xhttp.send();
});

$('#art').change( function(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("art_f").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var e = document.getElementById("art");
        var art1 = e.options[e.selectedIndex].value;
        var art = document.getElementById("art").value;
        document.getElementById("art_f").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "ajax/filter_art.php?art="+str, true);
  xhttp.send();
});


}*/


</script>

