<module> 
<?php for($k = 0; $k < count($module); $k++){ ?> 
        <first>   
            <table> 
                    <tr id='tr_sem' data-status="<?php echo $module[$k]['semester']?>">
                        <td id='td_f'>
                            
                                <div class="accordion-group accordion-caret collapsed" data-toggle="collapse" href="#<?php echo $module[$k]['modul_id']?>" >           
                                    <a data-toggle='collapse' data-parent='#accordion' href='#<?php echo $module[$k]['modul_id']?>' aria-expanded='true'>
                                        <i class='fa' aria-hidden='false'></i>           
                                    </a>
                               
                            </div>
                        </td>
                        <td id='td_s'>
                            <a data-toggle='collapse' id='first' data-parent='#accordion' href='#<?php echo $module[$k]['modul_id']?>' aria-expanded='true'>
                                <?php echo $module[$k]["semester"]; ?>
                            </a>
                        </td>
                    </tr> 
            </table>
      </first>

    <?php $themen = $this->ArchivierungThemen($module[$k]['modul_id'],''); for ($p = 0; $p < count($themen); $p++) {?>                  
     <first>
    <div id='<?php echo $module[$k]['modul_id']?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>         
   <content>
            <inhalt>
                <table>              
                    <tr data-status="<?php echo $module[$k]['semester']?>">
                        <td><a class='collapsed' id='coll' data-toggle='collapse' data-parent='#accordion' href='#inhalt_<?php echo $themen[$p]['thema_id']?>' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></td>                
                        <td>
                            <?php if($module[$k]["kategorie"] == "Seminararbeit"){ echo  $module[$k]["modulbezeichnung"]; } else {  echo  $module[$k]["professur"];} ?>
                        </td>
                    </tr>
                </table>   
            </inhalt>         
        </content> 
     </div>  
</first>
   <div id='inhalt_<?php echo $themen[$p]['thema_id']?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>      
    <themen>
         <content>
            <ths>
               <table>
                            <tr data-status="<?php echo $module[$k]['semester']?>">
                                <th>Themenbezeichnung</th>
                                <th>Betreuer</th>
                            </tr>
                            <tr>
                                <td>
                                <?php echo $themen[$p]["themenbezeichnung"];?>
                                </td>
                                <td>
                                <?php echo $themen[$p]["benutzer"];?>
                                </td>
                            </tr>                               
                 </table>                        
            </ths>
        </content>
    </themen>
 </div> 
 <?php }?>  <?php } ?>
</module>