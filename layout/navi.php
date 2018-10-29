</div>
</div>


<!-- Box in der Navigation auf der rechten Seite -->
<div class="col-4">
    <div class="nav_box">
        <h5 class="mt-0">Wichtige Links</h5>
        <i class="fa fa-info" aria-hidden="true"></i> <a href="/index"> Informationsseite</a><br>
        <i class="fa fa-list" aria-hidden="true"></i> <a href="Themen_uebersicht_student.php"> Themenübersicht</a><br>
        <a href="http://www.uni-goettingen.de/de/department+f%c3%bcr+betriebswirtschaftslehre/416213.html">Betriebswirtschaftliche Professuren</a><br>
        <a href="http://www.uni-goettingen.de/de/department+f%c3%bcr+volkswirtschaftslehre/416738.html">Volkswirtschaftliche Professuren</a><br>
        <a href="">z. B. Downloadlink der Folien der Informationsveranstaltung</a>
    </div>
   <?php 
    if(isset($_SESSION['login'])){ ?>
        <div class="nav_box">
            <h5 class="mt-0">Admin Navigation</h5>
            <p>
                <i class="fas fa-angle-right"></i> <a href="/verwaltung">Verwaltung</a><br>
                <i class="fas fa-angle-right"></i> <a href="/seminar_eintragen">Seminarthemen eintragen</a><br>
                <i class="fas fa-angle-right"></i> <a href="/abschlussarbeit_eintragen">Abschlussthemen eintragen</a><br>
                <i class="fas fa-angle-right"></i> <a href="/mt_verwaltung">Modul- und Themenverwaltung</a><br>
                <i class="fas fa-angle-right"></i> <a href="/archivierung">Archvierungen einsehen</a><br>
                <i class="fas fa-angle-right"></i> <a href="/report_wahl">Report erstellen</a><br>
            </p>
        </div>
        <?php } 
            else{
            }
        ?>
    <div class="nav_box">
        <h5 class="mt-0">Kontakt</h5>
        <p>
            Henrik Wesseloh<br>
            Platz der Göttinger Sieben 5<br>
            37073 Göttingen<br>
            Tel. +49 (0)551 39 7331<br>
            Fax. +49 (0)551 39 9735<br><br>
            <i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:henrik.wesseloh@uni-goettingen.de"> henrik.wesseloh@uni-goettingen.de</a>
        </p>
    </div>
</div>
</div>
</div>