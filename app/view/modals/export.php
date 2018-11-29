
<!-- MODAL EXPORT -->
<export>
    <div class="modal fade" id="exportEinsichtbeleg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div  class="modal-dialog" role="document">
            <div style='width:700px' class="modal-content">
                <div class="modal-header">
                    <h4>Listen exportieren</h4>
                </div>
                <div class="modal-body">

                <div class="alert alert-info" role="alert">
                hi hih ihi hi hih ihi   hi hih ihi    hihi hihi  
                hi hih ihi hi hih ihi   hi hih ihi    hihi hihi   
                hi hih ihi hi hih ihi   hi hih ihi    hihi hihi   
                hi hih ihi hi hih ihi   hi hih ihi    hihi hihi     
                hihi hihi hihi hihi    hihi hihi   hihi hihi    hihi hihi
                <?php echo $id ?>
                </div>

<table>
    <tr>
        <td><b>Listenart:</b></td>
            <td>

            <select data-modul-id='<?php echo $id?>' id='Liste' name="Liste">
            <option value="all">Alle</option>
            <option value="saab">Saab</option>
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
            </select>


<!-- 
                <input type="radio" id="all" name="Liste" value="All" checked>
                <label for="Gesamt"> Alle</label> 
                <input type="radio" id="nachrv" name="Liste" value="nachrv">
                <label for="nachrv"> Nachrückverfahren</label>
                <input type="radio" id="vergebene" name="Liste" value="vergebene">
                <label for="vergebene"> Vergebene</label>
                <input type="radio" id="Nvergebene" name="Liste" value="Nvergebene">
                <label for="Nvergebene"> Nicht vergebene</label>
-->

            </td>
    </tr>
    <tr>
        <td><b>Attribute:</b></td>   
        <td>
        <input id="ExerhThema" type="checkbox" />
        <label for="ExerhThema"> Erhaltenes Thema</label> 


                <input id="Exmatr" type="checkbox" />
        <label for="Exmatr">Matrikelnr.</label> 

        <input id="Exemail" type="checkbox" />
        <label for="Exemail">E-Mail</label> 

        </td>
    </tr>
    <hr>
    <tr> 
        
    <td></td>
        <td>
        <input id="Expri1" type="checkbox" />
        <label for="Expri1"> Pri1</label> 

        <input id="Expri2" type="checkbox" />
        <label for="Expri2"> Pri2</label> 

        <input id="Expri3" type="checkbox" />
        <label for="Expri3">Pri3</label> 

        </td>
    </tr>  
</table>
</div>

                <div class="modal-footer">
                <a class="btn btn-primary" id="downloadlink" href="#">Click Me</a>
                <form id="hiddenform" method="POST" action="../../app/view/export/download.php">
                    <input type="hidden" id="filedata" name="data" value="">
                </form>

                <button type="button" id='closeBeleg' class="btn btn-secondary" data-dismiss="modal">Fenster schließen</button>               
                </div>
            </div>
        </div>
    </div>
</export>