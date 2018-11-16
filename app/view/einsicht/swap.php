<table>
    <tr>
        <td>
        Bewerber's Thema:
        </td>
        <td>
        <select class="form-control">
            <option value='<?php echo $themenbezeichnung;?>' ><?php echo $themenbezeichnung;?> </option>
        </select>
        </td>
    <td>
    tauschen durch: 
    </td>
    <td>
    <select class="form-control" onchange="swapAgain(this)">  
    <option></option>           
    <?php for($k = 0; $k < count($swapThemen); $k++){ ?>
        <option value='<?php echo $swapThemen[$k]['thema_id'];?>'>
            <?php echo $swapThemen[$k]['themenbezeichnung'];?> <?php echo $swapThemen[$k]['thema_id'];?>
        </option>
    <?php } ?>
        </select>
    </td>
</table>

<div id='test'></div>





