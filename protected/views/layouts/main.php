<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Componentes</title>
    <?php
    // Registrar CSS principal e o CSS do select usando Yii
    Yii::app()->clientScript->registerCssFile('/assets/css/storybook.css'); // Keep storybook styles
    Yii::app()->clientScript->registerCssFile('/assets/css/main.css'); // Add the compiled SCSS output
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet"> <!-- Import Source Sans Pro -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/storybook.css">
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

            // --- Adicionar Design Tokens manualmente --- 
            $designTokens = [
                'Cores Primárias' => [
                    '$primary-1' => '#E6F6FC', '$primary-2' => '#B3E1F7', '$primary-3' => '#80CCF2',
                    '$primary-4' => '#4DB8ED', '$primary-5' => '#1AA3E8', '$primary-6' => '#1A79E0',
                    '$primary-7' => '#165AB6', '$primary-8' => '#123C8C', '$primary-9' => '#0E2D6B',
                    '$primary-10' => '#0A1E4A',
                ],
                'Cores Neutras' => [
                    '$neutral-1' => '#EBECEE', '$neutral-2' => '#CED1D5', '$neutral-3' => '#A7ACB5',
                    '$neutral-4' => '#808894', '$neutral-5' => '#5A6272', '$neutral-6' => '#344054',
                    '$neutral-7' => '#2A3343', '$neutral-8' => '#1F2632', '$neutral-9' => '#151A21',
                    '$neutral-10' => '#0A0D11',
                ],
                'Cores de Sucesso' => [
                    '$success-1' => '#E8F3ED', '$success-2' => '#B6DFC7', '$success-3' => '#84CBA1', 
                    '$success-4' => '#52B77B', '$success-5' => '#3E9A67', '$success-6' => '#3D8F5A',
                    '$success-7' => '#2E734B', '$success-8' => '#20573C', '$success-9' => '#123C2D',
                    '$success-10' => '#09241B',
                ],
                'Cores de Aviso' => [
                    '$warning-1' => '#FFF7E6', '$warning-2' => '#FFEDB3', '$warning-3' => '#FFE380',
                    '$warning-4' => '#FFD94D', '$warning-5' => '#FFCE1A', '$warning-6' => '#E6A200',
                    '$warning-7' => '#B37E00', '$warning-8' => '#805B00', '$warning-9' => '#4D3700',
                    '$warning-10' => '#261B00',
                 ],
                  'Cores Laranja (Orange)' => [
                    '$orange-1' => '#FFF3EA', '$orange-2' => '#FFDFCA', '$orange-3' => '#FFCAAA',
                    '$orange-4' => '#FFB58A', '$orange-5' => '#FFA16A', '$orange-6' => '#E67E4A',
                    '$orange-7' => '#B35E39', '$orange-8' => '#804128', '$orange-9' => '#4D2717',
                    '$orange-10' => '#26130B',
                ],
                'Cores Destrutivas' => [
                     '$destructive-1' => '#FAE7E7', '$destructive-2' => '#F5BDBD', '$destructive-3' => '#F09393',
                     '$destructive-4' => '#EB6A6A', '$destructive-5' => '#E64040', '$destructive-6' => '#C82A2A',
                     '$destructive-7' => '#A02222', '$destructive-8' => '#781A1A', '$destructive-9' => '#501111',
                     '$destructive-10' => '#280909',
                ],
                 'Cores Básicas' => [
                    '$white' => '#FFFFFF', '$black' => '#000000',
                ],
                // TODO: Adicionar Fontes, Tamanhos, Raios, etc.
            ];
            // --- Fim Design Tokens ---

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

            <!-- === Início da Seção Design Tokens (com Accordion) === -->
            <h2 style="margin-top: 20px; font-size: 16px; padding-left: 10px;">Design Tokens</h2>
            <div class="storybook-sidebar-accordion design-tokens-accordion" style="padding-left: 10px;">
                <?php 
                $tokenAccordionIdx = 0; // Counter for unique IDs
                foreach ($designTokens as $category => $tokens): 
                    $tokenAccordionId = 'tokens-accordion-'.$tokenAccordionIdx;
                ?>
                    <div class="accordion-group">
                        <button class="accordion-toggle" data-accordion="<?= $tokenAccordionId ?>">
                            <span class="arrow">&#9654;</span>
                            <span style="font-size:13px"><?= htmlspecialchars($category) ?></span>
                        </button>
                        <div class="accordion-panel" id="<?= $tokenAccordionId ?>" style="max-height: 300px; overflow-y: auto;">
                            <ul style="list-style:none; padding-left:18px; margin:0;">
                                <?php foreach ($tokens as $name => $value): ?>
                                    <li style="display: flex; align-items: center; margin-bottom: 6px; font-size: 12px;">
                                        <?php if (strpos($category, 'Cores') !== false && preg_match('/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/', $value)): // Check if it's a color hex value ?>
                                            <span style="display: inline-block; width: 16px; height: 16px; background-color: <?= htmlspecialchars($value) ?>; border: 1px solid <?= ($value === '#FFFFFF' ? '#ccc' : 'transparent') ?>; margin-right: 8px; border-radius: 3px; flex-shrink: 0;"></span>
                                        <?php endif; ?>
                                        <code style="background: #f0f0f0; padding: 1px 4px; border-radius: 3px; color: #5A6272; margin-right: 8px;"><?= htmlspecialchars($name) ?></code>
                                        <span style="color: #808894; word-break: break-all;"><?= htmlspecialchars($value) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php 
                    $tokenAccordionIdx++; // Increment counter
                endforeach; 
                ?>
            </div>
            <!-- === Fim da Seção Design Tokens === -->

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
                <button class="storybook-tab-button" data-tab="code">Code</button>
            </div>
            <div id="tab-panel-canvas" class="storybook-tab-panel active">
                <!-- Conteúdo do Canvas (componente renderizado) virá aqui -->
                <div class="canvas-content-area">
                  <?php echo $content; // Temporariamente colocando o conteúdo antigo aqui ?>
                </div>
                <div class="storybook-controls-panel">
                  <h3>Controls</h3>
                  <?php if(isset($this->clips['controls'])): ?>
                      <?php echo $this->clips['controls']; ?>
                  <?php else: ?>
                      <p>Configurações (props) não disponíveis para esta visualização.</p>
                  <?php endif; ?>
                </div>
            </div>
            <div id="tab-panel-code" class="storybook-tab-panel">
                <!-- Conteúdo da documentação/código virá aqui -->
                <?php if (isset($this->storyCodeSnippet)): // Verifica se a propriedade do controller foi definida ?>
                    <p><strong>Exemplo de Uso (PHP/Yii):</strong></p>
                    <pre><code class="language-php"><?php echo CHtml::encode($this->storyCodeSnippet); // Usa a propriedade do controller ?></code></pre>
                    
                    <p style="margin-top: 20px;"><strong>Estilização (CSS):</strong></p>
                    <p>Para que o componente seja exibido corretamente, certifique-se de que o arquivo CSS compilado esteja incluído na sua página. Neste catálogo, isso é feito incluindo <code>/assets/css/main.css</code> no <code>&lt;head&gt;</code>.</p>
                    <pre><code class="language-html"><?php 
                        // Exemplo de como incluir no <head>
                        $cssIncludeExample = '<link rel="stylesheet" type="text/css" href="' . Yii::app()->baseUrl . '/assets/css/main.css">';
                        echo CHtml::encode($cssIncludeExample);
                    ?></code></pre>

                    <?php /* Para syntax highlighting, você precisaria de uma biblioteca JS como Prism.js ou Highlight.js
                             e garantir que a classe 'language-php' e 'language-html' seja reconhecida por ela.
                             Exemplo básico com Prism.js (requer inclusão dos assets JS/CSS do Prism):
                             <link href="path/to/prism.css" rel="stylesheet" />
                             <script src="path/to/prism.js"></script>
                    */ ?>
                <?php else: ?>
                    <p>Nenhum código de exemplo disponível para esta visualização.</p>
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
