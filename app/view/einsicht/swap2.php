 <table>
    <tr>
        <td style='width:140px'>
        applicant's topic
        </td>
        <td>
        <select class="form-control">
            <option value='<?php echo $themenbezeichnung;?>' ><?php echo $themenbezeichnung;?> </option>
        </select>
        </td>
    <td>
    <i class="fas fa-arrow-right"></i>
    </td>
    <td style='width:300px'>
    <select class="form-control" onchange="swap2(this)">  
    <option></option>    
    <option value='NULL'
    >NULL</option>    
    <?php for($k = 0; $k < count($swapThemen); $k++){ ?>
        <option 
        data-bew-id-von='111'
        data-bew-thema-vorher='4444'

        data-bew-id='16' 
        data-thema='4' 
        [ <red style='color:red'> <?php echo $swapThemen[$k]['status'];?></red> ] <?php echo $swapThemen[$k]['themenbezeichnung'];?> <?php echo $swapThemen[$k]['thema_id'];?>
        </option>
    <?php } ?>
        </select>
    </td>
</table> 
