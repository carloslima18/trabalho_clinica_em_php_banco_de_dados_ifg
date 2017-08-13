<?php
$I = new AcceptanceTester($scenario);
$I->login('admin','admin');
$I->wantTo('showpatient->show');
$I->sendPOST(
    '/front.php/showpatient',[
        'cpf' => '70328176109',
    ]
);
$I->see('cliente');
$I->see('cpf');