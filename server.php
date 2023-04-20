<?php
    //creo l'array associativo
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
    ];

    if(isset($_POST['newTodoItem'])){
        $todoList[] = [
                        'text' => $_POST['newTodoItem'],
                        'done' => false
                    ];
    }

    //lo trasformo in un file json
    header('Content-Type: application/json');
    echo json_encode($todoList);

    