<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('deletepatient->deletepatient');
$I->sendPOST(
    '/front.php/deletepatient',[
        'cpf' => '70328176109',
    ]
);
$I->see('logar');
$I->see('sair');