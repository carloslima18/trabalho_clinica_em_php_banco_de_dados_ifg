<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->sendPOST(
    '/front.php/login',[
        'uname' => 'admin',
        'psw' => 'admin'
    ]
);
$I->see('ferreira');
$I->see('LOGAR');
$I->see('LOGADO');

