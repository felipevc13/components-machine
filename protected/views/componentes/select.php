<div style="display: flex; gap: 32px;">
<div style="flex: 1;">
    <!-- Preview do componente -->
    <div style="padding: 24px 0 16px 0; border-bottom: 1px solid #eee; margin-bottom: 24px;">
        <?php $this->widget('SelectWidget', $props); ?>
    </div>
    <!-- Controls -->
    <form method="get" style="background: #f7f8fa; padding: 18px 24px; border-radius: 6px;">
        <input type="hidden" name="story" value="<?php echo $storyIndex; ?>">
        <div style="display: flex; gap: 24px; flex-wrap: wrap;">
            <div>
                <label>name<br>
                    <input type="text" name="name" value="<?php echo CHtml::encode($props['name']); ?>">
                </label>
            </div>
            <div>
                <label>selected<br>
                    <input type="text" name="selected" value="<?php echo is_array($props['selected']) ? implode(',', $props['selected']) : $props['selected']; ?>">
                    <small style="color: #888">(para múltiplos, separar por vírgula)</small>
                </label>
            </div>
            <div>
                <label>disabled<br>
                    <input type="checkbox" name="disabled" value="1" <?php if (!empty($props['disabled'])) echo 'checked'; ?>>
                </label>
            </div>
            <div>
                <label>multiple<br>
                    <input type="checkbox" name="multiple" value="1" <?php if (!empty($props['multiple'])) echo 'checked'; ?>>
                </label>
            </div>
        </div>
        <button type="submit" style="margin-top: 16px; background: #ff4785; color: #fff; border: none; padding: 8px 22px; border-radius: 4px; font-size: 1rem; cursor: pointer;">Atualizar</button>
    </form>
    <div style="margin-top: 28px;">
        <h4 style="color: #888; font-size: 1rem;">Props disponíveis</h4>
        <ul>
            <li><strong>name</strong>: Nome do campo select</li>
            <li><strong>options</strong>: Array associativo de opções (valor =&gt; label)</li>
            <li><strong>selected</strong>: Valor selecionado (string ou array)</li>
            <li><strong>disabled</strong>: true/false</li>
            <li><strong>multiple</strong>: true/false</li>
        </ul>
    </div>
</div>

</div>

