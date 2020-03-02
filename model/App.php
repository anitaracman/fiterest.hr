<?php

class App
{
    public static function start()
    {
        $ruta=Request::getRuta();
        $djelovi=explode('/',$ruta);
       $klasa='';
        if(!isset($djelovi[1]) || $djelovi[1]===''){
            $klasa='Index';
        }else{
            $klasa=ucfirst($djelovi[1]);
        }
        $klasa.='Controller';
        $funkcija='';
        if(!isset($djelovi[2]) || $djelovi[2]===''){
                $funkcija='index';
            }else{
                $funkcija=$djelovi[2];
        }
        if(class_exists($klasa) && method_exists($klasa,$funkcija)){
            $instanca = new $klasa();
            $instanca->$funkcija();
        }else{
           
echo 'Moraš napraviti datoteku ' . $klasa . '.php u direktoriju controller s sadržajem (pogledaj page source):';
echo "<?php\n";
echo "class " . $klasa ."\n";
echo "{\n";
echo "public function " . $funkcija .  "()\n";
echo "{\n";
echo "echo 'Hello iz " . $klasa .  "->" . $funkcija . "';\n";
echo "}}\n";


        }
    }
    

    public static function config($kljuc)
    {
        $config=include BP . 'konfiguracija.php' ;
        return $config[$kljuc];
    }
}