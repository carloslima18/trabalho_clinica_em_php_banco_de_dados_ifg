<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('showconsultday->consultday');
$I->sendPOST(
    '/front.php/showconsultday',[
        'cpf' => '70328176109',
        'date' => '05052005'
    ]
);
$I->see('logar');
$I->see('sair');