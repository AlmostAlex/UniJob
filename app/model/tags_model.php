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
/*
public function searchTag($term){
    
$query = $term;
$likeVar = "%" . $query . "%";
$statement = $this->dbh->prepare("SELECT DISTINCT tag_bezeichnung FROM `tags` WHERE tag_bezeichnung like '{$likeVar}'");
$statement->execute();
$statement->bind_result($tag_bezeichnung);

$json = [];
   while ($statement->fetch()) {
   $json[] = $tag_bezeichnung;
   }
   echo json_encode($json);
}
*/

    public function getTagString($tags)
    {
        //echo 'StringTag:' . $tags . '<br>';
    }

}
