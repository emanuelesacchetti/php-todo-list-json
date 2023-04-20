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

    //lo trasformo in un file json
    header('Content-Type: application/json');
    echo json_encode($todoList);