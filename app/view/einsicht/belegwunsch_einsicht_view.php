<open>
    <div class='alert alert-secondary' role='alert'>
    Von insgesamt 
    <b><?php echo $infos['anzThema']; ?></b> Themen 
             <?php if($infos['kategorie'] == "Seminararbeit"){ echo 'sind im Modul <b> "'. $infos['modulbezeichnung'].'"';} else {  echo 'in der Professur <b>"'. $infos['professur'].'"';} ?> 
          
 
 </div>
 </open>