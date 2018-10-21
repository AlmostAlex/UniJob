</table>
<table>
<tr>
<td><label for='Vorkenntnisse'><b>Vorkenntnisse:</b><red style='color: red'>*</red></label></td>
<td>     
        <?php for($j = 0; $j < count($vorkenntnisse); $j++){  ?>    

<inner>
<table>

<tr>
<td><?php echo  $vorkenntnisse[$j]['bezeichnung'];?></td>
<td style='width:50%;'>
    <input type="radio" id="mc" name="Vorkenntnisse" value="Mastercard">
    <label for="Nein"> Nein</label> 
    <input style='margin-left:10px;' type="radio" id="vi" name="Vorkenntnisse" value="Visa">
    <label for="Ja"> Ja</label> 
    </td>
  </tr>
  </table>
  </inner>       
                <?php } ?>

</td>
</tr>
</table>