

<tr>
<td><label for='Vorkenntnisse'><b>Vorkenntnisse:</b><red style='color: red'>*</red></label></td>
<td>     
        <?php for($j = 0; $j < count($vorkenntnisse); $j++){  ?>    

<inner>
<table>

<tr>
<td><b><?php echo  $vorkenntnisse[$j]['bezeichnung'];?></b>:</td>
<td style='width:50%;'>
    <input type="radio" id='<?php echo $j?>' name="Vorkenntnisse_<?php echo $j?>" value="Nein">
    <label for="Nein"> Nein</label> 
    <input style='margin-left:10px;' type="radio"  id='<?php echo $j?>' name="Vorkenntnisse_<?php echo $j?>" value="<?php echo  $vorkenntnisse[$j]['bezeichnung'];?>">
    <label for="Ja"> Ja</label> 
    </td>
  </tr>
  </table>
  </inner>       
<?php } ?>

</td>
</tr>
