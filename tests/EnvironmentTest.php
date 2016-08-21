<?php
namespace Dsc\MercadoLivre;

use Dsc\MercadoLivre\Environments\Production;
use Dsc\MercadoLivre\Environments\Test;

/**
 * @author Diego Wagner <diegowagner4@gmail.com>
 */
class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Environment
     */
    private $environment;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->environment = $this->getMockForAbstractClass(Environment::class);

        $this->environment->expects($this->any())
             ->method('getWsAuth')
             ->willReturn('test.com');

        $this->environment->expects($this->any())
             ->method('getWsHost')
             ->willReturn('ws.test.com');
    }

    /**
     * @test
     */
    public function isValidShouldReturnTrueWhenHostIsProduction()
    {
        $this->assertTrue(Environment::isWsHostValid(Production::WS_HOST));
    }

    /**
     * @test
     */
    public function isValidShouldReturnTrueWhenHostIsTest()
    {
        $this->assertTrue(Environment::isWsHostValid(Test::WS_HOST));
    }

    /**
     * @test
     */
    public function isValidShouldReturnTrueWhenRegionExistsInEnvironments()
    {
        $this->assertTrue(Environment::isWsAuthValid("MLB"));
    }

    /**
     * @test
     */
    public function isValidShouldReturnFalseWhenRegionNotExistsInEnvironments()
    {
        $this->assertFalse(Environment::isWsAuthValid("AAA"));
    }
}