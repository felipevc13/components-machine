<?php
class SelectWidget extends CWidget
{
    public $name = 'select';
    public $options = array();
    public $selected = '';
    public $disabled = false;
    public $multiple = false;
    public $placeholder = null; // Nova propriedade
    public $fullwidth = false; // Nova propriedade
    public $error = false; // Add error property
    public $errorMessage = null; // Add errorMessage property
    public $icon = null; // Nova propriedade para o ícone

    public function run()
    {
        $attrs = 'name="'.CHtml::encode($this->name).'" class="select-component"';
        if ($this->disabled) $attrs .= ' disabled';
        if ($this->multiple) $attrs .= ' multiple';
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

        echo '<select ' . $attrs . '>';

        // Adicionar a option de placeholder se definida
        if ($this->placeholder !== null) {
            $placeholderSelected = empty($this->selected) ? ' selected' : '';
            // A option do placeholder deve ter valor vazio e ser disabled
            echo '<option value="" disabled'.$placeholderSelected.'>'.CHtml::encode($this->placeholder).'</option>';
        }

        // Renderizar as opções normais
        foreach ($this->options as $value => $label) {
            // Não renderizar a opção se o valor dela for vazio (para evitar duplicar o placeholder se ele vier nas opções)
            if ($value === '') continue;
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
