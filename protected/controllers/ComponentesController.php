<?php
class ComponentesController extends CController
{
    public $storyCodeSnippet = null; // Propriedade para armazenar o snippet de código

    public function actionIndex()
    {
        // Redirect to the first story of the first component (currently hardcoded to Select, story 0)
        // TODO: Make this dynamic if more component types are added.
        $defaultComponentAction = 'select'; // Assuming 'select' is the action for the first component
        $defaultStoryIndex = 0;
        $this->redirect($this->createUrl($defaultComponentAction, ['story' => $defaultStoryIndex]));
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

        // Gerar o snippet de código de USO para a aba "Code"
        $widgetName = 'SelectWidget'; // Assumindo que é sempre SelectWidget para esta action
        $propsString = var_export($props, true); // Exporta o array $props como string PHP válida
        // Limpar um pouco a saída de var_export para melhor legibilidade
        $propsString = str_replace("\n", "\n        ", $propsString); // Indenta as linhas
        $propsString = str_replace("array (", "[", $propsString); // Usa sintaxe curta de array
        $propsString = preg_replace('/\)$/', ']', $propsString); // Usa sintaxe curta de array (fim)
        $propsString = preg_replace('/=>\s*\[/', '=> [', $propsString); // Ajusta espaço após => para arrays aninhados
        // Remove chaves numéricas de arrays sequenciais se não forem associativos
        // Correção: verificar se as chaves NÃO são um range sequencial para manter associativos
        if (!(array_keys($props) === range(0, count($props) - 1))) {
             // Mantém as chaves numéricas se for explicitamente associativo (ex: 'options' => [0 => ..., 1 => ...])
             // Mas remove chaves numéricas se for sequencial (ex: 'selected' => [0 => 'val1']) - var_export já faz isso bem
             // Para simplificar, vamos confiar mais no var_export e focar na limpeza estética e booleanos.
             // $propsString = preg_replace('/\d+\s*=>\s*/', '', $propsString); // Remover esta linha pode ser mais seguro
        }
        
        // Trata booleanos corretamente na string exportada
        $propsString = str_replace("'1'", 'true', $propsString); // Corrige boolean true exportado como string '1'
        $propsString = str_replace("'0'", 'false', $propsString); // Corrige boolean false exportado como string '0'
        $propsString = str_replace("''", 'false', $propsString); // Corrige boolean false (vazio) exportado como string ''

        $this->storyCodeSnippet = "<?php \$this->widget('{$widgetName}', {$propsString}); ?>"; // Atribui à propriedade

        $this->render('select', [
            'props' => $props,
            'stories' => $selectStories,
            'storyIndex' => $storyIndex,
        ]);
    }
}
