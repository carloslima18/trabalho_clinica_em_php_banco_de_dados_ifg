<?php
$I = new AcceptanceTester($scenario);
$I->login('admin','admin');
$I->wantTo('showconsultall->consultall');
$I->sendPOST(
    '/front.php/showconsultall',[
        'cpf' => '70328176109'
    ]
);
$I->see('CONSULTAR');
$I->see('CPF');