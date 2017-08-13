<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('deleteconsult->deleteconsult');
$I->sendPOST(
    '/front.php/deleteconsult',[
        'cpf' => '70328176109',
        'date' => '10102020'
    ]
);
$I->see('logar');
$I->see('sair');
