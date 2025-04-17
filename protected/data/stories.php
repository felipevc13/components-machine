<?php
// Definição das stories/variações dos componentes
return [
    'Select' => [
        [
            'title' => 'Padrão',
            'props' => [
                'name' => 'select_padrao',
                'placeholder' => 'Selecione',
                'options' => [
                    'valor1' => 'Opção 1',
                    'valor2' => 'Opção 2',
                    'valor3' => 'Opção 3',
                ],
                'selected' => '',
                'disabled' => false,
                'multiple' => false,
            ],
        ],
        [
            'title' => 'Desabilitado',
            'props' => [
                'name' => 'select_disabled',
                'options' => [
                    'valor1' => 'Opção 1',
                    'valor2' => 'Opção 2',
                ],
                'selected' => 'valor1',
                'disabled' => true,
                'multiple' => false,
            ],
        ],

    ],
];
