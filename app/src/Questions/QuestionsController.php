<?php
namespace phes15\Questions;

class QuestionsController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    private $checked;
    public function initialize()
    {
        $this->questions = new \phes15\Questions\Question();
        $this->questions->setDI($this->di);

        $this->user = new \phes15\Users\User();
        $this->user->setDI($this->di);

        $this->tags = new \phes15\Tags\Tag();
    		$this->tags->setDI($this->di);

        $this->questiontags = new \phes15\QuestionTags\QuestionTag();
    		$this->questiontags->setDI($this->di);

        $this->answers = new \phes15\Answers\Answer();
        $this->answers->setDI($this->di);
    }

    public function indexAction()
    {
      $questions = $this->questions->findAll();
      $this->theme->setTitle("Questions");

      $this->views->add('questions/viewAll', [
        'title'       => "Questions",
        'questions'		=> $questions,
        'user'        => $this->user],
        'main');

      $this->views->add('questions/add', [], 'sidebar');
    }

    public function viewAction($slug = null)
    {
        $this->initialize();

        $question = $this->questions->findBySlug($slug);
        $user = $this->user->find($question->getProperties()['userId']);
        $title = "Could not find question";
        if($question) {
          $title = $question->getProperties()['title'];
        }

        $this->theme->setTitle($title);

        $this->views->add('questions/view', [
        'title'     => $title,
  			'question'  => $question,
  			'user'	  	=> $user,
  		  ], 'main');

        $this->dispatcher->forward([
  			'controller' => 'questiontags',
  			'action'	 => 'view',
  			'params'	 => [$question->getProperties()['id']]
  		  ]);

        $redirect = $this->url->create('Questions/view/' . $slug);

        $this->dispatcher->forward([
  			'controller' => 'comments',
  			'action'	 => 'view',
  			'params'	 => [$question->getProperties()['id'], 'question', $redirect],
  		  ]);

        $this->dispatcher->forward([
  			'controller' => 'answers',
  			'action'	 => 'view',
  			'params'	 => [$question->getProperties()['id'], $redirect, $question->getProperties()['userId']],
  		  ]);
    }

    public function addAction()
    {
        $tags = $this->tags->findAll();
        $tagArray = [];
    		foreach ($tags as $tag)
        {
    			$tagArray[] = $tag->getProperties()['name'];
    		}

        if($this->user->isLoggedIn())
        {
            $form = $this->di->form->create([],  [
      			'title' => [
          				'type'			=> 'text',
          				'label'			=> 'Title:',
        				'required'		=> true,
        				'validation'	=> ['not_empty'],
      			],
      			'content' => [
          				'type'			=> 'textarea',
          				'label'			=> 'Question:',
        				'required'		=> true,
        				'validation'	=> ['not_empty'],
      			],
            'tags' => [
                'type'        => 'checkbox-multiple',
                'values'      => $tagArray,
                'checked'     => [],
            ],
      			'submit' => [
          				'type'			=> 'submit',
          				'callback'	=> [$this, 'callbackSubmit'],
          				'value'			=> 'Submit',
      			],
      		]);

          $form->check([$this, 'onSuccess'], [$this, 'onFail']);
          $this->di->views->add('default/page', [
              'title' => "Add Question",
              'content' => $form->getHTML()
          ]);
        }
        else
        {
          $this->response->redirect($this->url->create('Login'));
        }
    }

    public function deleteAction($postId = null, $userId = null)
    {
        if($postId == null)
        {
          die('Missing ID');
        }

        if($this->user->isLoggedIn() && $this->user->matchingId($userId))
        {
          $res = $this->questions->delete($postId);
        }

        $url = $this->url->create('Questions');
        $this->response->redirect($url);
    }

    public function updateAction($postId = null, $userId = null)
    {
      $question = $this->questions->find($postId);

      if($question && $this->user->isLoggedIn() && $this->user->matchingId($userId))
      {

        $tags = $this->tags->findAll();
        $tagArray = [];
    		foreach ($tags as $tag)
        {
    			$tagArray[] = $tag->getProperties()['name'];
    		}

        $checkedTags = $this->questiontags->findTagByQuestionId($postId, 'kmom10_');
			  $checked = array();
			  foreach ($checkedTags as $tag) {
				      $checked[] = $tag->getProperties()['name'];
			  }

        $this->checked = $checked;

        $form = $this->di->form->create([],  [
        'id'    => [
            'type'        => 'hidden',
            'value'       => $question->getProperties()['id'],
        ],
  			'title' => [
    				'type'			  => 'text',
    				'label'			  => 'Title:',
    				'required'		=> true,
    				'validation'	=> ['not_empty'],
            'value'       => $question->getProperties()['title'],
  			],
  			'content' => [
    				'type'			  => 'textarea',
    				'label'		   	=> 'Question:',
    				'required'		=> true,
    				'validation'	=> ['not_empty'],
            'value'       => $question->getProperties()['content'],
  			],
        'tags' => [
              'type'      => 'checkbox-multiple',
              'values'    => $tagArray,
              'checked'   => $checked,
        ],
  			'submit' => [
  				'type'		      => 'submit',
  				'callback'		  => [$this, 'callbackUpdate'],
  				'value'			    => 'Update',
  			],

  		]);

      $form->check([$this, 'onSuccessUpdate'], [$this, 'onFailUpdate']);
      $this->di->views->add('default/page', [
          'title' => "Update Question",
          'content' => $form->getHTML()
      ]);

      }
      else
      {
        $this->di->views->add('default/page', [
            'title' => "Access Denied",
            'content' => "Ajabaja"
        ]);
      }

    }

    public function viewLatestAction($limit = 0, $placement = '')
  	{
    		$questions = $this->questions->findLatestQuestions($limit);
    		$this->views->add('questions/latest', [
          'title'       => 'Latest Questions',
    			'questions'		=> $questions,
    		], $placement);
  	}

    public function setupAction()
    {
      $this->questions->setup();
    }

    public function onSuccess($form)
    {
        $form->AddOutput("<p><i>Question created</i></p>");
        $this->response->redirect($this->url->create('Questions'));
    }

    public function onFail($form)
    {
        $form->AddOutput("<p><i>Failed to post question</i></p>");
        $url = $this->di->request->getCurrentUrl();
        $this->response->redirect($url);
    }

    public function callbackSubmit($form)
    {
    	$now = gmdate('Y-m-d H:i:s');

      $slug = $this->questions->toAscii($form->Value('title'));

    	$saved = $this->questions->save(array(
          	'title'	   	=> $form->Value('title'),
          	'slug'		  => $slug,
        		'content'   => $form->Value('content'),
          	'userId'   	=> $_SESSION['user']['id'],
            'created'   => $now,
    	));

      $lastId = $this->questions->getLatestInsert();

      if (!empty($form->Value('tags')))
      {
            foreach ($form->Value('tags') as $tag)
            {
                $idTag = $this->tags->findByName($tag);
                $this->questiontags->create(['idQuestion' => $lastId, 'idTag' => $idTag->getProperties()['id']]);
            }
      }

      if ($saved)
      {return true;}
      else
      {return false;}
    }

    public function onSuccessUpdate($form)
    {
        $form->AddOutput("<p><i>Question updated</i></p>");
        $this->response->redirect($this->url->create('Questions'));
    }

    public function onFailUpdate($form)
    {
        $form->AddOutput("<p><i>Failed to update question</i></p>");
        $url = $this->di->request->getCurrentUrl();
        $this->response->redirect($url);
    }

    public function callbackUpdate($form)
    {
    	$now = gmdate('Y-m-d H:i:s');

      $slug = $this->questions->toAscii($form->Value('title'));

    	$saved = $this->questions->save(array(
          	'title'	   	=> $form->Value('title'),
          	'slug'		  => $slug,
        		'content'   => $form->Value('content'),
          	'userId'   	=> $_SESSION['user']['id'],
            'created'   => $now,
    	));

      if (!empty($this->checked)) {
            $this->questiontags->deleteByQuestionId($form->Value('id'));
        }
        if (!empty($form->Value('tags'))) {
            foreach ($form->Value('tags') as $tag) {
                $idTag = $this->tags->findByName($tag);
                $this->questiontags->create(['idQuestion' => $form->Value('id'), 'idTag' => $idTag->getProperties()['id']]);
            }
        }

      if ($saved)
      {return true;}
      else
      {return false;}
    }
}
