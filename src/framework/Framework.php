<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 17/02/2017
 * Time: 13:33
 */
namespace framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Framework
{
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    public function __construct(UrlMatcherInterface $matcher , ControllerResolverInterface $controllerResolver,
                                ArgumentResolverInterface $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function  handle(Request $request )
    {
        $this->matcher->getContext()->fromRequest($request);
        try{
            $request->attributes->add($this->matcher->match($request->getPathInfo()));
        }
        catch (ResourceNotFoundException $e){
            $request->attributes->add($this->matcher->match('/index'));
        }
        catch (\Exception $e){
            return new Response('Erro no servidor',500);
        }
        $controller = $this->controllerResolver->getController($request);
        $arguments= $this->argumentResolver->getArguments($request,$controller);
        return call_user_func_array($controller,$arguments);

    }
}
