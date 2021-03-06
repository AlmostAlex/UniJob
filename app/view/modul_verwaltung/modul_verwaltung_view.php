<div class="verwaltungsbox">
    <h4 class='card-title'><i class="fa fa-info-circle" aria-hidden="true"></i> 
        Zur Verwaltung der Module und Themen
    </h4>
        Auf der Verwaltungsseite für Modul(-themen), können folgende Funktionen ausgeführt werden:
    <ul>
        <li>Module und Themen können <b>bearbeitet</b> und <b>gelöscht</b> werden.</li>
        <li>Existiert im Modul nur <b>ein Thema</b>, das gelöscht werden soll, wird das <b>gesamte Modul</b> gelöscht.</li>
        <li>Es können Bewerbungen zu den Modulen eingesehen und verwaltet werden.</li>
        <li>Weitere Themen können nachträglich zu den Modulen hinzugefügt werden.</li>
    </ul>
    Es können keine Module und Themen gelöscht werden, sobald der Starttermin eingetroffen ist.<br>
    Sobald der Starttermin gültig ist, sind keine Bearbeitungen im Bezug auf das ausgewählte Verfahren und Termine mehr
    möglich.<br>
</div>

<uebersicht>
    <div class='panel panel-default panel-table'>
        <div class='top'>
            <list>
                <table>
                    <tr>
                        <td style='width:20%;'>
                            <h3 class='panel-title-dozent'>Übersicht der Seminar- und Abschlussarbeiten Admin</h3>
                        </td>
                        <td style='width:40%;'>
                            <div class='btn-group_dozent' data-toggle='buttons'>
                                <label class='btn btn-filter' data-target='Geschlossen'>
                                    <input type='radio' name='options' id='option1' autocomplete='off' checked>
                                    <i class='fas fa-times'></i> Geschlossene Module
                                </label>
                                <label class='btn btn-filter' data-target='Offen'>
                                    <input type='radio' name='options' id='option2' autocomplete='off'>
                                    <i class='far fa-circle'></i> Offene Module</label>
                                <label class='btn btn-filter' data-target='all'><input type='radio' name='options' id='option3'
                                        autocomplete='off'>
                                    Alle Module</label>
                            </div>
                        </td>
                    </tr>
                </table>
            </list>
        </div>

        <module>
            <div class='panel-body'>
                <table style='width:100%;' class='panel_table'>
                    <tr>
                        <th style='width:7%;'></th>
                        <th style='width:50%;'>Modulbezeichnung</th>
                        <th style='width:15%;'>Status</th>
                        <th style='width:28%;'>Funktionen</th>
                    </tr>
                </table>

                <?php for ($i = 0; $i < count($module); $i++) {?>

                <table id='mytable' class='table table-striped table-bordered table-list'>
                    <tr data-status='<?php echo $module[$i]["modul_verfuegbarkeit"]; ?>'>
                        <td style='width:7%;'>
                            <center>
                                <a style='color: #3979b5;' class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#modulid_<?php echo $module[$i]["modul_id"]; ?>' aria-expanded='true'>
                                <i class='fa' aria-hidden='true'></i>
                                    </a>
                            </center>
                        </td>
                        <td style='width:50%;'><b>
                            <?php if($module[$i]["kategorie"] == "Seminararbeit"){
                                echo $module[$i]["nachrueckv_status"] .' '. $module[$i]["modulbezeichnung"];
                            }else{ 
                                echo $module[$i]["nachrueckv_status"] .' Professur: '. $module[$i]["professur"];
                            }?>
                            </b>
                            <br>
                            <div class='border_round'>
                                <?php echo $module[$i]["start_anzeige"] . ' - ' . $module[$i]["ende_anzeige"]; ?>
                            </div>
                            <div class='border_round'>
                                <?php echo $module[$i]["verfahren"]; ?>
                            </div>
                        </td>
                        <td style='width:15%;'>
                            <center>
                                <div class='modul_<?php echo $module[$i]["modul_verfuegbarkeit"]; ?>'>
                                   <div class='border-round-offen'> 
                                       <?php echo $module[$i]["modul_verfuegbarkeit"]; ?>
                                    </div>
                                </div>
                            </center>
                        </td>
                        <td style='width:28%;' align='center'>
                            <span data-toggle='tooltip' data-placement='top' title='Modul editieren' class='badge badge-secondary'>
                                <a href='/mt_verwaltung/modul/edit/<?php echo $module[$i]["kategorie"]; ?>/<?php echo $module[$i]["modul_id"]; ?>'><i class='far fa-edit'></i></a>
                            </span>
                            <span data-toggle='tooltip' data-placement='top' title='Modul löschen' class='<?php echo $module[$i]["checkDeleteBtn"] ?>'>
                                <a href='#' data-toggle='modal' data-target='#Sicherheitsabfrage_<?php echo $module[$i]["modul_id"]; ?>'><i class='far fa-trash-alt'></i></a>
                            </span>
                            <span data-toggle='tooltip' data-placement='top' title='Thema hinzufügen' class='badge badge-success'>
                                <a href='/mt_verwaltung/modul/add_thema/<?php echo $module[$i]["kategorie"]; ?>/<?php echo $module[$i]["modul_id"]; ?>'><i class='far fa-plus-square'></i></a>
                            </span>
                            <span data-toggle='tooltip' data-placement='top' title='Modul archvieren' class='<?php echo $module[$i]["checkArchivBtn"] ?>'>
                            <a href='#' data-toggle='modal' data-target='#Abfrage_<?php echo $module[$i]["modul_id"]; ?>'><i class='far fa-file-archive'></i></a>
                            </span>
                            <span data-toggle='tooltip' data-placement='top' title='Nachrückverfahren einleiten' class='<?php echo $module[$i]["checkNachrueckBtn"] ?>'>
                                <a data-toggle='modal' data-target='#nachrueckverfahren_<?php echo $module[$i]["modul_id"]; ?>' href='#'><i class='far fa-clock'></i></a>
                            </span>
                            <span data-toggle='tooltip' data-placement='top' title='Anmeldungen einsehen' class='<?php echo $module[$i]["einsicht_wh_btn"] ?>'>
                                <a href='/einsicht/<?php echo $module[$i]["verfahren"];?>/<?php echo $module[$i]["modul_id"]; ?>'><i style='color:white;' class="far fa-user"></i></a>
                            </span>

                            <span data-toggle='tooltip' data-placement='top' title='Anmeldungen einsehen' class='<?php echo $module[$i]["einsicht_bel_btn"] ?>'>
                                <a href='/einsicht/<?php echo $module[$i]["verfahren"];?>/<?php echo $module[$i]["modul_id"]; ?>'><i style='color:white;' class="far fa-user"></i> </a>
                            </span>
                            
                            <span data-toggle='tooltip' data-placement='top' title='Alle Bewerbungen einsehen' class='<?php echo $module[$i]["einsicht_bw_btn_all"] ?>'>
                                <a href='/einsicht/<?php echo $module[$i]["verfahren"];?>/modul/<?php echo $module[$i]["modul_id"]; ?>'><i class="fas fa-users"></i></i> </a>
                            </span>

                            <?php $this->getModal('delete_modul', $module[$i]["modul_id"]); $this->getModal('archivierung', $module[$i]["modul_id"]); $this->getModal('nachrueckverfahren', $module[$i]["modul_id"]);?>
                        </td>
                    </tr>
                </table>

                <inside>
                    <div id='modulid_<?php echo $module[$i]["modul_id"]; ?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                        <?php $themen = $this->Modul_Verwaltung('true', $module[$i]["modul_id"]);for ($j = 0; $j < count($themen); $j++) {?>
                        <table width='100%' id='mytable' class='table table-striped table-bordered table-list'>
                            <tr data-status='<?php echo $module[$i]["modul_verfuegbarkeit"]; ?>'>
                                <td style='width:7%;'></td>
                                <td style='width:50%;'>
                                    <?php echo $themen[$j]["themenbezeichnung"]; ?>
                                </td>
                                <td style='width:15%;'>
                                    <center>
                                        <?php echo $themen[$j]["thema_verfuegbarkeit"]; ?>
                                    </center>
                                </td>
                                <td style='width:28%;' align='center'>
                                    <span data-toggle='tooltip' data-placement='top' title='Thema editieren' class='badge badge-secondary'>
                                        <a href='/mt_verwaltung/thema/edit/<?php echo $themen[$j]["thema_id"]; ?>'><i class='far fa-edit'></i></a>
                                    </span>
                                    <span data-toggle='tooltip' data-placement='top' title='Anmeldungen einsehen' class='<?php echo $module[$i]["einsicht_bw_btn"] ?>'>
                                    <a href='/einsicht/<?php echo $module[$i]["verfahren"];?>/<?php echo $themen[$j]["thema_id"]; ?>'><i style='color:white;' class="far fa-user"></i></a> 
                                    </span>

                                    <!-- Lösch funktion fehlt-->
                                </td>
                            </tr>
                        </table>
                        <?php }?>
                    </div>
                </inside>
                <?php }?>
            </div>
        </module>
        <list>
            <div class='panel-footer'>
                <div class=''>
                    Modul für
                    <a href='/seminar_eintragen'><u>Seminarthemen</u></a> 

                     / 

                    <a href='/abschlussarbeit_eintragen'><u> Abschlussarbeiten</u></a>

                    hinzufügen             
                </div>
            </div>
        </list>
    </div>
</uebersicht><br><br><br><br>





<!-- Button trigger modal -->