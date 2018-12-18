</div>
</div>


<!-- Box in der Navigation auf der rechten Seite -->
<div class="col-4">
    <div class="nav_box">
        <h5 class="mt-0">Wichtige Links</h5>
        <i class="fa fa-info" aria-hidden="true"></i> <a href="/index"> Informationsseite</a><br>
        <i class="fa fa-list" aria-hidden="true"></i> <a href="/modul_uebersicht"> Themenübersicht</a><br>
        <a href="http://www.uni-goettingen.de/de/department+f%c3%bcr+betriebswirtschaftslehre/416213.html">Betriebswirtschaftliche Professuren</a><br>
        <a href="http://www.uni-goettingen.de/de/department+f%c3%bcr+volkswirtschaftslehre/416738.html">Volkswirtschaftliche Professuren</a><br>
        <a href="">z. B. Downloadlink der Folien der Informationsveranstaltung</a>
    </div>
    <navihd>
   <?php 
    if(isset($_SESSION['login'])){ ?>
  
          <div class="nav_box">
            <h5 class="mt-0">Admin Navigation</h5>
            <p>
                <div style='border-top: 1px solid #e7e7e7;' class='navhd'><i class="fas fa-angle-right"></i> <a href="/verwaltung">Verwaltung</a></div>
                <div class='navhd'><i class="fas fa-list-ul"></i> <a href="/mt_verwaltung">Modul- und Themenverwaltung</a></div>
                <div class='navhd'><i class="far fa-plus-square"></i> <a href="/abschlussarbeit_eintragen">Abschlussthemen eintragen</a></div>
                <div class='navhd'><i class="fas fa-plus-square"></i> <a href="/seminar_eintragen">Seminarthemen eintragen</a></div>
               <!-- <div class='navhd'><i class="fas fa-archive"></i> <a href="/archivierung">Archvierungen einsehen</a></div> -->
                <!--<div class='navhd'><i class="far fa-chart-bar"></i> <a href="/report_wahl">Report erstellen</a></div> -->
            </p>
        </div>
    </navihd>       
        <?php } 
            else{
            }
        ?>
    <div class="nav_box">
        <h5 class="mt-0">Kontakt</h5>
        <p>
        Henrik Wesseloh<br>
        M. Sc. in Wirtsch.-Inf.<br>
        Professur für Anwendungssysteme <br>und E-Business <br>
        Platz der Göttinger Sieben 5<br>
        37073 Göttingen<br>
        Tel. +49 (0)551 / 39-7331 <br>
        <i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:henrik.wesseloh@uni-goettingen.de"> henrik.wesseloh@uni-goettingen.de</a>
        </p>
    </div>
</div>
</div>
</div>


