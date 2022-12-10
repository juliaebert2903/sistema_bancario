<?php

namespace Config;

$routes = Services::routes();

if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'AccountController::index');

$routes->get('/login', 'Home::login');
$routes->post('/fazerLogin', 'Home::fazerLogin');

$routes->get('/cadastro', 'Home::cadastro');
$routes->post('/fazerCadastro', 'Home::fazerCadastro');

$routes->get('/logout', 'Home::logout');

$routes->post('/fazerTransferencia', 'AccountController::fazerTransferencia');
$routes->post('/pagarCobranca/(:num)', 'AccountController::pagarCobranca/$1');

$routes->post('/fazerAplicacao', 'AccountController::fazerAplicacao');
$routes->post('/resgatarAplicacao/(:num)', 'AccountController::resgatarAplicacao/$1');


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
