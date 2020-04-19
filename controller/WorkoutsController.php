<?php

class WorkoutsController extends Controller
{

    private $viewDir = 'workouts' .
    DIRECTORY_SEPARATOR;

    public function index()
    {
        //$workoutsModel=new Workouts;
        //$rezultatiIzTablice= $workoutsModel->readAll();  može i ovako ako se ne radi statična funkcija iz modela workouts.php
       $podaciizbaze=Workouts::readAll(); 
    
        $this->view->render('workouts' . DIRECTORY_SEPARATOR . 'index',[
            'podaci'=>$podaciizbaze
           ]);
    
    

        
    }


    public function trazi()
    {
        $podaci = Workouts::trazi($_GET['uvjet']);
        if(count($podaci)===0){
            $this->view->render('workouts'.  DIRECTORY_SEPARATOR . 'index', [
                'podaci'=>[],
                'p'=>'Sorry, no results were found!!'
                ]);
            return;
        }
        $this->view->render('workouts' . DIRECTORY_SEPARATOR . 'index',[
            'podaci'=>$podaci
        ]);
    }
    public function novi()
    {
        $this->view->render($this->viewDir . 'novi',
            ['poruka'=>'Popunite sve tražene podatke']
        );
    }


    public function dodajnovi()
    {
        //prvo dođu sve silne kontrole
        Workouts::create();
        $this->index();
    }


    public function obrisi()
    {
        //prvo dođu silne kontrole
        Workouts::delete();
        header('location: /workouts/index');
    }

    public function promjena()
    {
        $workouts = Workouts::read($_GET['post_id']);
        if(!$workouts){
            $this->index();
            exit;
        }

        $this->view->render($this->viewDir . 'promjena',
            ['workouts'=>$workouts,
                'poruka'=>'Change']
        );
     
    }

    public function promjeni()
    {
        // I OVDJE DOĐU SILNE KONTROLE
        Workouts::update();
        header('location: /workouts/index');
    }

}