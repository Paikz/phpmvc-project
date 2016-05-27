<?php

require __DIR__ . '/config_with_app.php';

$app->session();
$app = new \Anax\MVC\CApplicationBasic($di);
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');

$di->set('table', '\phes15\HTMLTable\CHTMLTable');

$di->set('CommentsController', function() use ($di) {
    $controller = new phes15\Comments\CommentsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('LoginController', function() use ($di) {
    $controller = new phes15\Users\LoginController();
    $controller->setDI($di);
    return $controller;
});

$di->set('UsersController', function() use ($di) {
    $controller = new \phes15\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

$di->set('QuestionsController', function() use ($di) {
    $controller = new \phes15\Questions\QuestionsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('TagsController', function() use ($di) {
    $controller = new \phes15\Tags\TagsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('QuestiontagsController', function() use ($di) {
    $controller = new \phes15\QuestionTags\QuestionTagsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('AnswersController', function() use ($di) {
    $controller = new \phes15\Answers\AnswersController();
    $controller->setDI($di);
    return $controller;
});

$di->setShared('db', function() {
  $db = new \Mos\Database\CDatabaseBasic();
  $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
  $db->connect();
  return $db;
});

$app->router->add('', function() use ($app) {
    $app->theme->setTitle('Home');

    $content 	= $app->fileContent->get('start.md');
  	$content 	= $app->textFilter->doFilter($content, 'shortcode, markdown');

  	$app->views->add('default/page2', [
   		'content'	=> $content,
  	], 'flash');

  	$app->dispatcher->forward([
  		'controller' 	=> 'questions',
  		'action'		=> 'view-latest',
  		'params'		=> [5, 'featured-1'],
  	]);
  	$app->dispatcher->forward([
  		'controller'	=> 'tags',
  		'action'		=> 'view-most-used',
  		'params'		=> [5, 'featured-2'],
  	]);
  	$app->dispatcher->forward([
  		'controller'	=> 'users',
  		'action'		=> 'view-most-active',
  		'params'		=> ['total DESC', 5, null, 'featured-3'],
  	]);
});

$app->router->add('Comments', function() use ($app) {

    $app->theme->setTitle("Comments");

    $app->dispatcher->forward([
      'controller' => 'comments',
      'action'     => 'view',
      'params'   => ['Comments'],
    ]);

    $app->dispatcher->forward([
        'controller' => 'comments',
        'action'     => 'add',
        'params' => ['Comments'],
    ]);

    $app->views->add('comment/setup', [
        'pageid' => 'Comments',
        'redirect' => 'Comments'
    ]);

});

$app->router->add('Users', function() use ($app) {

    $app->theme->setTitle("Users");

    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'index',
    ]);

});

$app->router->add('Login', function() use ($app) {

    $app->theme->setTitle("Login");

    $app->dispatcher->forward([
        'controller' => 'login',
        'action'     => 'login',
    ]);

});

$app->router->add('Logout', function() use ($app) {

    $app->theme->setTitle("Logout");

    $app->dispatcher->forward([
        'controller' => 'login',
        'action'     => 'logout',
    ]);

});

$app->router->add('Register', function() use ($app) {

    $app->theme->setTitle("Register");

    $app->dispatcher->forward([
        'controller' => 'login',
        'action'     => 'register',
    ]);

});

$app->router->add('Questions', function() use ($app) {

    $app->theme->setTitle("Questions");

    $app->dispatcher->forward([
        'controller' => 'questions',
        'action'     => 'index',
    ]);

});

$app->router->add('Tags', function() use ($app) {

    $app->theme->setTitle("Tags");

    $app->dispatcher->forward([
        'controller' => 'tags',
        'action'     => 'index',
    ]);

});

$app->router->add('QuestionTags', function() use ($app) {

    $app->theme->setTitle("QuestionTags");

    $app->dispatcher->forward([
        'controller' => 'questiontags',
        'action'     => 'view',
    ]);

});

$app->router->add('Answers', function() use ($app) {

    $app->theme->setTitle("Answers");

    $app->dispatcher->forward([
        'controller' => 'answers',
        'action'     => 'view',
    ]);

});

$app->router->add('About', function() use ($app) {

    $app->theme->setTitle("About");

    $content 	= $app->fileContent->get('about.md');
  	$content 	= $app->textFilter->doFilter($content, 'shortcode, markdown');

  	$app->views->add('default/page2', [
   		'content'	=> $content,
  	], 'main');

});

$app->router->handle();
$app->theme->render();
