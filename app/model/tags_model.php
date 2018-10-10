<?php

class tags_model
{
    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;
        
    }
    public function insertTags($tag_bezeichnung, $thema_id)
    {

        $tags_array = explode(",", $tag_bezeichnung); // heraus kommt [0] --> blubb [1] --> bla etc
        $k = 0;

        while ($k < count($tags_array)) {
            $statement = $this->dbh->prepare("INSERT INTO `tags` (`tag_bezeichnung`,`thema_id`)
        VALUES (?,?)");
            $statement->bind_param('si', $tags_array[$k], $thema_id);
            $statement->execute();
            $k = $k + 1;
        }
    }

    public function deleteTags($modul_id)
    {
         $statement = $this->dbh->prepare("DELETE tags FROM tags,thema,modul 
         WHERE tags.thema_id = thema.thema_id 
         AND thema.modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();

    }

    public function TagsByThemaID($thema_id)
    {
        $statement = $this->dbh->prepare("SELECT tag_bezeichnung FROM tags WHERE thema_id =?");
        $statement->bind_param('i', $thema_id);
        $statement->bind_result($tag_bezeichnung);
        $statement->execute();

        $tags = array();
        while ($statement->fetch()) {
            $row = array(
                'tag_bezeichnung' => $tag_bezeichnung
            );
            $tags[] = $row;
        }
        return $tags;
    }

    public function getTagsBezeichnung()
    {
        $statement = $this->dbh->prepare("SELECT tags.tag_bezeichnung FROM `tags`,`thema`,`modul`  WHERE tags.thema_id = thema.thema_id AND thema.modul_id = modul.modul_id AND modul.archivierung = 'false' GROUP BY tags.tag_bezeichnung");
        $statement->bind_result($tag_bezeichnung);
        $statement->execute();

        $tagsBezFilter = array();
        while ($statement->fetch()) {
            $row = array(
                'tag_bezeichnung' => $tag_bezeichnung
            );
            $tagsBezFilter[] = $row;
        }
        return $tagsBezFilter;
    }

}
