<td>
  <vorkenntnisseWH style="<?php echo $btn;?>">
<div class="alert alert-warning" role="alert">
     <small>   
       <?php echo $msg_vork; ?>
        <?php for($j = 0; $j < count($vorkenntnisse); $j++){  ?>     
              <?php echo  $vorkenntnisse[$j]['bezeichnung'] .';';?> 
                <?php } ?>
</small> 
</div>
</vorkenntnisseWH>
</td>
