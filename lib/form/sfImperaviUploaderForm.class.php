<?php

/**
 * Форма загрузки файлов из редактора
 */
class sfImperaviUploaderForm extends BaseForm
{
    public function setup()
    {
        $this->widgetSchema['file'] = new sfWidgetFormInputFile();
        $this->validatorSchema['file'] = new sfValidatorFile(array(
            'path' => sfConfig::get('sf_upload_dir'),
        ));

        $this->disableLocalCSRFProtection();
        $this->widgetSchema->setNameFormat('imperavi_uploader[%s]');
    }
}