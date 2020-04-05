<?php

class EquipmentController extends Controller
{

    private $viewDir = 'equipment' .
    DIRECTORY_SEPARATOR;

    public function index()
    {
        //$workoutsModel=new Workouts;
        //$rezultatiIzTablice= $workoutsModel->readAll();  može i ovako ako se ne radi statična funkcija iz modela workouts.php
       $podaciizbaze=Equipment::readAll(); 
    
        $this->view->render('equipment' . DIRECTORY_SEPARATOR . 'index',[
            'podaci'=>$podaciizbaze
            
           ]);
    
    

        
    }

    }