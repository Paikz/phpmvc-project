<?php

namespace phes15\Answers;

class AnswersController implements \Anax\DI\IInjectionAware
{
  use \Anax\DI\TInjectable;

  public function initialize()
	{
    $this->answers = new \phes15\Answers\Answer();
    $this->answers->setDI($this->di);

    $this->user = new \phes15\Users\User();
    $this->user->setDI($this->di);
	}

	public function viewAction($idQuestion = null, $redirect = '', $authorId)
	{

		$answers  = $this->answers->findAll($idQuestion);

    foreach ($answers as $answer)
    {
      $user = $this->user->getUserById($answer->getProperties()['userId']);

      $this->views->add('answers/answer', [
        'answer'	 => $answer,
        'user'		 => $user,
        'idQuestion' => $idQuestion,
        'authorId'	 => $authorId,
      ], 'main');

			$this->dispatcher->forward([
				'controller' => 'comments',
				'action'	 => 'view',
				'params'	 => [$answer->getProperties()['id'], 'answer', $redirect],
			]);

   }

		if ($this->user->isLoggedIn()) {
			$form = new \phes15\HTMLForm\CFormAnswerAdd($idQuestion, $redirect);
			$form->setDI($this->di);
			$status = $form->check();
			$this->views->add('default/page2', [
				'content' 	=> $form->getHTML(),
			], 'main');
		}
	}

	public function deleteAction($id = null, $idUser = null)
	{
		if (!isset($id)) {
			die("Missing id");
		}
		if ($this->user->isLoggedIn() && $this->user->matchingId($idUser)) {
      $this->answers->deleteAllComments($id, 'kmom10_');
			$res = $this->answers->delete($id);
			$this->response->redirect($this->request->getServer('HTTP_REFERER'));
		}
    else
    {
      $this->di->views->add('default/page', [
          'title' => "Access Denied",
          'content' => "Ajabaja"
      ]);
		}
	}

	public function setupAction()
	{
		$this->answers->setup();
	}

}
