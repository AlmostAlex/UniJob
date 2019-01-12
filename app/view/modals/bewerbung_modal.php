<!-- Modal -->
<div class="modal fade" id="<?php echo $modal['case'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='titel'>
          <?php echo $modal['title'];?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='<?php echo $modal['body_class'];?>'>
          <center>
            <img style='float:left;' src='<?php echo $modal['img'];?>'>
            <?php echo $modal['content'];?>
            <center>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fenster schließen</button>
        <button href='<?php echo $modal['btn_url']?>' type='<?php echo $modal['type']?>' name='<?php echo $modal['name']?>' class='
          <?php echo $modal['btn_class']?>'>
          <?php echo $modal['btn'];?></button>
      </div>
    </div>
  </div>
</div>


