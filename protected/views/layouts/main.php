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
    <!-- Prism.js para syntax highlight -->
    <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism-tomorrow.min.css" rel="stylesheet" />
    <!-- Prism.js syntax highlight (tema escuro) -->
    <link href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
    <style>
      /* Garante contraste forte para blocos de código */
      pre[class*="language-"], code[class*="language-"] {
        background: #2d2d2d !important;
        color: #f8f8f2 !important;
        font-size: 1em;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-markup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-scss.min.js"></script>
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
                'Fontes' => [
                    '$font-family-primary' => "'Source Sans Pro', sans-serif",
                ],
                'Tamanhos de Fonte' => [
                    '$font-size-heading-xlg' => '40px',
                    '$font-size-heading-xxl' => '36px',
                    '$font-size-heading-lg' => '32px',
                    '$font-size-heading-md' => '28px',
                    '$font-size-heading-sm' => '24px',
                    '$font-size-heading-xsm' => '20px',
                    '$font-size-body-lg' => '18px',
                    '$font-size-body-md' => '16px',
                    '$font-size-caption-md' => '14px',
                    '$font-size-caption-sm' => '12px',
                ],
                'Alturas de Linha' => [
                    '$line-height-heading-xlg' => '48px',
                    '$line-height-heading-xxl' => '44px',
                    '$line-height-heading-lg' => '40px',
                    '$line-height-heading-md' => '36px',
                    '$line-height-heading-sm' => '32px',
                    '$line-height-heading-xsm' => '28px',
                    '$line-height-body-lg' => '28px',
                    '$line-height-body-md' => '24px',
                    '$line-height-caption-md' => '20px',
                    '$line-height-caption-sm' => '18px',
                ],
                'Raios de Borda' => [
                    '$radius-sm' => '4px',
                    '$radius-md' => '8px',
                    '$radius-lg' => '16px',
                    '$radius-xlg' => '30px',
                    '$radius-full' => '55555px',
                ],
                'Estados' => [
                    '$state-focus' => 'rgba(0, 0, 0, 0.5)',
                    '$state-pressed' => 'rgba(0, 0, 0, 0.12)',
                    '$state-hover' => 'rgba(0, 0, 0, 0.04)',
                    '$state-hover-light' => 'rgba(0, 0, 0, 0.02)',
                    '$state-disabled-bg' => '#E6E6E6',
                    '$state-disabled-fg' => '#7E8692',
                    '$state-hover-dark' => 'rgba(255, 255, 255, 0.16)',
                    '$state-pressed-dark' => 'rgba(255, 255, 255, 0.08)',
                    '$state-focus-dark' => 'rgba(255, 255, 255, 0.5)',
                    '$state-shadow' => 'rgba(0, 0, 0, 0.16)',
                    '$state-hover-strong' => 'rgba(0, 0, 0, 0.08)',
                    '$state-hover-menu-dark' => 'rgba(255, 255, 255, 0.7)',
                    '$state-active' => '#0075FF',
                ],
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
            <?php /* Temporarily commented out Design Tokens section
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
            */ ?>

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
    
            <!-- New controls for Canvas size -->
            <div class="canvas-size-controls" style="padding: 10px; background: #ffffff; display: flex; align-items: center; gap: 10px; align-self: center;">
                <label for="canvas-width-select">Width:</label>
                <select id="canvas-width-select" style="padding: 4px;">
                    <option value="">Responsive</option> <!-- Option to clear specific width -->
                    <option value="768px">Tablet (768px)</option> <!-- Intermediate value -->
                    <option value="320px">Mobile (320px)</option>
                </select>
                <button id="apply-canvas-size" style="padding: 4px 10px;">Apply</button>
                <!-- Keeping Reset button for consistency, though "Responsive" option also resets -->
                <button id="reset-canvas-size" style="padding: 4px 10px;">Reset</button>
            </div>
            <div id="tab-panel-canvas" class="storybook-tab-panel active">
                <!-- Conteúdo do Canvas (componente renderizado) virá aqui -->
                <!-- Conteúdo do Canvas (componente renderizado) virá aqui -->
                <div class="canvas-container" style="background: #f0f0f0; padding: 20px; display: flex; justify-content: center; flex-grow: 1;">
                    <div class="canvas-content-area">
                      <?php echo $content; // Temporariamente colocando o conteúdo antigo aqui ?>
                    </div>
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

                    <!-- === INÍCIO DO GUIA PASSO A PASSO === -->
                    <h4 style="margin-top: 2rem; margin-bottom: 1rem;">Como Utilizar o Componente em seu Projeto Yii 1.13</h4>

                    <ol style="padding-left: 20px; line-height: 1.6;">
                        <li style="margin-bottom: 1rem;">
                            <strong>Pré-requisitos:</strong>
                            <ul style="margin-top: 0.5rem; padding-left: 20px;">
                                <li>Certifique-se de que seu projeto está configurado corretamente com o framework Yii 1.13.</li>
                                <li>Verifique se o arquivo da classe do componente (ex: <code>Select.php</code>) está localizado em um diretório acessível pela sua aplicação Yii, como <code>protected/components/</code>. O nome exato do arquivo e diretório pode variar.</li>
                            </ul>
                        </li>

                        <li style="margin-bottom: 1rem;">
                            <strong>Uso na View (.php):</strong>
                            <p style="margin-top: 0.5rem;">Para renderizar o componente em sua view (arquivo <code>.php</code>), utilize o método <code>widget()</code> disponível no contexto do controller ou da view. Você precisará fornecer o <em>alias</em> do caminho para a classe do componente e um array com as propriedades (<code>props</code>) desejadas.</p>
                        </li>

                        <!-- Removed redundant hardcoded example block -->
                    </ol>
                    <!-- === FIM DO GUIA PASSO A PASSO === -->

                    <p style="margin-top: 20px;"><strong>Estilização e Customização (CSS):</strong></p>
                    <p>Para que o componente seja exibido corretamente, certifique-se de que o arquivo CSS compilado esteja incluído na sua página. Neste catálogo, isso é feito incluindo <code>/assets/css/main.css</code> no <code>&lt;head&gt;</code>:</p>
                    <pre><code class="language-html">&lt;link rel="stylesheet" type="text/css" href="/assets/css/main.css"&gt;</code></pre>
                             <script src="path/to/prism.js"></script>
                <?php else: ?>
                    <p>Nenhum código de exemplo disponível para esta visualização.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // --- Tab Switching Logic ---
            const tabButtons = document.querySelectorAll('.storybook-tab-button');
            const tabPanels = document.querySelectorAll('.storybook-tab-panel');
            const canvasSizeControls = document.querySelector('.canvas-size-controls'); // Moved declaration here

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetTab = button.getAttribute('data-tab');
                    const targetPanel = document.getElementById(`tab-panel-${targetTab}`);

                    // Remove 'active' from all buttons and panels
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabPanels.forEach(panel => panel.classList.remove('active'));

                    // Add 'active' to the clicked button and corresponding panel
                    button.classList.add('active');
                    if (targetPanel) {
                        targetPanel.classList.add('active');
                    }

                    // Show/hide canvas controls based on the active tab
                    if (canvasSizeControls) {
                        if (targetTab === 'canvas') {
                            canvasSizeControls.style.display = 'flex';
                            // Re-trigger load from storage when switching TO canvas tab
                            loadCanvasSizeFromStorage();
                        } else {
                            canvasSizeControls.style.display = 'none';
                        }
                    }

                    // Force Prism re-highlight if the code tab is activated
                    if (targetTab === 'code') {
                        setTimeout(() => { Prism.highlightAll(); }, 0);
                    }
                });
            });

            // --- Canvas Size Control Logic ---
            const localStorageKey = 'canvasWidth';
            const canvasWidthSelect = document.getElementById('canvas-width-select');
            const applySizeButton = document.getElementById('apply-canvas-size');
            const resetSizeButton = document.getElementById('reset-canvas-size');
            const canvasContentArea = document.querySelector('#tab-panel-canvas .canvas-content-area');
            const canvasTabPanel = document.getElementById('tab-panel-canvas'); // Keep reference

            const applyCanvasSizeFromSelect = () => {
                // Ensure elements exist before proceeding
                if (!canvasWidthSelect || !canvasContentArea) return;

                const width = canvasWidthSelect.value;
                if (width) {
                    canvasContentArea.style.width = width;
                    canvasContentArea.style.flex = '0 0 auto';
                } else {
                    canvasContentArea.style.width = '';
                    canvasContentArea.style.flex = '1';
                }
                localStorage.setItem(localStorageKey, width);
            };

            const loadCanvasSizeFromStorage = () => {
                // Ensure elements exist before proceeding
                if (!canvasWidthSelect || !canvasContentArea) return;

                const savedWidth = localStorage.getItem(localStorageKey);
                if (savedWidth !== null) {
                    canvasWidthSelect.value = savedWidth;
                } else {
                    canvasWidthSelect.value = ''; // Default to Responsive if nothing saved
                }
                // Apply the loaded (or default) size
                applyCanvasSizeFromSelect();
            };

            // Attach event listeners only if elements exist
            if (canvasWidthSelect && applySizeButton && resetSizeButton && canvasContentArea && canvasTabPanel) {
                applySizeButton.addEventListener('click', applyCanvasSizeFromSelect);

                resetSizeButton.addEventListener('click', () => {
                    if (!canvasContentArea || !canvasWidthSelect) return; // Guard clause
                    canvasContentArea.style.width = '';
                    canvasContentArea.style.flex = '1';
                    canvasWidthSelect.value = '';
                    localStorage.removeItem(localStorageKey);
                });

                // Initial setup on page load
                // Check if canvas tab is initially active
                if (canvasTabPanel && canvasTabPanel.classList.contains('active')) {
                    if (canvasSizeControls) canvasSizeControls.style.display = 'flex';
                    loadCanvasSizeFromStorage(); // Load saved size on initial load
                } else {
                     if (canvasSizeControls) canvasSizeControls.style.display = 'none'; // Hide if not active initially
                }
            } else {
                console.error("Canvas control elements not found. Resizing will not work.");
            }
        }); // End of DOMContentLoaded listener
    </script>
    <!-- Prism.js scripts are already included in the <head> -->
</body>
</html>

