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

    }