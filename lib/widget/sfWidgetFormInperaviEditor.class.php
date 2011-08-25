<?php

/**
 * Виджет редактора Imperavi
 */
class sfWidgetFormImperaviEditor extends sfWidgetFormTextarea
{
    protected function configure($options = array(), $attributes = array())
    {
        parent::configure($options, $attributes);
    }

    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $script = sprintf('
<script type="text/javascript">
    $("#%s").redactor();
</script>
', $this->generateId($name));

        return parent::render($name, $value, $attributes, $errors) . $script;
    }

    public function getJavaScripts()
    {
        return array(
            '/sfImperaviEditorPlugin/js/redactor.js',
        );
    }

    public function getStylesheets()
    {
        return array(
            '/sfImperaviEditorPlugin/css/redactor.css' => 'all',
        );
    }
}