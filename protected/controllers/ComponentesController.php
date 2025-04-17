<?php
class ComponentesController extends CController
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSelect()
    {
        $stories = require(dirname(__FILE__).'/../data/stories.php');
        $selectStories = $stories['Select'];

        // Determinar a história selecionada
        $storyIndex = isset($_GET['story']) ? intval($_GET['story']) : 0;
        // Garantir que o índice é válido
        if (!isset($selectStories[$storyIndex])) {
            $storyIndex = 0;
        }
        $story = $selectStories[$storyIndex];
        $props = $story['props'];

        // Sobrescrever props com parâmetros GET, se existirem
        foreach ($_GET as $key => $value) {
            if ($key !== 'story' && isset($props[$key])) {
                if (is_bool($props[$key])) {
                    $props[$key] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                } elseif (is_array($props[$key])) {
                    // Simplificação: Assume array de strings separados por vírgula para 'selected' múltiplo
                    $props[$key] = explode(',', $value);
                } else {
                    $props[$key] = $value;
                }
            }
        }

        $this->render('select', [
            'props' => $props,
            'stories' => $selectStories,
            'storyIndex' => $storyIndex,
        ]);
    }
}
