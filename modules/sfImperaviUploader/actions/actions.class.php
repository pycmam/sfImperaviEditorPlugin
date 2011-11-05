<?php

/**
 * Загрузчик файлов
 */
class sfImperaviUploaderActions extends sfActions
{
    /**
     * PreExecute
     */
    public function preExecute()
    {
        sfConfig::set('sf_web_debug', false);
    }

    /**
     * Загрузка файлов
     */
    public function executeUploadFile(sfWebRequest $request)
    {
        if ($file = $this->processForm(new sfImperaviUploaderForm(), $request, false)) {
            return $this->renderPartial('file', array('file' => $file));
        }
        return sfView::HEADER_ONLY;
    }

    /**
     * Удаление файла
     */
    public function executeDeleteFile(sfWebRequest $request)
    {
        $file = str_replace('..', '', $request->getParameter('file'));
        $path = sfConfig::get('sf_upload_dir'). '/' .$file;
        if (file_exists($path)) {
          @unlink($path);
        }
        return sfView::HEADER_ONLY;
    }

    /**
     * Загрузка картинок
     */
    public function executeUploadImage(sfWebRequest $request)
    {
        if ($file = $this->processForm(new sfImperaviUploaderImageForm(), $request)) {
            return $this->renderText('/uploads/'. basename($file->getSavedName()));
        }
        return sfView::NONE;
    }

    /**
     * Обработка загруженной формы
     */
    protected function processForm(sfImperaviUploaderForm $form, sfWebRequest $request, $uniqueFilename = true)
    {
        $form->bind(array(), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $file = $form->getValue('file');
            if (! preg_match('/\.(php|phtml|php\d+)$/si', $file->getOriginalName())) {
                $filename = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR;

                if ($uniqueFilename) {
                    $filename .= md5($file->getOriginalName() . mt_rand(1, 9999))
                    . '.' . substr($file->getOriginalExtension(), 1);
                } else {
                    $filename .= $file->getOriginalName();
                }

                if ($file->save($filename)) {
                    return $file;
                }
            }
        }
        return false;
    }
}