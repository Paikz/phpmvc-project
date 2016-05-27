<?php

// Get environment & autoloader.
require __DIR__.'/config.php';

// Create services and inject into the app.
$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\MVC\CApplicationBasic($di);

$di->set('FormController', function () use ($di) {
    $controller = new \Anax\HTMLForm\FormController();
    $controller->setDI($di);
    return $controller;
});

$di->set('FormSmallController', function () use ($di) {
    $controller = new \Anax\HTMLForm\FormSmallController();
    $controller->setDI($di);
    return $controller;
});

$di->set('UsersController', function() use ($di) {
    $controller = new \phes15\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

// Home route
$app->router->add('', function () use ($app) {
    $app->theme->setTitle("Testing CForm with Anax");
    $app->views->add('default/page', [
        'title' => "Try out a form using CForm",
        'content' => "This is a example showing how to use CForm with Anax MVC, you must have CForm loaded as part of Anax MVC to make this frontcontroller work.",
        'links' => [
            [
                'href' => $app->url->create('test1'),
                'text' => "Form as a route",
            ],
            [
                'href' => $app->url->create('form'),
                'text' => "Form as a controller",
            ],
            [
                'href' => $app->url->create('form-small'),
                'text' => "Form as own class, used by a controller",
            ],
        ],
    ]);
});

// Test form route
$app->router->add('test1', function () use ($app) {
    $app->session();
    $form = $app->form->create([], [
        'name' => [
            'type'        => 'text',
            'label'       => 'Name of contact person:',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'email' => [
            'type'        => 'text',
            'required'    => true,
            'validation'  => ['not_empty', 'email_adress'],
        ],
        'phone' => [
            'type'        => 'text',
            'required'    => true,
            'validation'  => ['not_empty', 'numeric'],
        ],
        'submit' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
                $form->AddOutput("<p><b>Name: " . $form->Value('name') . "</b></p>");
                $form->AddOutput("<p><b>Email: " . $form->Value('email') . "</b></p>");
                $form->AddOutput("<p><b>Phone: " . $form->Value('phone') . "</b></p>");
                $form->saveInSession = true;
                return true;
            }
        ],
        'submit-fail' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
                return false;
            }
        ],
    ]);

    // Check the status of the form
   $status = $form->check();

   if ($status === true) {

       // What to do if the form was submitted?
       $form->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
       $app->redirectTo();

   } else if ($status === false) {

       // What to do when form could not be processed?
       $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
       $app->redirectTo();
   }

   $app->theme->setTitle("Welcome to Anax");
   $app->views->add('default/page', [
       'title' => "Try out a form using CForm",
       'content' => $form->getHTML()
   ]);

});

$app->router->add('setup', function() use ($app) {

    //$app->db->setVerbose();

    $app->db->dropTableIfExists('user')->execute();

    $app->db->createTable(
        'user',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym' => ['varchar(20)', 'unique', 'not null'],
            'email' => ['varchar(80)'],
            'name' => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'deleted' => ['datetime'],
            'active' => ['datetime'],
        ]
    )->execute();

    $app->db->insert(
      'user',
      ['acronym', 'email', 'name', 'password', 'created', 'active']
  );

  $now = gmdate('Y-m-d H:i:s');

  $app->db->execute([
      'admin',
      'admin@dbwebb.se',
      'Administrator',
      password_hash('admin', PASSWORD_DEFAULT),
      $now,
      $now
  ]);

  $app->db->execute([
      'doe',
      'doe@dbwebb.se',
      'John/Jane Doe',
      password_hash('doe', PASSWORD_DEFAULT),
      $now,
      $now
  ]);
});

$app->router->handle();
$app->theme->render();
