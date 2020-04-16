<?php

class Eating
{

    
    public static function trazi($uvjet)
    {

        $uvjet = '%' . $uvjet . '%';
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        select b.post_title, b.post_content, b.image, b.post_date
        from topics a inner join posts b on a.topic_id=b.topic_id 
        where a.topic_id=2 and b.post_content like :uvjet
        ');

        $izraz->execute(['uvjet'=>$uvjet]);

        return $izraz->fetchAll();
    }

   

    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from posts where topic_id=2');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($topic_id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from posts
        where topic_id=:2');
        $izraz->execute(['topic_id'=>$topic_id]);
        return $izraz->fetch();
    }


    public static function create()
    {
       
        $_POST['operater']=$_SESSION['operater']->sifra;
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('insert into posts 
        (topic_id, operater, post_title, post_content, image) values 
        (:topic_id, :operater, :post_title, :post_content, :image)');
        $izraz->execute($_POST);
        
       
    }

}

