<?php
class SelectWidget extends CWidget
{
    public $name = 'select';
    public $options = array();
    public $selected = '';
    public $disabled = false;
    public $multiple = false;

    public function run()
    {
        $attrs = 'name="'.CHtml::encode($this->name).'" class="select-component"';
        if ($this->disabled) $attrs .= ' disabled';
        if ($this->multiple) $attrs .= ' multiple';
        $selectedValues = is_array($this->selected) ? $this->selected : [$this->selected];
        echo '<select ' . $attrs . '>';
        foreach ($this->options as $value => $label) {
            $sel = in_array($value, $selectedValues) ? ' selected' : '';
            echo '<option value="'.CHtml::encode($value).'"'.$sel.'>'.CHtml::encode($label).'</option>';
        }
        echo '</select>';
    }
}
