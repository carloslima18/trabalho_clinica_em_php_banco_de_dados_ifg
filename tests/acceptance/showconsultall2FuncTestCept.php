<?php
$I = new AcceptanceTester($scenario);;
$I->wantTo('consultall->consultall');
$I->sendPOST(
    '/front.php/showconsultall',[
        'cpf' => '7032'
    ]
);
$I->see('logar');
$I->see('sair');