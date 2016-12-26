<?php
/**
 * This file is part of the Kappa\Deaw package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 *
 * @testCase
 */

namespace KappaTests\Deaw\Utils;

use Dibi\Fluent;
use Kappa\Deaw\Utils\DibiWrapper;
use KappaTests\Deaw\Tests\FetchQueryObject;
use KappaTests\Deaw\Tests\InvalidQueryObject;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * Class DibiWrapperTest
 * @package KappaTests\Deaw\Utils
 */
class DibiWrapperTest extends TestCase 
{
    /** @var DibiWrapper */
    private $dibiWrapper;

    protected function setUp()
    {
        $connectionMock = \Mockery::mock('\Dibi\Connection');
        $dibiFluent = new Fluent($connectionMock);
        $queryBuilderMock = \Mockery::mock('\Kappa\Deaw\Query\QueryBuilder');
        $queryBuilderMock->shouldReceive('createQuery')->once()->andReturn($dibiFluent);

        $this->dibiWrapper = new DibiWrapper($queryBuilderMock);
    }

    public function testValidQuery()
    {
        Assert::type('\Dibi\Fluent', $this->dibiWrapper->processQuery(new FetchQueryObject()));
    }

    public function testInvalidQuery()
    {
        Assert::exception(function () {
            $this->dibiWrapper->processQuery(new InvalidQueryObject());
        }, '\Kappa\Deaw\MissingBuilderReturnException');
    }
}


\run(new DibiWrapperTest);