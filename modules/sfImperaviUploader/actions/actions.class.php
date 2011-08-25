<?php

/**
 * Загрузчик файлов
 */
class sfImperaviUploaderActions extends sfActions
{
    /**
     * Загрузка файлов
     */
    public function executeUploadFile(sfWebRequest $request)
    {
        if ($file = $this->processForm(new sfImperaviUploaderForm(), $request)) {
            return $this->renderPartial('file', array('file' => $file));
        }
        return sfView::NONE;
    }

    /**
     * Загрузка картинок
     */
    public function executeUploadImage(sfWebRequest $request)
    {
        if ($file = $this->processForm(new sfImperaviUploaderImageForm(), $request)) {
            return $this->renderText('/uploads/'.$file->getOriginalName());
        }
        return sfView::NONE;
    }

    /**
     * Обработка загруженной формы
     */
    protected function processForm(sfImperaviUploaderForm $form, sfWebRequest $request)
    {
        $form->bind(array(), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $file = $form->getValue('file');
            if (! preg_match('/\.(php|phtml|php\d+)$/si', $file->getOriginalName())) {
                $filename = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . $file->getOriginalName();
                if ($file->save($filename)) {
                    return $file;
                }
            }
        }
        return false;
    }
}