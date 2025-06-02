<?php

class InternalErrorException extends Exception {}
class MissingEntryException extends Exception {}
interface KommentarDAO
{

    public function createComment($id, $email, $inhalt, $sterneBewertung); //id wird hier mit übergeben, da es die id des zugehörigen rezepts sein soll


    public function readComment($id);


    public function deleteComment($id);


    public function getCommentsByRezeptId($rezeptId); //damit nur die passenden kommentare angezeigt werden
}
