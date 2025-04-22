<?php
class SelectWidget extends CWidget
{
    public $name = 'select';
    public $options = array();
    public $selected = '';
    public $disabled = false;
    public $placeholder = null; // Nova propriedade
    public $fullwidth = false; // Nova propriedade
    public $error = false; // Add error property
    public $errorMessage = null; // Add errorMessage property
    public $icon = null; // Nova propriedade para o ícone

    public function run()
    {
        $selectedValues = is_array($this->selected) ? $this->selected : [$this->selected];

        $wrapperClass = 'select-widget-wrapper'; // Classe base
        if ($this->fullwidth) {
            $wrapperClass .= ' fullwidth';
        }
        if ($this->error) { // Add error class if true
            $wrapperClass .= ' error';
        }
        if ($this->icon) { // Add icon class if true
            $wrapperClass .= ' has-icon';
        }

        echo CHtml::openTag('div', ['class' => $wrapperClass]);


        // Criar array de atributos para o select
        $selectOptions = [
            'name' => CHtml::encode($this->name),
            'class' => 'select-component', // Adiciona a classe aqui
        ];
        if ($this->disabled) {
            $selectOptions['disabled'] = 'disabled'; // Adiciona o atributo disabled se necessário
        }

        // Passar $selectOptions como segundo argumento
        echo CHtml::openTag('select', $selectOptions); 

        // Add placeholder option if defined and not multiple select
        if ($this->placeholder !== null) {
            echo '<option value="" disabled' . (empty($this->selected) ? ' selected' : '') . '>'.CHtml::encode($this->placeholder).'</option>';
        }
        foreach($this->options as $value => $label) {
            // Skip empty value option if placeholder is used
            if ($this->placeholder !== null && $value === '') continue;
            $sel = in_array((string)$value, $selectedValues, true) ? ' selected' : '';
            echo '<option value="'.CHtml::encode($value).'"'.$sel.'>'.CHtml::encode($label).'</option>';
        }
        echo '</select>';

        // Render error message if applicable
        if ($this->error && !empty($this->errorMessage)) {
            echo '<div class="select-error-message">' . CHtml::encode($this->errorMessage) . '</div>';
        }

        echo CHtml::closeTag('div');
    }
}
