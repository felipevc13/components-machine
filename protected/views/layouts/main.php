<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Componentes</title>
    <?php
    // Registrar CSS principal e o CSS do select usando Yii
    Yii::app()->clientScript->registerCssFile('/assets/css/select.css');
    Yii::app()->clientScript->registerCssFile('/assets/css/storybook.css');
    ?>
    <link href="https://fonts.googleapis.com/css?family=Inter:400,500,600&display=swap" rel="stylesheet">
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
