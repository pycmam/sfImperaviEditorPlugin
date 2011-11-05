<?php

/**
 * Виджет редактора Imperavi
 */
class sfWidgetFormImperaviEditor extends sfWidgetFormTextarea
{
    protected function configure($options = array(), $attributes = array())
    {
        parent::configure($options, $attributes);
        $this->addOption('config', array());
    }

    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));

        $config = array_merge($this->getOption('config'), array(
          'image_upload' => url_for('sf_imperavi_uploader_image'),
          'file_upload' => url_for('sf_imperavi_uploader_file'),
          'file_download' => '/uploads/',
          'file_delete' => url_for('sf_imperavi_uploader_file_delete').'?file=',
        ));

        $json = array();
        foreach ($config as $n => $v) {
            $json[] = sprintf("%s: '%s'", $n, $v);
        }

        $script = sprintf('
<script type="text/javascript">
    var %1$s = $("#%1$s").redactor({ %2$s });
</script>
', $this->generateId($name), join(', ', $json));

        return parent::render($name, $value, $attributes, $errors) . $script;
    }

    public function getJavaScripts()
    {
        return array(
            '/sfImperaviEditorPlugin/redactor/redactor.js',
        );
    }

    public function getStylesheets()
    {
        return array(
            '/sfImperaviEditorPlugin/redactor/css/redactor.css' => 'all',
        );
    }
}