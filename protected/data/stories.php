<?php
// Definição das stories/variações dos componentes
return [
    'Select' => [
        // História Padrão (com controles placeholder e fullwidth)
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
                'disabled' => false, // Valor fixo
                'multiple' => false,
                'fullwidth' => false, // Controlável
                'error' => false,     // Valor fixo
            ],
        ],
        // História Desabilitado (com controles placeholder e fullwidth)
        [
            'title' => 'Desabilitado',
            'props' => [
                'name' => 'select_disabled',
                'placeholder' => 'Desabilitado',
                'options' => [
                    'valor1' => 'Opção 1',
                    'valor2' => 'Opção 2',
                ],
                'selected' => '',
                'disabled' => true, // Valor fixo
                'multiple' => false,
                'fullwidth' => false, // Controlável
                'error' => false,     // Valor fixo
            ],
        ],
        // História Com Erro (com controles placeholder e fullwidth)
        [
            'title' => 'Com Erro',
            'props' => [
                'name' => 'select_error',
                'placeholder' => 'Inválido',
                'options' => [
                    'valor1' => 'Opção 1',
                    'valor2' => 'Opção 2',
                    'valor3' => 'Opção 3',
                ],
                'selected' => 'valor1',
                'disabled' => false, // Valor fixo
                'multiple' => false,
                'fullwidth' => false, // Controlável
                'error' => true,      // Valor fixo
                'errorMessage' => 'Este campo é obrigatório.', // Mensagem de erro
            ],
        ],
        // História Com Ícone
        [
            'title' => 'Com icone',
            'props' => [
                'name' => 'select_icone',
                'placeholder' => 'Selecione com ícone',
                'options' => [
                    'valor1' => 'Opção 1',
                    'valor2' => 'Opção 2',
                    'valor3' => 'Opção 3',
                ],
                'selected' => '',
                'disabled' => false,
                'multiple' => false,
                'fullwidth' => false,
                'error' => false,
                'icon' => '/assets/images/event.svg', // Corrigido: Caminho absoluto
            ],
        ],
    ],
];
