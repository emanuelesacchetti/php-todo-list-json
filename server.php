<?php
    /*creo l'array associativo
    $todoList = [
        [
            'text'=> 'Fare la spesa',
            'done'=> false
        ],
        [
            'text'=> 'Preparare la cena',
            'done'=> false
        ],
        [
            'text'=> 'Allenarsi',
            'done'=> false
        ],
        [
            'text'=> 'Guardare la partita',
            'done'=> false
        ]
    ];*/

    if(file_exists('database.json')){

        //riprendo la stringa dentro database.json
        $listaJson = file_get_contents('database.json');

        //trasformo la stringa in un array associativo
        $listaArray = json_decode($listaJson, true);

    }else{
        $listaArray = [];
    }




    if(isset($_POST['newTodoItem'])){
        $item[] = [
                        'text' => $_POST['newTodoItem'],
                        'done' => false
                    ];
        
        //aggiungo $item a $listaArray
        $listaArray[] = $item;

        //trasformo $listaArray in una stringa ( Json )
        $listaArray = json_encode($listaArray);
        
        //creo il file database.json e dentro ci metto la stringa  di $todoListStringa
        file_put_contents('database.json', $listaArray);
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

        4- con qui valori presi, e messi dentro una variabile in main.js,
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
        
        4- poi di nuovo con qui valori presi, e messi dentro una variabile in main.js,
        l'html costruirà la lista in modo dinamico.

    ITER CON NUOVA TASK E DATABASE GIà ESISTENTE
        1- Quando aggiungo una task (cliccando sul bottone) si avvia una funzione
        che con AXIOS POST invia il valore del v-model dell'input a server.php.

        2- ENTRA nella condizione [IF database exist] e prendo ila stringa
        che è contenuta. 
        La decodifico in un array associativo.

        */