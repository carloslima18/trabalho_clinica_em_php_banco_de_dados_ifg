<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 17/02/2017
 * Time: 14:28
 */
namespace clinic\controller;
use clinic\errors\InvalidArgument;
use clinic\validators\date\dates\DateDMY;
use Herrera\Json\Exception\Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use clinic\person\patient\Patient;
use clinic\validators\cpf\Cpf;

use clinic\Model;

class ClinicController {
    protected $session;
    protected $patient;
    protected $consults;

    public function allpatientsAction(){
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }

        $bd = new Model();
        $query = $bd->consultar("select primeiro_nome, data_nasc from paciente;");

        $this->consults = $query;
        if(count($this->consults) == 0){
            $this->session->getFlashBag()->add('info','Nenhum paciente cadastrado');
            return $this->render_view('data');
        }
        //$this->session->set("consulta" ,$query); NAo serve para NADA!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        return $this->render_view('allpatients');
    }
//pega o nome para o show data patiente
    public function showpatientAction(){
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        return $this->render_view('showpatient');
    }

    public function showdatapatientAction(Request $request){
        $this->session= new Session();
        $error='';
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        if ( $request->getMethod()=='POST') {
            if(!$this->patient){
                try {
                    $cpf = $request->request->get('cpf');

                    $bd = new Model();
                    $query = $bd->consultar("select primeiro_nome, data_nasc from Paciente as c where c.cpf = '$cpf';");


                    if ($query != false) {
                        $this->consults = $query;
                        $this->session->getFlashBag()->add('info','Paciente encontrado');
                        //$this->session->set($this->consults,$query);
                        return $this->render_view('showdatapatient');
                    }
                }
                catch ( InvalidArgument $e){
                    $error=$e->getMessage();
                }
                catch ( \Throwable $e ){
                    $error= 'errorrrr !!!!';
                }
            }
        }
        $this->session->getFlashBag()->add('info','Paciente não encontrado');
        ob_start();
        include sprintf(__DIR__ . '/../view/showpatient.php');
        return new Response( ob_get_clean());
    }

    public function deletepatientAction(Request $request){
        $error='';
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }

        if ( $request->getMethod()=='POST') {
            try{
                $cpf =$request->request->get('cpf');
                // var_dump($cpf);
                //$cpf = $cpf->getFormattedCpf();
                $bd = new Model();
                $bd->consultar("delete from paciente where cpf = '$cpf';");
                $this->session->getFlashBag()->add('info','Paciente com pontos no cpf apagado com sucesso!');
                return $this->render_view('deletepatient');

            }
            catch ( InvalidArgument $e){
                $error=$e->getMessage();
            }
            catch ( \Throwable $e ){
                $error= 'errorrrr !!!!';
            }

            $this->session->getFlashBag()->add('info','Paciente não encontrado!');

        }
        ob_start();
        include sprintf(__DIR__.'/../view/deletepatient.php');
        return new Response( ob_get_clean());
    }

    /**
     * mostra todas as consultas referentes ao dia pesquisado
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function allconsultsAction(Request $request){
        $this->session= new Session();
        $error='';
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        if ( $request->getMethod()=='POST') {
            try{
               // $date = new DateDMY($request->request->get('date'));
                //$date = $date->getFormattedDate();
                $date = $request->request->get('date');

                $bd = new Model();

                $query2 = $bd->consultar("select p.primeiro_nome, c.pcpf, c.cdata from Consulta as c, paciente as p where c.cdata = '$date';");

                if(!$query2){
                    $this->session->getFlashBag()->add('info', 'Data sem consultas marcadas, pesquise uma nova data');
                    ob_start();
                    include sprintf(__DIR__.'/../view/allconsults.php');
                    return new Response( ob_get_clean());
                }
                else {
                    $this->consults = $query2;
                  //  $this->session->set($this->consults, $query2);
                    ob_start();
                    include sprintf(__DIR__ . '/../view/allconsults.php');
                    return new Response(ob_get_clean());
                }
            }
            catch ( InvalidArgument $e){
                $error=$e->getMessage();
            }
            catch ( \Throwable $e ){
                $error= 'errorrrr !!!!';
            }
        }
        ob_start();
        include sprintf(__DIR__.'/../view/allconsults.php');
        return new Response( ob_get_clean());
    }

    /**
     * apresenta todas consulta do dia dado e do cpf
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function showdayAction(Request $request){
        $error='';
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        if ( $request->getMethod()=='POST') {
            try{
                //$cpf = new Cpf($request->request->get('cpf'));
                $cpf = $request->request->get('cpf');
                //$cpf = $cpf->getFormattedCpf();
                $date =$request->request->get('date');
               // $date = $date->getFormattedDate();
               // $this->patient = $this->searchObject($cpf);

                $bd = new Model();
                $query = $bd->consultar("select c.pcpf from consulta as c where c.pcpf = '$cpf';");
                $resul = pg_fetch_assoc($query);

                if (!$query) {
                    $this->session->getFlashBag()->add('info', 'Paciente inexistente');
                    return $this->render_view('showconsultday');
                }

                $query2 = $bd->consultar("select c.cdata from consulta as c where c.cdata = '$date';");
                $resul2 = pg_fetch_assoc($query2);

                if(!$query2){
                    $this->session->getFlashBag()->add('info', 'Nenhuma consulta para esse dia');
                    return $this->render_view('showconsultday');
                }
                $query3 = $bd->consultar("select cdata,pcpf,hora from consulta where cdata = '$date' or pcpf = '$cpf';");

                $this->consults = $query3;
                //$this->patient = $this->searchObject($cpf); leva tudo para a memoria primeiro
              //  $this->session->set($this->consults, $query3);
                return $this->render_view('showday');
            }
            catch (InvalidArgument $e){
                $error=$e->getMessage();
            }
            catch (\Throwable $e) {
                $error = '';
            }
            $this->session->getFlashBag()->add('info',"$error");
        }
        ob_start();
        include sprintf(__DIR__.'/../view/showconsultday.php');
        return new Response( ob_get_clean());
    }

    //defeituoso00000000000
    /**
     * apresenta todas as consultas referentes ao paciente pesquisado
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function showallAction(Request $request){
        $error='';
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        if ( $request->getMethod()=='POST') {
            try {
                //$cpf = new Cpf($request->request->get('cpf'));
                $cpf = $request->request->get('cpf');
                //$cpf = $cpf->getFormattedCpf();

                $bd = new Model();
                $query = $bd->consultar("select primeiro_nome from paciente where cpf = '$cpf';");

                $this->consults = $query;

                ob_start();
                include sprintf(__DIR__ . '/../view/showall.php');
                return new Response(ob_get_clean());

            } catch (Exception $e){
                    $this->session->getFlashBag()->add('info', 'Paciente inexistente');
                    //return $this->render_view('showconsultall');
                    ob_start();
                    include sprintf(__DIR__ . '/../view/showconsultall.php');
                    return new Response(ob_get_clean());
            }
            catch ( InvalidArgument $e){
                $error=$e->getMessage();
            }
            catch ( \Throwable $e ){
                $error= 'errorrrr !!!!';
            }

        }
        ob_start();
        include sprintf(__DIR__ . '/../view/showconsultall.php');
        return new Response( ob_get_clean());
        //return new RedirectResponse('/clinica/front.php/showconsultall');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function showconsultallAction(Request $request){
        $error='';
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        $this->session->getFlashBag()->add('info','');
        //return $this->render_view('');
        ob_start();
        include sprintf(__DIR__.'/../view/showconsultall.php');
        return new Response( ob_get_clean());
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function showconsultdayAction(Request $request){
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        $this->session->getFlashBag()->add('info','');
        return $this->render_view('showconsultday');
    }

    /**
     * troca o valor de login para anoymous
     * @return RedirectResponse
     */
    public function exitAction(){
        $this->session = new Session();
        $this->session->clear();
        $this->session->getFlashBag()->add('info','Deslogado com sucesso');
        return new RedirectResponse('/clinica/front.php/index');
    }

    /**
     * apaga consulta passada pela data e cpf
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function deleteAction(Request $request){
        $error='';
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        if ( $request->getMethod()=='POST'){
            try{
                //$cpf = new Cpf($request->request->get('cpf'));
                $cpf = $request->request->get('cpf');
                //  $cpf = $cpf->getFormattedCpf();
                $date = $request->request->get('date');
                //  $date = new DateDMY($request->request->get('date'));
              //  $date = $date->getFormattedDate();


                $bd = new Model();
                $query = $bd->consultar("delete from Consulta as c where c.cdata = '$date' and c.pcpf = '$cpf';");

                if($query) {
                   // $patient->save();
                    $this->session->getFlashBag()->add('info', 'Consulta apagada com sucesso');
                    ob_start();
                    include sprintf(__DIR__.'/../view/deleteconsult.php');
                    return new Response( ob_get_clean());
                }

            }
            catch (InvalidArgument $e){
                $error=$e->getMessage();
            }
            catch (\Throwable $e){
                $error= '';
            }
            $this->session->getFlashBag()->add('info','Consulta não encontrado');
        }
        ob_start();
        include sprintf(__DIR__.'/../view/deleteconsult.php');
        return new Response( ob_get_clean());
    }
    /**
     * registra a consulta no objeto
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function consultAction(Request $request){
        $error='';
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        if ( $request->getMethod()=='POST')
        {
            try {
                $cpf = $request->request->get('cpf');
                $date = $request->request->get('date');

                //para ve se o paciente esta cadastrado
                $bd = new Model();
                $query = $bd->consultar("select p.cpf from Paciente as p where p.cpf = '$cpf'");
                if(!pg_fetch_assoc($query)){
                    $this->session->getFlashBag()->add('info','Paciente não cadastrado no sistema');
                    ob_start();
                    include sprintf(__DIR__.'/../view/consult.php');
                    return new Response( ob_get_clean());
                }

                $dentista = $request->request->get('dentist');
                $hora =  $request->request->get('hour');
                $minuto = $request->request->get('minute');

               $queryx = $bd->consultar("select count(*) as t from Consulta where cdata = '$date' and hora = '$hora';");
                $row = pg_fetch_array($queryx,null,PGSQL_ASSOC);
                if($row["t"] != 0){
                    $this->session->getFlashBag()->add('info','Data ja foi marcada');
                    ob_start();
                    include sprintf(__DIR__.'/../view/consult.php');
                    return new Response( ob_get_clean());
                }

                $query2=  $bd->consultar("INSERT INTO public.consulta( dcpf, pcpf, cdata, hora)VALUES ('$dentista','$cpf','$date','$hora');");

                $query4 = $bd->consultar("select  c.cdata, c.pcpf, p.primeiro_nome from Consulta as c inner join Paciente as p
                on p.cpf = c.pcpf where c.pcpf = '$cpf';");

                $this->consults = $query4;
               // $this->session->set('consults', $query4);

               // $this->session->getFlashBag()->add('info','Consulta marcada com sucesso');

                ob_start();
                include sprintf(__DIR__.'/../view/showday.php');
                return new Response( ob_get_clean());
            }
            catch (InvalidArgument $e){
                $error=$e->getMessage();
            }
            catch (\Throwable $e){
                $error= 'error !!!!';
            }
        }
        ob_start();
        include sprintf(__DIR__.'/../view/consult.php');
        return new Response( ob_get_clean());
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function dataAction(Request $request)
    {
        $this->session = new Session();
        if (!$this->access()) {
            $this->session->getFlashBag()->add('info', 'Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        $this->session->getFlashBag()->add('info', '');
        return $this->render_view('data');
    }

    /**
     * registra novo paciente
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function  registerAction ( Request $request){
        $error='';
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
        if ( $request->getMethod()=='POST')
        {
            try {

                $this->patient = new Patient($request->request->get('firstName'), $request->request->get('lastName'),
                    $request->request->get('rg'), $request->request->get('rua'), $request->request->get('numero'),
                    $request->request->get('complemento'), $request->request->get('bairro'), $request->request->get('cidade'),
                    $request->request->get('estado'), $request->request->get('cep'), $request->request->get('date'),
                    $request->request->get('cpf'), $request->request->get('phone'), $request->request->get('sex'),
                    $request->request->get('email'));

                $cpf = $request->request->get('cpf');
                $rg = $request->request->get('rg');
                $primeiro_nome = $request->request->get('firstName');
                $segundo_nome = $request->request->get('lastName');
                $sexo = $request->request->get('sex');
                $data_nasc = $request->request->get('date');
                $endereco = "rua" . $request->request->get('rua') . "numero:" . $request->request->get('numero') . "complemento:" . $request->request->get('complemento') . "bairro" . $request->request->get('bairro');
                $cidade = $request->request->get('cidade');
                $estado = $request->request->get('estado');
                $cep = $request->request->get('cep');
                $contatos = $request->request->get('phone');
                $email = $request->request->get('email');


                $bd = new Model();
                $query = $bd->consultar("select primeiro_nome, data_nasc from Paciente as p where p.cpf = '$cpf' ");
                if(pg_fetch_assoc($query)){
                    echo "cpf repetido";
                }else {
                    $bd->consultar("insert into Paciente (cpf,rg,primeiro_nome,segundo_nome,sexo,data_nasc,endereco,cidade,estado,cep,contatos,email) values('$cpf','$rg','$primeiro_nome','$segundo_nome','$sexo','$data_nasc','$endereco','$cidade','$estado','$cep','$contatos','$email');");

                    $query2 = $bd->consultar("select cpf,rg,primeiro_nome,segundo_nome,sexo,data_nasc,endereco,cidade,estado,cep,contatos,email from Paciente as p where p.cpf = '$cpf' ");
                    $this->consults = $query2;
                 //   $this->session->set('consults', $query2);
                    $this->session->getFlashBag()->add('info', 'Paciente cadastrado com sucesso');
                    return $this->render_view('registerinfo');
                }

            }
            catch ( InvalidArgument $e){
                $error=$e->getMessage();
            }
            catch ( \Throwable $e ){
                $error= 'error na gravacao do paciente';
            }
        }
        ob_start();
        include sprintf(__DIR__ . '/../view/register.php');
        return new Response( ob_get_clean());
    }

    public function registerinfoAction(){
        $this->session= new Session();
        if(!$this->access()){
            $this->session->getFlashBag()->add('info','Área restrita');
            return new RedirectResponse('/clinica/front.php/index');
        }
       return $this->render_view('registerinfo');
    }
    /**
     * contem todos logins autorizados na rota especifica
     * @return bool true para acesso liberado, false para acesso negado
     */
    public function access(){
        $permission = ['admin'];
        $this->session= new Session();
        $user = $this->session->get('user');
        if ( !in_array($user,$permission)){
            return false;
        }
        return true;
    }
    /**
     * @param Request $request
     * @return Response
     */
    public function  indexAction ( Request $request)
    {
        $this->session = new Session();
        $this->session->getFlashBag()->add('info','');
        return $this->render_view('index');
    }
    /**
     * verifica login e senha
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function  loginAction ( Request $request)
    {
        $this->session = new Session();
        if($request->getMethod()=='POST'){
            $user=['admin'=>'bfd98d1cce6e1aac1f0daa0bfaa7928653bfc3b9fbc950509c533c969dd6a9c8'];
            foreach($user as $login=>$pwd){
                if($request->request->get('uname')==$login &&
                hash("sha256",$request->request->get('psw').'5wh4xfz31')==$pwd){
                    $this->session->set('user',$login);
                    $this->session->getFlashBag()->add('info','Logado com sucesso');
                    return new RedirectResponse('/clinica/front.php/index');
                }
            }
            $this->session->getFlashBag()->add('info','Senha ou Usuário incorretos');
            return $this->render_view('login');
        }
        return $this->render_view('login');
    }

    /**
     * @param string $route
     * @return Response
     */
    public function render_view(string $route)
    {
        ob_start();
        include sprintf(__DIR__ . "/../view/$route.php");
        return new Response(ob_get_clean());
    }
}