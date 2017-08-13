<?php
$I = new AcceptanceTester($scenario);
$I->login('admin','admin');
$I->wantTo('deletepatient->deletepatient');
$I->sendPOST(
    '/front.php/deletepatient',[
        'cpf' => '70328176109',
    ]
);
$I->see('Paciente');
$I->see('não');
$I->see('encontrado');