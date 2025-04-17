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
             <?php /* Adicionar outros controles aqui no futuro */ ?>
            <?php endif; ?>
        </div>

    </form>
    <script>
    // Atualização automática do select ao digitar (debounce)
    (function() {
        var input = document.getElementById('prop-placeholder');
        if (!input) return;
        var timer;
        input.addEventListener('input', function() {
            clearTimeout(timer);
            timer = setTimeout(function() {
                var url = new URL(window.location.href);
                url.searchParams.set('placeholder', input.value);
                // Manter o parâmetro story
                var story = document.querySelector('input[name="story"]');
                if (story) url.searchParams.set('story', story.value);
                window.location.href = url.toString();
            }, 400); // 400ms debounce
        });
    })();
    </script>

    <?php $this->endClip(); ?>
</div>
</div>
