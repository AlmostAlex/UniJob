<select class='form-control' id='art' name='art' onchange="art1(this.value)">
                <option></option>
                <option value='Abschlussarbeit' name='Abschlussarbeit'>Abschlussarbeiten1</option>
                <option value='Seminararbeiten' name='Seminararbeiten'>Seminararbeiten1</option>
            </select>

            art filterung

            <?php

if(isset($_GET["art"])){
    $w = $_GET["art"];
    echo $w;
}
else{
    $w = '';
}

?>