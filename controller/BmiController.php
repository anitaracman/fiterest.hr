<?php

class BmiController extends Controller
{

    public function index()
    {
        $this->view->render('bmi' . DIRECTORY_SEPARATOR . 'index');
    }

    public function rezultat()
    {
        //gets user 'weight' input from previous page and converts it into a variable named '$bmiweight'.
        $bmiweight = $_POST['weight']; 

        //gets user 'height' input from previous page and converts it into a variable named '$bmiheight'.
        $bmiheight = $_POST['height'];

        //calculates the bmi based on what is inputted and gives the result the variable name '$bmi'.
        $bmi = $bmiweight / ($bmiheight * $bmiheight);

        $this->view->render('bmi' . DIRECTORY_SEPARATOR . 'rezultat', [
            'bmi'=> $bmi
        ]);
    }
}