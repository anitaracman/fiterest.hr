<?php

class Equipment
{

   

    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from posts where topic_id=3');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    
}

