<?php
namespace phes15\HTMLForm;
class CFormAnswerAdd extends \Mos\HTMLForm\CForm
{
	use \Anax\DI\TInjectionaware,
		\Anax\MVC\TRedirectHelpers;
	private $redirect;
    private $idQuestion;

	public function __construct($idQuestion, $redirect)
	{
		parent::__construct(['id' => 'questions-form'], [
			'content' => [
				'type'			=> 'textarea',
				'label'			=> 'Svar',
				'required'		=> true,
				'validation'	=> ['not_empty'],
			],
			'answer' => [
				'type'			=> 'submit',
				'callback'		=> [$this, 'callbackSubmit'],
				'value'			=> 'Svara',
			],
		]);
        $this->idQuestion = $idQuestion;
        $this->redirect = $redirect;
	}

    public function check($callIfSuccess = null, $callIfFail = null)
    {
        return parent::check([$this, 'callbackSuccess'], [$this, 'callbackFail']);
    }

    public function callbackSubmit()
    {
    	$now = gmdate('Y-m-d H:i:s');
    	$published = !empty($_POST['publish']) ? $now : null;
    	$this->answer = new \phes15\Answers\Answer();
    	$this->answer->setDI($this->di);
    	$saved = $this->answer->save(array(
            'idQuestion' => $this->idQuestion,
    		'content'    => $this->Value('content'),
    		'userId'     => $this->di->session->get('user')['id'],
            'created'    => $now,
    	));

        if ($saved)
        {
        	return true;
        }
        else
        {
        	return false;
        }
    }

    public function callbackSuccess()
    {
        $this->redirectTo($this->redirect);
    }
    
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Could not post</i></p>");
        $this->redirectTo();
    }
}
