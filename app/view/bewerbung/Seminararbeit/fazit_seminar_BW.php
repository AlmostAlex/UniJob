<br><div class='windhund'>
    <h4 class='bew_ue'><i class="far fa-check-square"></i> Eingaben zur Bewerbung</h4>    
<div class='alert alert-secondary' role='alert'> 
    Die Bewerbung wurde am <b><?php echo $infos['date']; ?></b> um <b><?php echo $infos['time']; ?></b> abgeschickt.<br>
    Du hast dich erfolgreich für die <?php echo $infos['kategorie'];?> 
    <?php if($infos['kategorie']=='Seminararbeit'){ echo 'im Modul <b>'. $infos['bez'] .'</b> angemeldet.'; }
    else{ echo 'an der Professur <b>' . $infos['bez'] .'</b> angemeldet.'; } ?> 
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
            <td><label><b>Studiengang:</b></label></td>
            <td><?php echo $studiengang;?></td>
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
            <td><label><b>Anzahl Credits:</b></label></td>
            <td><?php echo $credits;?></td>
        </tr>       

        <tr>
            <td><label><b>Vorkenntnisse:</b></label></td>
            <td>
            
            <?php
            if($vmsg == 'true'){ ?>
            <ul>
            <?php
                for($i=0; isset($_POST['Vorkenntnisse_'.$i]) == true;$i++)
                { 
                    echo '<li><div class="v'.$_POST['Vorkenntnisse_'.$i].'">'. $vorkenntnisse[$i]['bezeichnung'] .': <b>'. $_POST['Vorkenntnisse_'.$i]; 
                    echo '</div></b></li>';
                }?>
                </ul>
                <?php } else { echo "Keine Vorkenntnisse notwendig.";}
            ?>
            
            </td>
        </tr>

        <tr>
            <td><label><b>Zulassung:</b></label></td>
            <td><?php echo $zulassung .''. $seminarteilnahme ?></td>
        </tr>          
        <tr>
            <td colspan='2' class='daten'>
            <div class='ue_txt'>
            <i class="far fa-clipboard"></i> Themenspezifische Daten
                <div class='ue_txt_v'></div> <div class='ue_txt_wh'></div></div>  
            </td>
        </tr>
        <tr>
            <td><label><b>Betreuer:</b></label></td>
            <td><?php echo $infos['betreuer'];?></td>      
        </tr>
        <tr>
            <td><label><b>Art:</b></label></td>
            <td><?php echo $infos['kategorie'];?></td>      
        </tr>   
        <tr>
            <td><label><b><?php echo $infos['kat'];?></b></label></td>
            <td><?php echo $infos['bez'];?></td>      
        </tr>   
        <tr>
            <td><label><b>Thema:</b></label></td>
            <td><?php echo $themenbezeichnung;?></td>      
        </tr>   
        <tr>
            <td><label><b>Kick-Off:</b></label></td>
            <td><i style='color:red;' class="fas fa-exclamation"></i> <?php echo $infos['kickoff'];;?></td>      
        </tr>   
    </table>

   <div type="button" style='color:white;' class="btn btn-primary"><a href='/modul_uebersicht'>Zurück zur Übersichtx</a></div>
    </div>
    </bewerbung>
<br><br>

</div>

