<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('consult->consult');
$I->sendPOST(
    '/front.php/allconsults',[
        'date' => '10/10/2020',
    ]
);
$I->see('logar');
$I->see('sair');