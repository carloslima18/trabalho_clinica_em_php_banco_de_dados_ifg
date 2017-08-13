<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('consult->consult');
$I->sendPOST(
    '/front.php/consult',[
        'cpf' => '70328176109',
        'date' => '10/10/2020',
        'hour'=> '12',
        'minute'=> '30',
        'dentist' => 'celio'
    ]
);
$I->see('logar');
$I->see('sair');