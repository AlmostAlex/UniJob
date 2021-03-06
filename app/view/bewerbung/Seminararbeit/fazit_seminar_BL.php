<br><div class='windhund'>
    <h4 class='bew_ue'><i class="far fa-check-square"></i> Eingaben zur Bewerbung</h4>    
<div class='alert alert-secondary' role='alert'> 
    Die Bewerbung wurde am <b><?php echo $infos1['date']; ?></b> um <b><?php echo $infos1['time']; ?></b> abgeschickt.<br>
    Du hast dich erfolgreich für die <?php echo $infos1['kategorie'];?> 
    <?php if($infos1['kategorie']=='Seminararbeit'){ echo 'im Modul <b>'. $infos1['bez'] .'</b> angemeldet.'; }
    else{ echo 'an der Professur <b>' . $infos1['bez'] .'</b> angemeldet.'; } ?> 
 </div>
<bewerbung>
 <div class='fazit'>
    <table>  
        <tr>
            <td colspan='2' class='daten'>          
                <div class='ue_txt'>
                <i class="far fa-user"></i> <txt>Personenbezogene Daten</txt>
                <div class='ue_txt_v'></div> <div class='ue_txt_wh'></div></div>              
            </td>
        </tr>
        <tr>
            <td style='width:37%;'><label><b>Name:</b></label></td>
            <td><?php echo $nachname .', '. $vorname; ?></td>
        </tr>
        <tr>
            <td><label><b>Email:</b></label></td>
            <td><?php echo $email;?></td>
        </tr>
        <tr>
            <td><label><b>Matrikelnummer:</b></label></td>
            <td><?php echo $matrikelnummer;?></td>
        </tr>
        <tr>
            <td><label><b>Fachsemester:</b></label></td>
            <td><?php echo $fachsemester;?></td>
        </tr>
        <tr>
            <td><label><b>Credits:</b></label></td>
            <td><?php echo $credits;?></td>
        </tr>
        <tr>
            <td><label><b>Seminarteilnahme:</b></label></td>
            <td><?php echo $seminarteilnahme;?></td>
        </tr>
        <tr>
            <td><label><b>Studiengang:</b></label></td>
            <td><?php echo $studiengang;?></td>
        </tr>
         
        <tr>
            <td colspan='2' class='daten'>
            <div class='ue_txt'>
            <i class="far fa-clipboard"></i> Themenspezifische Daten
                <div class='ue_txt_v'></div> <div class='ue_txt_wh'></div></div>  
            </td>
        </tr>
        <tr>
            <td><label><b>Art:</b></label></td>
            <td><?php echo $infos1['kategorie'];?></td>      
        </tr>   
        <tr>
            <td><label><b><?php echo $infos1['kat'];?></b></label></td>
            <td><?php echo $infos1['bez'];?></td>      
        </tr>
        <tr>
            <td><label><b>Thema mit Priorität 1:</b></label></td>
            <?php if($infos1['betreuer'] != ""){ ?> <td><?php echo $themenbezeichnung1." (".$infos1['betreuer'].")";?></td> <?php }
            else{ ?> <td><?php echo $themenbezeichnung1;?></td> <?php } ?>     
        </tr>
        <tr>
            <td><label><b>Thema mit Priorität 2:</b></label></td>
            <?php if($infos2['betreuer'] != ""){ ?> <td><?php echo $themenbezeichnung2." (".$infos2['betreuer'].")";?></td> <?php }
            else{ ?> <td><?php echo $themenbezeichnung2;?></td> <?php } ?>     
        </tr>
        <tr>
            <td><label><b>Thema mit Priorität 3:</b></label></td>
            <?php if($infos3['betreuer'] != ""){ ?> <td><?php echo $themenbezeichnung3." (".$infos3['betreuer'].")";?></td> <?php }
            else{ ?> <td><?php echo $themenbezeichnung3;?></td> <?php } ?>     
        </tr>
        <tr>
            <td><label><b>Kick-Off:</b></label></td>
            <td><i style='color:red;' class="fas fa-exclamation"></i> <?php echo $infos1['kickoff'];;?></td>      
        </tr>   
    </table>

    <div type="button" style="color:white;" class="btn btn-primary"><a  style="color:white;"  href='/modul_uebersicht'>Zurück zur Übersicht</a></div>
    </div>
    </bewerbung>
<br><br>

</div>

