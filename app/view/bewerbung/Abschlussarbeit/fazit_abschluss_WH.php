<br><div class='windhund'>
    <h4 class='bew_ue'><i class="far fa-check-square"></i> Eingaben zur Anmeldung </h4>    
<div class='alert alert-secondary' role='alert'> 
    Die Anmeldung wurde am <b><?php echo $infos['date']; ?></b> um <b><?php echo $infos['time']; ?></b> abgeschickt.<br>
    Du hast dich erfolgreich für die <?php echo $infos['kategorie'];?> 
    <?php if($infos['kategorie']=='Seminararbeit'){ echo 'im Modul <b>'. $infos['bez'] .'</b> angemeldet.'; }
    else{ echo 'an der Professur <b>' . $infos['bez'] .'</b> angemeldet.'; } ?> 
 </div>

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
            <td><label><b>Zulassung:</b></label></td>
            <td><?php echo $zulassung; ?></td>
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

    <button type="button" class="btn btn-primary" href="/modul_uebersicht">Zurück zur Übersicht</button>
    </div>
<br><br>

</div>

