<table>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <td colspan='4'>
        <div class="alert alert-warning" role="alert">
        <b><i  class="fas fa-exclamation-triangle"></i> Achtung</b>
          <ul>
            <li>Sobald der Bewerber ein <b>neues</b> Thema zugeteilt bekommt, erhält er dieses.</li>
            <li> Ist das Thema bereits <b>vergeben</b>, muss dem zugehörigen Bewerber ein <b>anderes</b> oder <b>kein</b> Thema zugeteilt werden.</li>
          </ul>  
        </div>
        </td>
    </tr>
    <tr>
    <td colspan='4'>
    <br><br>
<h5>Thementausch:</h5>    
    </td>
    </tr>
    <tr>
        <td style='width:140px'>
        1.Bewerber's Thema:
        </td>
        <td>
        <select class='form-control positionTypes'>
            <option value='<?php echo $thema_id;?>'> <?php echo $thema_id;?>  <?php echo $themenbezeichnung;?> </option>
        </select>
        </td>
    <td>
    <i class="fas fa-arrow-right"></i>
    </td>
    <td style='width:300px'>
    <select class='form-control positionTypes' onchange="swap2(this)">  
    <option></option>    
    <option 
        data-bew-id-von='<?php echo $bewID ?>'
        data-bew-thema-vorher='<?php echo $thID?>'

        data-bew-id='NULL' 
        data-thema='NULL'  
    >
    
    bewid: NULL  THID: NULL- Kein Thema erhalten
    </option>    
    <?php for($k = 0; $k < count($swapThemen); $k++){ ?>
        <option 
        
        value='<?php echo $swapThemen[$k]['thema_id'];?>'

        data-bew-id-von='<?php echo $bewID ?>'
        data-bew-thema-vorher='<?php echo $thID?>'
  
        data-bew-id='<?php echo $swapThemen[$k]['bewID'];?>' 
        data-thema='<?php echo $swapThemen[$k]['thema_id'];?>'>

        [ <red style='color:red'> bewid: <?php echo $swapThemen[$k]['bewID'];?>  thID: <?php echo $swapThemen[$k]['thema_id'];?> <?php echo $swapThemen[$k]['status'];?></red> ]  <?php echo $swapThemen[$k]['themenbezeichnung'];?> <?php echo $swapThemen[$k]['thema_id'];?>
        </option>
    <?php } ?>
        </select>
    </td>
</table>

<div id='sw1'></div>





