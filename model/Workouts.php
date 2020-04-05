<?php

class Workouts
{

    public static function ukupnoStranica($uvjet)
    {
        $uvjet='%'.$uvjet.'%';
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select count(a.post_id) from posts a 
        inner join osoba b  on a.osoba=b.sifra
        where concat(b.ime, \' \', b.prezime, 
        \' \',ifnull(b.oib,\'\')) like :uvjet 
        ');
        $izraz->bindParam('uvjet',$uvjet);
        $izraz->execute();
        $ukupnoRezultata=$izraz->fetchColumn();
        return ceil($ukupnoRezultata / App::config('rezultataPoStranici'));
    }

    public static function trazi($uvjet,$stranica)
    {
        $rps = App::config('rezultataPoStranici');

        $od = $stranica * $rps - $rps;


        $uvjet='%'.$uvjet.'%';
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select * from posts where topic_id=1
        
        ');
        $izraz->bindParam('uvjet',$uvjet);
        $izraz->bindValue('od',$od, PDO::PARAM_INT);
        $izraz->execute();

        return $izraz->fetchAll();
    }

    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from posts where topic_id=1');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from workouts
        where sifra=:sifra');
        $izraz->execute(['sifra'=>$sifra]);
        return $izraz->fetch();
    }

    public static function create()
    {
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('insert into workouts
        (naziv,trajanje,cijena,upisnina,verificiran) values 
        (:naziv,:trajanje,:cijena,:upisnina,:verificiran)');
        $izraz->execute($_POST);    
    }

    public static function delete()
    {
        try{
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('delete from workouts 
            where sifra=:sifra');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public static function update(){
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('update workouts 
        set naziv=:naziv,trajanje=:trajanje,
        cijena=:cijena,upisnina=:upisnina, 
        verificiran=:verificiran where sifra=:sifra');
        $izraz->execute($_POST);
    }
}

