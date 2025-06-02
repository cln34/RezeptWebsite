<?php

class InternalErrorException extends Exception {}
class MissingEntryException extends Exception {}
interface KommentarDAO
{

    public function createComment($email, $text, $sterneBewertung);


    public function readComment($id);


    public function deleteComment($id);


    public function getComments();
}
