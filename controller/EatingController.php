<?php

class EatingController extends Controller
{

    private $viewDir = 'eating' .
    DIRECTORY_SEPARATOR;

    public function index()
    {
        //$workoutsModel=new Workouts;
        //$rezultatiIzTablice= $workoutsModel->readAll();  može i ovako ako se ne radi statična funkcija iz modela workouts.php
       $podaciizbaze=Eating::readAll(); 
    
        $this->view->render('eating' . DIRECTORY_SEPARATOR . 'index',[
            'podaci'=>$podaciizbaze
            
           ]);
    
    

        
    }
    public function trazi()
    {
        $podaci = Eating::trazi($_GET['uvjet']);

        if(count($podaci)===0){
            $this->view->render('pocetna', ['p'=>'Nema rezultata za tu pretragu!']);
            return;
        }

        $this->view->render('eating' . DIRECTORY_SEPARATOR . 'index',[
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
        Eating::create();
        $this->index();
    }
    }