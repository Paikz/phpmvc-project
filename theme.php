<?php

require __DIR__ . '/config_with_app.php';

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_grid.php');
$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');

$app->router->add('', function() use ($app) {

    $app->theme->addStylesheet('css/anax-grid/region-colors.css');
    $app->theme->setTitle("Theme");

    $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-1', 'footer-1')
               ->addString('footer-2', 'footer-2')
               ->addString('footer-3', 'footer-3')
               ->addString('footer-4', 'footer-4');
});

$app->router->add('Typography', function() use ($app) {

    $app->theme->setTitle("Typography");

    $content = $app->fileContent->get('typography.html');

    $app->views->add('default/article', [
       'content' => $content,
    ]);

    $app->views->add('default/article', [
       'content' => $content,
    ], 'sidebar');

});

$app->router->add('FontAwesome', function() use ($app) {

    $app->theme->setTitle("Font Awesome");

    $contentMain = $app->fileContent->get('fa-main.html');
    $contentSidebar = $app->fileContent->get('fa-sidebar.html');

    $app->views->add('default/article', [
       'content' => $contentMain,
    ]);

    $app->views->add('default/article', [
       'content' => $contentSidebar,
    ], 'sidebar');

});

$app->router->handle();
$app->theme->render();
