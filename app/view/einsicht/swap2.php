 <table>
    <tr>
        <td style='width:140px'>
        applicant's topic
        </td>
        <td>
        <select class='form-control positionTypes'>
            <option value='<?php echo $themenbezeichnung;?>' > <?php echo $thema_id;?> <?php echo $themenbezeichnung;?> </option>
        </select>
        </td>
    <td>
    <i class="fas fa-arrow-right"></i>
    </td>
    <td style='width:300px'>
    <select class='form-control positionTypes' onchange="swap2(this)">  
    <option></option>    
    <option value='NULL'
        data-bew-id-von='<?php echo $bewID_von; ?>'
        data-bew-thema-vorher='<?php echo $bewThID_von; ?>'

        data-bew-id='NULL' 
        data-thema='NULL'  
    > bewid: NULL  THID: NULL- Kein Thema erhalten</option>    
    <?php for($k = 0; $k < count($swapThemen); $k++){ ?>
        <option    
        data-bew-id-von='<?php echo $bewID_zu?>'
        data-bew-thema-vorher='<?php echo $bewThID_zu?>'
        
        data-bew-id='<?php echo $swapThemen[$k]['bewID'];?>' 
        data-thema='<?php echo $swapThemen[$k]['thema_id'];?>'>
        
            [ <?php echo $swapThemen[$k]['status'];?> ]<?php echo $swapThemen[$k]['themenbezeichnung'];?> <?php echo $swapThemen[$k]['thema_id'];?>
        </option>
    <?php } ?>
        </select>
    </td>
</table> 
