<?php

namespace phes15\Comments;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function initialize()
    {
        $this->comments = new \phes15\Comments\Comment();
        $this->comments->setDI($this->di);

        $this->users = new \phes15\Users\User();
        $this->users->setDI($this->di);

    }

  	public function viewAction($key = null, $type = null, $redirect = '')
  	{
  		$comments = $this->comments->findAll($key, $type);
  		$user = $this->users;

  		$form = null;
  		if ($user->isLoggedIn() && $this->di->request->getGet('comment-reply') != null) {
  			$commentId   = $this->di->request->getGet('comment-reply');
  			$commentType = $this->di->request->getGet('type');

  			if ($key == $commentId && $type == $commentType) {
  				$form = new \phes15\HTMLForm\CFormCommentAdd($commentId, $commentType, $redirect);
  				$form->setDI($this->di);
  				$status = $form->check();
  				$form = $form->getHTML();
  			}
  		}
  		$this->views->add('comment/comments', [
  			'comments' 		=> $comments,
  			'questionId'	=> $key,
  			'type'			=> $type,
  			'user'			=> $user,
  			'form'			=> $form,
  		], 'main');
  }

	public function deleteAction($id = null, $userId = null)
	{
		if (!isset($id)) {
			die("Missing id");
		}
    if($this->users->isLoggedIn() && $this->users->matchingId($userId))
    {
      $res = $this->comments->delete($id);
      $this->response->redirect($this->request->getServer('HTTP_REFERER'));
    }
		else {
      $this->di->views->add('default/page', [
          'title' => "Access Denied",
          'content' => "Ajabaja"
      ]);
		}


	}

	public function setupAction()
	{
		$this->comments->setup();
	}

}
