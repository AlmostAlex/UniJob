<!-- Modal -->
<div class="modal fade" id="annehmen_<?php echo $matrikelnummer;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='titel'>
          <?php echo "Sicherheitsfrage: Bewerber annehmen?";?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='alert alert-danger'>
          <center>
        
            <?php echo "Den Studenten mit der Matrikelnummer .'$matrikelnummer.' annehmen? Die übrigen Bewerber werden hierdurch abgelehnt. Alle Bewerber werden über ihr Ergebnis informiert!";?>
            <center>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fenster schließen</button>
        <a href='<?php echo $modal['btn_url']?>' class="btn btn-danger" style="background-color:green; color:white">Aktion bestätigen </a>
      </div>
    </div>
  </div>
</div>


