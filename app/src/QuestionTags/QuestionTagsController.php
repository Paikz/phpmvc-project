<?php
namespace phes15\QuestionTags;

class QuestionTagsController implements \Anax\DI\IInjectionAware
{
	use \Anax\DI\TInjectable;

	public function initialize()
	{
		$this->questiontags = new \phes15\QuestionTags\QuestionTag();
		$this->questiontags->setDI($this->di);
	}
	public function viewAction($id = null)
	{
		$tags = $this->questiontags->findTagByQuestionId($id, 'kmom10_');
		$this->views->add('questions/question-tags', [
			'tags'		=> $tags,
		], 'main');
	}

	public function setupAction()
	{
		$this->questiontags->setup();
	}
}
