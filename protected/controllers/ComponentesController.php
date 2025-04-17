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
        $storyIndex = isset($_GET['story']) ? intval($_GET['story']) : 0;
        if (!isset($selectStories[$storyIndex])) $storyIndex = 0;
        $story = $selectStories[$storyIndex];
        $props = $story['props'];
        // Sobrescrever props se enviados via GET
        if (isset($_GET['name'])) {
            $props['name'] = $_GET['name'];
        }
        if (isset($_GET['selected'])) {
            $props['selected'] = strpos($_GET['selected'], ',') !== false ? explode(',', $_GET['selected']) : $_GET['selected'];
        }
        $props['disabled'] = !empty($_GET['disabled']);
        $props['multiple'] = !empty($_GET['multiple']);
        $this->render('select', array(
            'props' => $props,
            'stories' => $selectStories,
            'storyIndex' => $storyIndex,
        ));
    }
}
