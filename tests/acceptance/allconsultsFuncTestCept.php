<?php
$I = new AcceptanceTester($scenario);
$I->login('admin','admin');
$I->wantTo('consult->consult');
$I->sendPOST(
    '/front.php/allconsults',[
        'date' => '10/10/2020',
    ]
);
$I->see('Data');
$I->see('sem');
$I->see('consultas');