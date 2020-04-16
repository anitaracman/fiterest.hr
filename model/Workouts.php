<?php

class Workouts
{

    
    public static function trazi($uvjet)
    {

        $uvjet = '%' . $uvjet . '%';
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        select b.post_title, b.post_content, b.image, b.post_date
        from topics a inner join posts b on a.topic_id=b.topic_id 
        where a.topic_id=1 and b.post_content like :uvjet
        ');

        $izraz->execute(['uvjet'=>$uvjet]);

        return $izraz->fetchAll();
    }

    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from posts where topic_id=1');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($topic_id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from posts
        where topic_id=:1');
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





    public static function delete()
    {
        try{
            $_POST['operater']=$_SESSION['operater']->sifra;
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('delete from posts where topic_id=:topic_id');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }

    public static function update()
    {
        $_POST['operater']=$_SESSION['operater']->sifra;
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        update posts set topic_id=:topic_id, operater=:operater, post_title=:post_title, post_content=:post_content, image=:image
        where post_id=:post_id
        ');
        $izraz->execute([
            'post_id' => $_GET['post_id'],
            'operater' => $_GET['operater'],
            'topic_id' => $_GET['topic_id'],
            'post_title' => $_POST['post_title'],
            'post_content' => $_POST['post_content'],
            'image' => $_POST['image']
            
            
        ]);
    }


}

