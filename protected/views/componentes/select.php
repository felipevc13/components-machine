<div style="display: flex; gap: 32px;">
<div style="flex: 1;">
    <!-- Canvas Content: Renderizar APENAS a história selecionada -->
    <div class="story-wrapper">
        <?php // Renderizar o widget com as props da história selecionada (modificadas pelos controles, se houver) ?>
        <?php $this->widget('SelectWidget', $props); ?>
    </div>

    <?php $this->beginClip('controls'); ?>
    <!-- Controls (Layout tipo Storybook Args) -->
    <form method="get" style="padding: 0; border-radius: 6px;">
        <input type="hidden" name="story" value="<?php echo $storyIndex; ?>">

        <div class="storybook-controls-table"> 
            <!-- Cabeçalho da Tabela -->
            <div class="storybook-control-row storybook-controls-header"> 
                <div class="storybook-control-name">Nome</div>
                <div class="storybook-control-input">Control</div>
            </div>

            <?php // Controle de placeholder apenas para a história Padrão (índice 0) ?>
            <?php if ($storyIndex === 0 && isset($props['placeholder'])): ?>
                <div class="storybook-control-row">
                    <div class="storybook-control-name">
                        <label for="prop-placeholder">placeholder</label>
                    </div>
                    <div class="storybook-control-input">
                        <input type="text" id="prop-placeholder" name="placeholder" 
                               value="<?php echo CHtml::encode($props['placeholder']); ?>">
                    </div>
                </div>
                <div class="storybook-control-row">
                    <div class="storybook-control-name">
                        <label for="prop-fullwidth">fullwidth</label>
                    </div>
                    <div class="storybook-control-input">
                        <input type="checkbox" id="prop-fullwidth" name="fullwidth" value="1" <?php echo !empty($props['fullwidth']) ? 'checked' : ''; ?>>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </form>
    <script>
    // Atualização automática do select ao digitar (debounce)
    (function() {
        var input = document.getElementById('prop-placeholder');
var checkbox = document.getElementById('prop-fullwidth');
if (!input && !checkbox) return;
var timer;
if (input) {
    input.addEventListener('input', function() {
        clearTimeout(timer);
        timer = setTimeout(updateUrl, 400);
    });
}
if (checkbox) {
    checkbox.addEventListener('change', function() {
        updateUrl();
    });
}
function updateUrl() {
    var url = new URL(window.location.href);
    if (input) url.searchParams.set('placeholder', input.value);
    if (checkbox) {
        if (checkbox.checked) {
            url.searchParams.set('fullwidth', '1');
        } else {
            url.searchParams.delete('fullwidth');
        }
    }
    // Manter o parâmetro story
    var story = document.querySelector('input[name="story"]');
    if (story) url.searchParams.set('story', story.value);
    window.location.href = url.toString();
}
    })();
    </script>

    <?php $this->endClip(); ?>
</div>
</div>
