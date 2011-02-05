<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opToriYachoPicturePlugin actions.
 *
 * @package    OpenPNE
 * @subpackage opToriYachoPicturePlugin
 * @author     uzura8 <<uzuranoie@gmail.com>
 */
class opToriYachoPicturePluginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new opToriYachoPicturePluginConfigurationForm();

    if ($request->isMethod(sfWebRequest::POST))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash('notice', 'Saved configuration successfully.');
        $this->redirect('opToriYachoPicturePlugin/index');
      }
    }

    return sfView::SUCCESS;
  }
}
