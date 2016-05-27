<?php
namespace phes15\Tags;

class TagsController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function initialize()
  	{
  		$this->tags = new \phes15\Tags\Tag();
  		$this->tags->setDI($this->di);

      $this->questions = new \phes15\Questions\Question();
      $this->questions->setDI($this->di);

      $this->user = new \phes15\Users\User();
      $this->user->setDI($this->di);
  	}

    public function indexAction()
    {
      $tags = $this->tags->findAll();

      $this->views->add('tags/viewAll', [
			'title'		=> 'Tags',
			'tags'		=> $tags,
  		], 'main');
    }

    public function viewAction($slug = null)
    {
      $idTag =  $this->tags->getIdBySlug($slug);
      $tag = $this->tags->find($idTag);
  		$questions = $this->questions->findQuestionByTag($idTag, "kmom10_");

      $title = "Could not find tag";
      if($tag) {
        $title =  "Questions with tag: " . $tag->getProperties()['name'];
      }

      $this->views->add('questions/viewAll', [
			'title'			   => $title,
			'questions'		 => $questions,
			'user'			   => $this->user,
		  ], 'main');

    }

    public function viewMostUsedAction($limit = 0, $placement = '')
  	{
  		$tags = $this->tags->findMostUsedTags($limit);
  		$this->views->add('tags/viewPopular', [
  			'tags'		=> $tags,
  		], $placement);
  	}

    public function setupAction()
    {
      $this->tags->setup();
    }
}
