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

    public function run()
    {
        $attrs = 'name="'.CHtml::encode($this->name).'" class="select-component"';
        if ($this->disabled) $attrs .= ' disabled';
        if ($this->multiple) $attrs .= ' multiple';
        $selectedValues = is_array($this->selected) ? $this->selected : [$this->selected];

        $wrapperClass = 'select-widget-wrapper';
        if (!empty($this->fullwidth)) $wrapperClass .= ' fullwidth';
        echo '<div class="' . $wrapperClass . '">';
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
        echo '</div>';
    }
}
