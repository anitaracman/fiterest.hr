<?php

class Eating
{

   

    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from posts where topic_id=2');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    
}

