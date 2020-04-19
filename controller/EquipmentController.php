<?php

class EquipmentController extends Controller
{

    private $viewDir = 'equipment' .
    DIRECTORY_SEPARATOR;

    public function index()
    {
       $podaciizbaze=Equipment::readAll(); 
    
        $this->view->render('equipment' . DIRECTORY_SEPARATOR . 'index',[
            'podaci'=>$podaciizbaze
            
           ]);
    
    

        
    }


    public function trazi()
    {
        $podaci = Equipment::trazi($_GET['uvjet']);

        if(count($podaci)===0){
            $this->view->render('pocetna', ['p'=>'Nema rezultata za tu pretragu!']);
            return;
        }

        $this->view->render('equipment' . DIRECTORY_SEPARATOR . 'index',[
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
        Equipment::create();
        $this->index();
    }
    
    public function obrisi()
    {
        //prvo dođu silne kontrole
        Equipment::delete();
        header('location: /equipment/index');
    }

    public function promjena()
    {
        $equipment = Equipment::read($_GET['post_id']);
        if(!$equipment){
            $this->index();
            exit;
        }

        $this->view->render($this->viewDir . 'promjena',
            ['equipment'=>$equipment,
                'poruka'=>'Change']
        );
     
    }

    public function promjeni()
    {
        // I OVDJE DOĐU SILNE KONTROLE
        Equipment::update();
        header('location: /equipment/index');
    }

}