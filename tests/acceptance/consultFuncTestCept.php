<?php
$I = new AcceptanceTester($scenario);
$I->login('admin','admin');
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
$I->see('paciente');
$I->see('não');
$I->see('inscrito');