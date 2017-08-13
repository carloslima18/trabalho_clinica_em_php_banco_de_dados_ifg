<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 17/02/2017
 * Time: 13:08
 */
require_once  __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use framework\Framework;

$request= Request::createFromGlobals();
$routes= new Routing\RouteCollection();

$routes->add('index_clinic',new Routing\Route('/index',[
            '_controller'=>'clinic\Controller\ClinicController::indexAction'
        ]
    )
);
$routes->add('exit_clinic',new Routing\Route('/exit',[
            '_controller'=>'clinic\Controller\ClinicController::exitAction'
        ]
    )
);


$routes->add('register_clinic',new Routing\Route('/register',[
            '_controller'=>'clinic\Controller\ClinicController::registerAction'
        ]
    )
);

$routes->add('data_clinic',new Routing\Route('/data',[
            '_controller'=>'clinic\Controller\ClinicController::dataAction'
        ]
    )
);

$routes->add('delete_clinic',new Routing\Route('/deleteconsult',[
            '_controller'=>'clinic\Controller\ClinicController::deleteAction'
        ]
    )
);

$routes->add('login_clinic',new Routing\Route('/login',[
            '_controller'=>'clinic\Controller\ClinicController::loginAction'
        ]
    )
);
$routes->add('consult_clinic',new Routing\Route('/consult',[
            '_controller'=>'clinic\Controller\ClinicController::consultAction'
        ]
    )
);

$routes->add('showconsultday_clinic',new Routing\Route('/showconsultday',[
            '_controller'=>'clinic\Controller\ClinicController::showconsultdayAction'
        ]
    )
);
$routes->add('showconsultall_clinic',new Routing\Route('/showconsultall',[
            '_controller'=>'clinic\Controller\ClinicController::showconsultallAction'
        ]
    )
);
$routes->add('showall_clinic',new Routing\Route('/showall',[
            '_controller'=>'clinic\Controller\ClinicController::showallAction'
        ]
    )
);
$routes->add('showday_clinic',new Routing\Route('/showday',[
            '_controller'=>'clinic\Controller\ClinicController::showdayAction'
        ]
    )
);
$routes->add('allconsults_clinic',new Routing\Route('/allconsults',[
            '_controller'=>'clinic\Controller\ClinicController::allconsultsAction'
        ]
    )
);
$routes->add('deletepatient_clinic',new Routing\Route('/deletepatient',[
            '_controller'=>'clinic\Controller\ClinicController::deletepatientAction'
        ]
    )
);
$routes->add('showdatapatient_clinic',new Routing\Route('/showdatapatient',[
            '_controller'=>'clinic\Controller\ClinicController::showdatapatientAction'
        ]
    )
);
$routes->add('showpatient_clinic',new Routing\Route('/showpatient',[
            '_controller'=>'clinic\Controller\ClinicController::showpatientAction'
        ]
    )
);
$routes->add('registerinfo_clinic',new Routing\Route('/registerinfo',[
            '_controller'=>'clinic\Controller\ClinicController::registerinfoAction'
        ]
    )
);
$routes->add('allpatients_clinic',new Routing\Route('/allpatients',[
            '_controller'=>'clinic\Controller\ClinicController::allpatientsAction'
        ]
    )
);
$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes,$context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$framework = new framework($matcher,$controllerResolver,$argumentResolver);
$response = $framework->handle($request);

$response->send();