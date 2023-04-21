<?php

    if(file_exists('database.json')){

        //riprendo la stringa dentro database.json
        $listaJson = file_get_contents('database.json');
        
        //trasformo la stringa in un array associativo
        $listaArray = json_decode($listaJson, true);


                    //PER ELIMINARE UNA TASK
                    if(isset($_POST['index'])){
                        $iDelete = $_POST['index'];
                        unset($listaArray[$iDelete]);

                        //trasformo $listaArray in una stringa ( Json )
                        $listaString = json_encode($listaArray);

                        //creo il file database.json (se non c'è) e dentro ci metto la stringa  di $listaString
                        file_put_contents('database.json', $listaString);
                    }
        
                    //PER INVERTIRE VALORE DI UNA CHIAVE DELLA TASK
                    if(isset($_POST['i'])){
                        $iToggle = $_POST['i'];
                        $listaArray[$iToggle]['done'] = !$listaArray[$iToggle]['done'];  
                        
                        //trasformo $listaArray in una stringa ( Json )
                        $listaString = json_encode($listaArray);
                        
                        //creo il file database.json (se non c'è) e dentro ci metto la stringa  di $listaString
                        file_put_contents('database.json', $listaString);
                    }

    }else{
        $listaArray = [];
    }




    if(isset($_POST['newTodoItem'])){
        $item = ['text' => $_POST['newTodoItem'],'done' => false];
        
        //aggiungo $item a $listaArray
        $listaArray[] = $item;

        //trasformo $listaArray in una stringa ( Json )
        $listaString = json_encode($listaArray);
        
        //creo il file database.json (se non c'è) e dentro ci metto la stringa  di $listaString
        file_put_contents('database.json', $listaString);
    }



    //lo trasformo in un file json
    header('Content-Type: application/json');
    echo json_encode($listaArray);




    /*ITER INIZIALE
        1- All'avvio del programma (in mounted) viene chiamato AXIOS GET che ha bisogno di 
        file in formato json e da server.php prende i file di $listaArray ma codificati
        in json.

        2- (nel percorso EVITA la condizione [IF database exist] )
        
        3- (nel percorso EVITA la condizione [IF ho un valore in $_POST])

        4- con quei valori presi, e messi dentro una variabile in main.js,
        l'html costruirà la lista in modo dinamico.

    ITER CON NUOVA TASK
        1- Quando aggiungo una task (cliccando sul bottone) si avvia una funzione
        che con AXIOS POST invia il valore del v-model dell'input a server.php. 

        2- (nel percorso EVITA la condizione [IF database exist] )

        3- ENTRA nella condizione [IF ho un valore $_POST] e creo un array associativo
        che il valore passato in $_POST.
        L'array viene codificato in Json, 
        viene creato database.json, 
        l'array viene messo nel database.json sottoforma di stringa (Json)
        
        4- poi di nuovo con quei valori presi, e messi dentro una variabile in main.js,
        l'html costruirà la lista in modo dinamico.

    ITER CON NUOVA TASK E DATABASE GIà ESISTENTE
        1- Quando aggiungo una task (cliccando sul bottone) si avvia una funzione
        che con AXIOS POST invia il valore del v-model dell'input a server.php.

        2- ENTRA nella condizione [IF database exist] e prendo la stringa
        che è contenuta. 
        La decodifico in un array associativo.

        3- ENTRA nella condizione [if ho un valore $_POST] e creo un array associativo
        che il valore passato in $_POST.
        L'array (1) viene codificato in Json (stringa) e affidato ad un'altra varibile.
        La nuova variabile (striga) viene aggiunto nel database.json

        4- poi di nuovo con quei valori presi, e messi dentro una variabile in main.js,
        l'html costruirà la lista in modo dinamico.
        */