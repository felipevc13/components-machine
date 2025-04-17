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
            padding: 40px 48px;
            max-width: 900px;
            margin: 0 auto;
        }
        .storybook-sidebar .history-item:hover {
            background: #ececec;
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
                    echo '<li class="history-item" data-href="'.$href.'" style="font-size:13px; padding:4px 12px 4px 34px; border-radius:4px; cursor:pointer;">'.htmlspecialchars($story['title']).'</li>';
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
            </ul>
        </nav>
        <main class="storybook-content">
            <?php echo $content; ?>
        </main>
    </div>
</body>
</html>
