<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->sendPOST(
    '/front.php/login',[
        'uname' => 'admin',
        'psw' => 'adm'
    ]
);
$I->see('Senha');
$I->see('incorretos');
$I->see('Usuário');

