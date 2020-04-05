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
    
    if(!isset($_GET['stranica']) || $_GET['stranica']=='0'){
        $stranica=1;
    }else{
        $stranica=$_GET['stranica'];
    }

    $podaci = Workouts::trazi($_GET['uvjet'],
    $stranica);

    if(count($podaci)===0){
        $stranica--;
        $podaci = Workouts::trazi($_GET['uvjet'],
        $stranica);
    }

    $this->view->render($this->viewDir . 'index',[
        'podaci'=>$podaci,
        'stranica' => $stranica,
        'uvjet' => $_GET['uvjet'],
        'ukupnoStranica' => Workouts::ukupnoStranica($_GET['uvjet'])
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
    if(Workouts::delete()){
        header('location: /workouts/index');
    }
    
}

public function promjena()
{
    $workouts = Workouts::read($_GET['sifra']);
    if(!$workouts){
        $this->index();
        exit;
    }

    $this->view->render($this->viewDir . 'promjena',
        ['workouts'=>$workouts,
            'poruka'=>'Promjenite željene podatke']
    );
 
}

public function promjeni()
{
    // I OVDJE DOĐU SILNE KONTROLE
    Workouts::update();
    header('location: /workoutsr/index');
}
}