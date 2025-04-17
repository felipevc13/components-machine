<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Componentes</title>
    <link rel="stylesheet" href="/componentes-doc/assets/css/select.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:400,500,600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background: #fff;
            font-family: system-ui, sans-serif;
        }
        .storybook-header {
            position: relative; /* Necessário para z-index */
            z-index: 999; /* Garante que fique no topo */
            background: #ffffff; /* Fundo branco */
            color: #333333; /* Texto escuro */
            padding: 12px 24px; /* Ajustado padding para acomodar logo */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08); /* Sombra leve */
            display: flex; /* Adicionado para alinhar itens */
            align-items: center; /* Adicionado para alinhar verticalmente */
            gap: 8px; /* Adicionado para espaçamento entre logo e texto */
        }
        .storybook-layout {
            display: flex;
            min-height: 100vh;
        }
        .storybook-sidebar {
            width: 210px;
            background: #F6F9FC;
            color: #23272f;
            padding: 0;
            /* border-right: none; */
            min-height: 100vh;
        }
        .storybook-sidebar h2 {
            font-size: 1.1rem;
            padding: 24px 24px 8px 24px;
            margin: 0;
            color: #a0a4b8;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .storybook-sidebar-accordion {
            padding: 0 0 24px 0;
        }
        .storybook-sidebar .accordion-group {
            margin-bottom: 4px;
        }
        .storybook-sidebar .accordion-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 24px 8px 18px;
            font-weight: 500;
            color: #333333;
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 13px;
            transition: background 0.2s;
        }
        .storybook-sidebar .accordion-toggle .arrow {
            margin-right: 8px;
            font-size: 0.65em;
            color: #ACAEB1;
            transition: transform 0.2s;
        }
        .storybook-sidebar .accordion-toggle.open .arrow {
            transform: rotate(90deg);
        }
        .storybook-sidebar .accordion-panel {
            display: none;
            padding-left: 14px;
        }
        .storybook-sidebar .accordion-panel.open {
            display: block;
        }
        .storybook-sidebar .story-link {
            display: block;
            padding: 4px 12px 4px 34px;
            color: #23272f;
            text-decoration: none;
            border-radius: 4px;
            margin: 1px 0;
            font-size: 13px;
            font-weight: normal;
            background: none;
            border-left: 3px solid transparent;
            transition: background 0.17s, color 0.17s, border-color 0.17s, font-weight 0.17s;
        }
        .storybook-sidebar .story-link.active, .storybook-sidebar .story-link:hover {
            background: #f7f8fa;
            color: #ff4785;
            font-weight: bold;
            border-left: 3px solid #ff4785;
        }
        .storybook-sidebar .story-link .icon {
            font-size: 1em;
            color: #6be2b5;
        }
        .storybook-content {
            flex: 1;
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        .storybook-tabs {
            border-bottom: 1px solid #E0E0E0;
            padding: 8px 24px;
            background-color: #FFFFFF;
        }
        .storybook-tab-button {
            padding: 10px 16px;
            margin-bottom: -1px; /* Para sobrepor a borda inferior do container */
            border: none;
            border-bottom: 2px solid transparent;
            background: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #666666;
            transition: color 0.2s, border-color 0.2s;
        }
        .storybook-tab-button:hover {
            color: #333333;
        }
        .storybook-tab-button.active {
            color: #1EA7FD; /* Azul Storybook */
            border-bottom-color: #1EA7FD;
        }
        .storybook-tab-panel {
            display: none; /* Oculto por padrão */
            padding: 32px; /* Espaçamento interno do conteúdo */
            flex-grow: 1; /* Ocupa o espaço vertical restante */
            background-color: #F6F6F6; /* Alterado para cinza claro */
        }
        .storybook-tab-panel.active {
            display: block; /* Exibido quando ativo */
        }
        .storybook-controls-panel {
            background-color: #FFFFFF; /* Alterado para branco */
            border-top: 1px solid #E0E0E0;
            padding: 24px 32px;
            min-height: 150px; /* Altura mínima para a área de controles */
            color: #333333;
        }
        .storybook-controls-panel h3 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 16px;
            color: #444444;
        }
        .storybook-sidebar .history-item:hover {
            background: #ececec;
        }
        .storybook-sidebar .history-item.active {
            background-color: #e0e0e0; /* Fundo cinza para item ativo */
            font-weight: 600; /* Opcional: deixar o texto em negrito */
        }

        /* Estilos para as Histórias no Canvas */
        .storybook-tab-panel .story-wrapper {
            padding: 24px 0;
            border-bottom: 1px dashed #e0e0e0; /* Separador sutil */
        }
        .storybook-tab-panel .story-wrapper:last-child {
            border-bottom: none; /* Remover borda do último item */
        }
        .storybook-tab-panel .story-wrapper h4 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 16px;
            color: #555555;
            font-weight: 600;
        }

        /* === Estilos para SelectWidget === */
        .select-widget-wrapper {
            position: relative; /* Para posicionar o ícone */
            display: inline-block; /* Para ajustar ao conteúdo ou usar 'block' para largura total */
            min-width: 150px; /* Largura mínima opcional */
        }

        .select-widget-wrapper select.select-component {
            /* Resetar aparência padrão */
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;

            /* Estilos do Figma */
            background-color: #FFFFFF;
            border: 1px solid #A7ACB5;
            border-radius: 4px;
            padding: 8px 32px 8px 8px; /* 8px geral, mais 24px à direita para o ícone */
            font-family: 'Source Sans Pro', sans-serif; /* Garanta que a fonte esteja carregada */
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5; /* 24px / 16px */
            color: #323F52;
            cursor: pointer;
            width: 100%; /* Ocupa a largura do wrapper */
            box-sizing: border-box;
        }

        /* Ícone customizado (Chevron) */
        .select-widget-wrapper::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px; /* Espaçamento da direita */
            transform: translateY(-50%);
            width: 16px; /* Tamanho do ícone */
            height: 16px; /* Tamanho do ícone */
            background-image: url('/assets/images/ChevronDown.svg'); /* CAMINHO CORRIGIDO */
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            pointer-events: none; /* Não interfere com cliques no select */
            z-index: 1; /* Garante que fique sobre o select */
        }

        /* Estilo para estado Desabilitado */
        .select-widget-wrapper select.select-component:disabled {
            background-color: #f0f0f0; /* Cor de fundo desabilitada */
            color: #a0a0a0; /* Cor do texto desabilitada */
            border-color: #cccccc; /* Cor da borda desabilitada */
            cursor: not-allowed;
        }

        /* Opcional: Esmaecer o ícone quando desabilitado */
        .select-widget-wrapper select.select-component:disabled + ::after {
            opacity: 0.5;
        }

        /* === Estilos para Controles (Args Table) === */
        .storybook-controls-table {
            width: 100%;
            border-collapse: collapse; /* Comportamento de tabela */
            font-size: 13px;
            color: #333;
        }

        .storybook-control-row {
            display: flex;
            border-bottom: 1px solid #e0e0e0; /* Borda separadora cinza */
            align-items: center; /* Alinha verticalmente nome e input */
        }
        .storybook-control-row:last-child {
            border-bottom: none; /* Remove borda da última linha */
        }

        .storybook-controls-header {
            /* background removido */
            color: #666;
            font-weight: 700;
            border-bottom: 2px solid #e0e0e0;
        }
        .storybook-controls-header .storybook-control-name,
        .storybook-controls-header .storybook-control-input {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .storybook-control-name,
        .storybook-control-input {
            padding: 12px 16px; /* Espaçamento interno */
            box-sizing: border-box;
        }

        .storybook-control-name {
            flex: 0 0 30%; /* Largura fixa para o nome da prop */
            font-weight: 600;
        }
        .storybook-control-name label {
             display: block; /* Garante que o label ocupe o espaço */
             margin: 0;
        }

        .storybook-control-input {
            flex: 1; /* Ocupa o restante do espaço */
        }

        /* Estilos para o input dentro da tabela (remover inline styles da view depois) */
        .storybook-control-input input[type="text"],
        .storybook-control-input input[type="number"],
        .storybook-control-input select,
        .storybook-control-input textarea {
            width: 100%;
            padding: 6px 8px; /* Padding menor para input */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 13px;
        }
        .storybook-control-input input[type="checkbox"] {
             /* Estilos específicos para checkbox se necessário */
        }

    </style>
</head>
<body>
    <div class="storybook-header">
        <img src="/assets/images/logo.svg" alt="Logo" style="height: 40px; vertical-align: middle;">
        <span style="font-size: 1.1rem; font-weight: 600; letter-spacing: 0.5px;">Componentes Machine</span>
    </div>
    <div class="storybook-layout">
        <nav class="storybook-sidebar">
            <h2>Componentes</h2>
            <div class="storybook-sidebar-accordion">
            <?php
            $stories = require(dirname(__FILE__).'/../../data/stories.php');
            $currentPath = $_SERVER['REQUEST_URI'];
            $currentStory = isset($_GET['story']) ? $_GET['story'] : null;
            $accordionIdx = 0;
            foreach ($stories as $component => $componentStories) {
                $isOpen = false;
                foreach ($componentStories as $idx => $story) {
                    if (strpos($currentPath, '/componentes/select') !== false && $currentStory == $idx) {
                        $isOpen = true;
                        break;
                    }
                }
                $accordionId = 'accordion-'.$accordionIdx;
                echo '<div class="accordion-group">';
                echo '<button class="accordion-toggle'.($isOpen?' open':'').'" data-accordion="'.$accordionId.'">'
                    .'<span class="arrow'.($isOpen?' open':'').'">&#9654;</span>'
                    .'<span style="font-size:13px">'.htmlspecialchars($component).'</span>'
                    .'</button>';
                echo '<div class="accordion-panel'.($isOpen?' open':'').'" id="'.$accordionId.'">';
                echo '<ul style="list-style:none; padding-left:0; margin:0;">';
                foreach ($componentStories as $idx => $story) {
                    $href = "/componentes/select?story=$idx";
                    $isActive = (strpos($currentPath, '/componentes/select') !== false && $currentStory == $idx);
                    $activeClass = $isActive ? ' active' : ''; // Adiciona espaço antes se ativo
                    echo '<li class="history-item'.$activeClass.'" data-href="'.$href.'" style="font-size:13px; padding:4px 12px 4px 34px; border-radius:4px; cursor:pointer;">'.htmlspecialchars($story['title']).'</li>';
                }
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                $accordionIdx++;
            }
            ?>
            </div>
            <script>
            document.querySelectorAll('.accordion-toggle').forEach(function(btn){
                btn.addEventListener('click', function(){
                    var panel = document.getElementById(btn.getAttribute('data-accordion'));
                    var open = btn.classList.contains('open');
                    document.querySelectorAll('.accordion-toggle').forEach(function(b){ b.classList.remove('open'); });
                    document.querySelectorAll('.accordion-panel').forEach(function(p){ p.classList.remove('open'); });
                    if (!open) {
                        btn.classList.add('open');
                        if(panel) panel.classList.add('open');
                    }
                });
            });
            document.querySelectorAll('.history-item').forEach(function(item){
                item.addEventListener('click', function(){
                    var href = item.getAttribute('data-href');
                    if(href) window.location.href = href;
                });
            });
            </script>
        </nav>
        <main class="storybook-content">
            <div class="storybook-tabs">
                <button class="storybook-tab-button active" data-tab="canvas">Canvas</button>
                <button class="storybook-tab-button" data-tab="docs">Docs</button>
            </div>
            <div id="tab-panel-canvas" class="storybook-tab-panel active">
                <!-- Conteúdo do Canvas (componente renderizado) virá aqui -->
                <?php echo $content; // Temporariamente colocando o conteúdo antigo aqui ?>
            </div>
            <div id="tab-panel-docs" class="storybook-tab-panel">
                <!-- Conteúdo da documentação virá aqui -->
                <p>Documentação do componente aparecerá aqui.</p>
            </div>
            <div class="storybook-controls-panel">
                <h3>Controls</h3>
                <?php if(isset($this->clips['controls'])): ?>
                    <?php echo $this->clips['controls']; ?>
                <?php else: ?>
                    <p>Configurações (props) não disponíveis para esta visualização.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Script existente do accordion da sidebar
        document.querySelectorAll('.accordion-toggle').forEach(function(btn){
            // ... (código do accordion) ...
        });
        document.querySelectorAll('.history-item').forEach(function(item){
            // ... (código do history item) ...
        });

        // Novo script para as abas Canvas/Docs
        const tabButtons = document.querySelectorAll('.storybook-tab-button');
        const tabPanels = document.querySelectorAll('.storybook-tab-panel');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove 'active' de todos os botões e painéis
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanels.forEach(panel => panel.classList.remove('active'));

                // Adiciona 'active' ao botão clicado
                button.classList.add('active');

                // Adiciona 'active' ao painel correspondente
                const targetTab = button.getAttribute('data-tab');
                const targetPanel = document.getElementById(`tab-panel-${targetTab}`);
                if (targetPanel) {
                    targetPanel.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
