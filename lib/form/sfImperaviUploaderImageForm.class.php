<?php

/**
 * Форма загрузки картинок из редактора
 */
class sfImperaviUploaderImageForm extends sfImperaviUploaderForm
{
    public function configure()
    {
        $this->validatorSchema['file']->setOption('mime_types', 'web_images');
    }
}