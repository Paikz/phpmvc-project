<?php
namespace phes15\Users;

// For users and admin related events
class LoginController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function initialize()
    {
        $this->user = new \phes15\Users\User();
        $this->user->setDI($this->di);
    }

    public function loginAction()
    {
      $this->theme->setTitle("Login");

      $form = $this->di->form->create([], [
          'username' => [
              'type'  => 'text',
              'label' => 'Username:',
              'required' => true,
              'validation' => ['not_empty'],
          ],
          'password' => [
              'type'  => 'password',
              'label' => 'Password:',
              'required' => true,
              'validation' => ['not_empty'],
          ],
          'submit' => [
              'type' => 'submit',
               'callback' => [$this, 'onSubmitLogin']
          ],
      ]);

      $form->check([$this, 'onSuccessLogin'], [$this, 'onFailLogin']);
      $this->di->views->add('default/page3', [
          'title' => "Login",
          'content' => $form->getHTML()
      ]);
    }

    public function registerAction()
    {
      $form = $this->di->form->create([], [
        'username' => [
            'type'			=> 'text',
            'label'			=> 'UserName:',
            'required'		=> true,
            'validation'	=> ['not_empty'],
        ],
        'name' => [
            'type'			=> 'text',
            'label'			=> 'Name:',
            'required'		=> true,
            'validation'	=> ['not_empty'],
        ],
        'password' => [
            'type'			=> 'password',
            'label'			=> 'Password:',
            'required'		=> true,
            'validation'	=> ['not_empty'],
        ],
        'email' => [
            'type'			=> 'text',
            'label'			=> 'Email:',
            'required'		=> true,
            'validation'	=> ['not_empty', 'email_adress'],
        ],
        'submit' => [
            'type'			=> 'submit',
            'callback'		=> [$this, 'onSubmitRegister'],
            'value'			=> 'Register'
        ],
      ]);

      $form->check([$this, 'onSuccessRegister'], [$this, 'onFailRegister']);
      $this->di->views->add('default/page', [
          'title' => "Register",
          'content' => $form->getHTML()
      ]);

    }

    public function logoutAction()
    {
      $this->user->logout();
    }

    public function onSubmitLogin($form)
    {
        $now = gmdate('Y-m-d H:i:s');

        $authenticated = $this->user->authenticate($form->Value('username'), $form->Value('password'));

        if ($authenticated)
        {return true;}
        else {return false;}
    }

    public function onSuccessLogin($form)
    {
        $this->response->redirect("Users");
    }

    public function onFailLogin($form)
    {
      $form->AddOutput("<p><i>Login failed</i></p>");
      $url = $this->di->request->getCurrentUrl();
      $this->response->redirect($url);
    }

    public function onSubmitRegister($form)
    {
        $now = gmdate('Y-m-d H:i:s');

        $taken = $this->user->usernameTaken($form->Value('username'));

        $saved = null;
        if (!$taken)
        {
                $saved = $this->user->save(array(
                'username'  => $form->Value('username'),
                'name'      => $form->Value('name'),
                'image'     => "http://www.gravatar.com/avatar/" . md5( strtolower( trim($form->Value('email')) ) ) . '.jpg',
                'password'  => password_hash($form->Value('password'), PASSWORD_DEFAULT),
                'email'     => $form->Value('email'),
                'created'   => $now,
                'active'    => $now,
                ));
        }
        else {$saved = false;}

        if ($saved)
        {return true;}
        else
        {return false;}
    }

    public function onSuccessRegister($form)
    {
        $this->user->authenticate($form->Value('username'), $form->Value('password'));
        $url = $this->di->request->getCurrentUrl();
        $this->response->redirect($url);
    }

    public function onFailRegister($form)
    {
      $form->AddOutput("<p><i>Username already taken</i></p>");
      $url = $this->di->request->getCurrentUrl();
      $this->response->redirect($url);
    }
}
