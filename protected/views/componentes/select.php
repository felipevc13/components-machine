<?php
/* @var $this ComponentesController */
$this->pageTitle = 'Componentes - Select';
?>


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

            <?php // Controles comuns que podem ser modificados em qualquer história ?>
            <?php if (isset($props['placeholder'])): // Mostrar se a prop placeholder existir ?>
                <div class="storybook-control-row">
                    <div class="storybook-control-name">
                        <label for="prop-placeholder">placeholder</label>
                    </div>
                    <div class="storybook-control-input">
                        <input type="text" id="prop-placeholder" name="placeholder" 
                               value="<?php echo CHtml::encode($props['placeholder']); ?>">
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($props['fullwidth'])): // Mostrar se a prop fullwidth existir ?>
                <div class="storybook-control-row">
                    <div class="storybook-control-name">
                        <label for="prop-fullwidth">fullwidth</label>
                    </div>
                    <div class="storybook-control-input">
                        <input type="checkbox" id="prop-fullwidth" name="fullwidth" value="1" <?php echo !empty($props['fullwidth']) ? 'checked' : ''; ?>>
                    </div>
                </div>
            <?php endif; ?>

            <?php // Controle para errorMessage, visível apenas na história "Com Erro" (onde error=true) ?>
            <?php if (!empty($props['error']) && isset($props['errorMessage'])): ?>
                <div class="storybook-control-row">
                    <div class="storybook-control-name">
                        <label for="prop-errorMessage">errorMessage</label>
                    </div>
                    <div class="storybook-control-input">
                        <input type="text" id="prop-errorMessage" name="errorMessage"
                               value="<?php echo CHtml::encode($props['errorMessage']); ?>">
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div style="padding: 18px 24px;">
            <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Aplicar</button>
        </div>
    </form>
    
    <?php $this->endClip(); ?>
</div>
</div>
