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
        where a.topic_id=1 and b.post_content like :uvjet or a.topic_id=1 and b.post_title like :uvjet
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

    public static function read($post_id)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from posts
        where post_id=:post_id');
        $izraz->execute(['post_id'=>$post_id]);
        return $izraz->fetch();
    }




    public static function create()
    {
        
  
        
        $_POST['image']= $_FILES['image']['name']; 
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('insert into posts 
        (topic_id,  post_title, post_content,image) values 
        (:topic_id, :post_title, :post_content,:image)');
        $izraz->execute($_POST);
        
        if(isset($_FILES['image'])){
            $putanja = BP . 'view' . DIRECTORY_SEPARATOR
            . 'workouts' . DIRECTORY_SEPARATOR . 
            'slike' . DIRECTORY_SEPARATOR 
            . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $putanja);
        }
       
    }


    public static function delete()
    {
        try{
           
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('delete from posts where post_id=:post_id');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }

    public static function update()
    {
        
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        update posts set post_title=:post_title, post_content=:post_content
        where post_id=:post_id
        ');
        $izraz->execute([
       
            
            'post_id' => $_POST['post_id'],
            'post_title' => $_POST['post_title'],
            'post_content' => $_POST['post_content'],
          
            
            
        ]);
    }
}