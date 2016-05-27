<?php
namespace phes15\Users;

// For users and admin related events
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function initialize()
    {
        $this->user = new \phes15\Users\User();
        $this->user->setDI($this->di);

        $this->questions = new \phes15\Questions\Question();
        $this->questions->setDI($this->di);

        $this->comments = new \phes15\Comments\Comment();
        $this->comments->setDI($this->di);

        $this->answers = new \phes15\Answers\Answer();
        $this->answers->setDI($this->di);
    }

    public function indexAction()
    {
        $this->theme->setTitle('Users');
        $users = $this->user->findAll();

        $this->views->add('users/list-all',
                          ['users' => $users,
                          'title' => "View all users"]);
    }

    public function onSubmit($form)
    {
        $now = gmdate('Y-m-d H:i:s');

        $res = $this->user->save([
          'name'      => $form->Value('name'),
          'email'     => $form->Value('email'),
        ]);

        return $res;
    }

    public function onSuccess($form)
    {
        $form->AddOutput("<p><i>User saved</i></p>");
        $url = $this->di->request->getCurrentUrl();
        $this->response->redirect($url);
    }

    public function onFail($form)
    {

    }

    public function listAction()
    {
        $all = $this->user->findAll();

        $this->theme->setTitle("List all users");
        $this->views->add('users/list-all',
                          ['users' => $all,
                           'title' => "View all users"]);
    }

    public function idAction($id = null)
    {
        $user = $this->user->find($id);

        $this->theme->setTitle("View user with id");

        $username = null;
        if(isset($_SESSION['user']))
        {
              $username = $_SESSION['user']['username'];
        }

        $questions = $this->questions->findQuestionByUserId($id, 100);
        $answers = $this->answers->findAnswerByUserId($id, 'created DESC', 100);

        $this->views->add('users/view',
                          ['user'             => $user,
                          'questions'         => $questions,
                          'questionForSlug'   => $this->questions,
                          'answers'           => $answers,
                          'title'             => "View all users",
                          'username'          => $username]);
    }

    public function viewMostActiveAction($sort = null, $limit = null, $id = null, $placement = '')
  	{
  		$userPosts = $this->user->getTotalPosts('kmom10_', $sort, $limit);
  		$this->views->add('users/viewMostActive', [
  			'users' => $userPosts,
  		], $placement);
  	}

    public function setupAction()
    {
        $this->theme->setTitle('setup users');
        $this->db->dropTableIfExists('user')->execute();

        $this->db->createTable(
            'user',
            [
                'id' => ['integer',
                         'primary key',
                         'not null',
                         'auto_increment'],
                'username' => ['varchar(20)', 'unique', 'not null'],
                'email' => ['varchar(80)'],
                'name' => ['varchar(80)'],
                'password' => ['varchar(255)'],
                'image' => ['varchar(255)'],
                'created' => ['datetime'],
                'updated' => ['datetime'],
                'deleted' => ['datetime'],
                'active' => ['datetime']
            ]
        )->execute();

        $this->db->insert('user',
                         ['username',
                          'email',
                          'name',
                          'image',
                          'password',
                          'created',
                          'active']);
        $now = gmdate('Y-m-d H:i:s');
        $this->db->execute(['phes15',
                           'paikzswe@gmail.com',
                           'Philip Esmailzade',
                           "http://www.gravatar.com/avatar/" . md5( strtolower( trim('paikzswe@gmail.com') ) ) . '.jpg',
                           password_hash('admin', PASSWORD_DEFAULT),
                           $now,
                           $now]);

        $this->db->execute(['doe',
                           'doe@student.bth.se',
                           'John Doe',
                           "http://www.gravatar.com/avatar/" . md5( strtolower( trim('doe@student.bth.se') ) ) . '.jpg',
                           password_hash('doe', PASSWORD_DEFAULT),
                           $now,
                           $now]);
    }

    public function deleteAction($id = null)
    {
        if ( !isset($id) )
        {
            die("Missing id");
        }

        $res = $this->user->delete($id);

        $url = $this->url->create('Users');
        $this->response->redirect($url);
    }

    public function updateAction($id = null)
    {
        $this->theme->setTitle("Update user");

        if($this->user->isLoggedIn() && $this->user->matchingId($id))
        {
            $user = $this->user->find($id);
            $form = $this->di->form->create([], [
                'name' => [
                    'type'  => 'text',
                    'label' => 'Name:',
                    'value' => $user->name,
                    'required' => true,
                    'validation' => ['not_empty'],
                ],
                'email' => [
                    'type'  => 'text',
                    'label' => 'Email:',
                    'value' => $user->email,
                    'required' => true,
                    'validation' => ['not_empty', 'email_adress'],
                ],

                'submit' => [
                    'type' => 'submit',
                     'callback' => [$this, 'onSubmit']
                ],
            ]);

            $form->check([$this, 'onSuccess'], [$this, 'onFail']);
            $this->di->views->add('default/page', [
                'title' => "Update user",
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
}

?>
