<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 17/02/2017
 * Time: 15:49
 */
namespace tests\framework;
use framework\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class FrameworkTest extends \PHPUnit_Framework_TestCase
{

    public function mockcreation( $watchbehavior){//objeto falso
        $matcher = $this->createMock(Routing\Matcher\UrlMatcherInterface::class);
        $matcher->expects($this->once())
            ->method('match')
            ->will( $watchbehavior);

        $context = $this->createMock(Routing\RequestContext::class);
        $matcher->expects($this->once())
            ->method('getContext')
            ->will( $this->returnValue($context));

        $controllerResolver = new HttpKernel\Controller\ControllerResolver();
        $argumentResolver = new HttpKernel\Controller\ArgumentResolver();

        $framework = new framework($matcher,$controllerResolver,$argumentResolver);
        $response = $framework->handle(new Request());
        return  $response;
    }
    public function testHandle404()
    {
        $response= $this->mockcreation($this->throwException(new ResourceNotFoundException()));
        $this->assertEquals(404,$response->getStatusCode());
    }

    public function testHandle500()
    {
        $response = $this->mockcreation($this->throwException(new \Exception()));
        $this->assertEquals(500,$response->getStatusCode());
    }

    public function testHandleOK()
    {
        $response=$this->mockcreation($this->returnValue( [
            '_route'=> 'whatever',
            'name'=> 'Alessandro',
            '_controller'=>function ($name) {
                return new Response("Hello $name");
            }
        ]));
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertContains('Hello Alessandro',$response->getContent());
    }

}