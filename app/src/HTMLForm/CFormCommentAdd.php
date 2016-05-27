<?php
namespace phes15\HTMLForm;
class CFormCommentAdd extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;
    private $key;
    private $type;
    private $redirect;
    
    public function __construct($key, $type, $redirect)
    {
        parent::__construct(['id' => 'comment-form'], [
            'content' => [
                'type'          => 'textarea',
                'label'         => 'Kommentar',
                'required'      => true,
                'validation'    => ['not_empty'],
            ],
            'submit' => [
                'type'          => 'submit',
                'callback'      => [$this, 'callbackSubmit'],
                'value'         => 'Kommentera',
            ],
        ]);
        $this->key      = $key;
        $this->type     = $type;
        $this->redirect = $redirect;
    }

    public function check($callIfSuccess = null, $callIfFail = null)
    {
        return parent::check([$this, 'callbackSuccess'], [$this, 'callbackFail']);
    }

    public function callbackSubmit()
    {
        $now = gmdate('Y-m-d H:i:s');
        $this->comment = new \phes15\Comments\Comment();
        $this->comment->setDI($this->di);
        $saved = $this->comment->save(array(
            'userId'      => $this->di->session->get('user')['id'],
            'content'     => $this->Value('content'),
            'commentKey'  => $this->key,
            'commentType' => $this->type,
            'timestamp'   => $now,
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
        $this->redirectTo();
    }
}
