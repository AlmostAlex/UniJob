
<?php //include(__DIR__."/../../../layout/head.php"); ?>
<!-- link rel="stylesheet" href="/css/modul_uebersicht.css">  
<link rel="stylesheet" href="/css/main.css"> -->
<br>
<span class="<?php echo $search_s; ?>"><?php echo $semester; ?> <delete onclick="r_semester();"><?php echo $x_s; ?></delete></span>
<span  class="<?php echo $search_a; ?>"><?php echo $art; ?> <delete onclick="r_art();"><?php echo $x_a; ?></delete> </span>
<span  class="<?php echo $search_b; ?>"><?php echo $betreuer_anzeige; ?> <delete onclick="r_betreuer();"><?php echo $x_b; ?></delete> </span>

<?php for ($i = 0; $i < count($tags_array); $i++) {?>
    <span style='float:left;' class="<?php echo $search_f;?>"> &nbsp; <?php echo $tags_array[$i]; ?> 
    <div style='float:right; <?php echo $display;?>' value='<?php echo $tags_array[$i];?>' id='remove'>&nbsp; x &nbsp;</div>
    </span> 
<?php }?>

<?php echo $abfrage_th;?>


<div id="semester_f" class='modul_anzeige'>
<br><br>
<h4>Seminar- und Abschlussarbeiten</h4>

    <?php for($k = 0; $k < count($module); $k++){ ?>
        <!--<div style='width: 100px; height:20px; background-color: #3979b5; font-size: 12px; margin-bottom: -3px; color: white;text-align: center;'><?php echo $module[$k]['kategorie']; ?></div>
    --><table class='modul_table_uebersicht'>
            <tr>
                <th><a class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#modul_<?php echo $module[$k]['modul_id']; ?>' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></th>
                <th><b><titel><?php echo $module[$k]['nachrueckv_status']; ?> <?php if($module[$k]["kategorie"] == "Seminararbeit"){
                                echo $module[$k]["nachrueckv_status"] .' '. $module[$k]["modulbezeichnung"]; }else{ echo $module[$k]["nachrueckv_status"] .' '. $module[$k]["professur"];
                            }?> <?php echo $module[$k]['modulbezeichnung']; ?></titel></b><br>
                    <div class='border_round'><b><?php echo $module[$k]['kategorie']; ?></b></div>
                    <div class='border_round'><b><?php echo $module[$k]['verfahren_anzeige']; ?></b></div>
                    <div class='border_round'><i class='far fa-calendar'></i> <b><?php echo $module[$k]['semester']; ?></b></div>
                    <div class='border_round'><i class='far fa-clock'></i> <b><?php echo $module[$k]['start_anzeige'] .' - '. $module[$k]['ende_anzeige']; ?> </b></div>
                </th>
                <th><button class="<?php echo $module[$k]['btn_form']?>"><span><?php echo $module[$k]['btn_msg']?></span></button></th>
            </tr>
        </table>
        <inside>
            <div id='modul_<?php echo $module[$k]['modul_id']; ?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                <table class='th_table'>
                    <tr>
                        <th style='width:5%' class='bold_title'><center>Info</center></th>
                        <th style='width:75%' class='bold_title'><center>Titel</center></th>
                        <th style='width:15%' class='bold_title'><center>Betreuer</center></th>
                        <th style='width:20%' class='bold_title'><center>Verfügbarkeit</center></th>
                    </tr>
                    <?php $themen = $this->modulUebersichtThemen($module[$k]['modul_id'],$abfrage_th); for ($p = 0; $p < count($themen); $p++) {?>   
                    <tr>
                        <td><a class='collapsed' id='coll' data-toggle='collapse' data-parent='#accordion' href='#inhalt_<?php echo $themen[$p]["thema_id"];?>' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></td>
                        <td><?php echo $themen[$p]["themenbezeichnung"];?> </td>
                        <td><center> <?php echo $themen[$p]["benutzer"];?></center></td>
                        <td><center><div $vergeben><?php echo $themen[$p]["thema_verfuegbarkeit"];?></div></center></td>
                    </tr>
                    <tr class='nopadding'>
                        <td class='nopadding' colspan='6'>
                            <div id='inhalt_<?php echo $themen[$p]["thema_id"];?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                                <div class='information_content'>
                                    <b class='information_titel'>Inhaltliche Informationen:</b><br>
                                        <div class='information_content_inhalt'> 
                                            <b>Bevorzugter Studiengang:</b>  <?php echo $module[$k]["studiengang"];?><br>
                                            <b>Empfohlenen Vorkenntnisse: </b>
                                            <?php $vorkenntnisse = $this->modulUebersichtVorkenntisse($themen[$p]['thema_id']); for ($l = 0; $l < count($vorkenntnisse); $l++) {?> 
                                            <?php  echo $vorkenntnisse[$l]['bezeichnung']; }?> <br>
                                            <b>Beschreibung:</b> <?php echo $themen[$p]["themenbeschreibung"];?> <br>
                                                    <br>
                                         
                                          <tags>
                                            <?php $tags = $this->modulUebersichtTags($themen[$p]['thema_id']); for ($y = 0; $y < count($tags); $y++) {?>   
                                                
                                                <a href="#" class="badge badge-primary"><?php echo $tags[$y]['tag_bezeichnung'];?></a>
                                                           
                                            <?php }?>
                                             </tags>         
                                        </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </inside><br>
    <?php } ?>
    </div>




<!--/* $themen = $this->modulUebersichtThemen($module[$k]['modul_id']); for ($p = 0; $p < count($themen); $p++) {?>   

}
               