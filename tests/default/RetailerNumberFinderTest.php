<?php
namespace tests;

use Germania\UsersRetailers\RetailerNumberFinder;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Prophecy\Argument;


class RetailerNumberFinderTest extends \PHPUnit_Framework_TestCase
{

    public $logger;


    public function setUp()
    {
        parent::setUp();
        $this->logger = new NullLogger;
    }


    public function testInstantiation(  )
    {
        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt_mock = $stmt->reveal();

        $pdo_mock = $this->createPdoMock( $stmt_mock );

        $sut = new RetailerNumberFinder( $pdo_mock, $this->logger);
        $this->assertInstanceOf( \PDOStatement::class, $sut->stmt );
    }


    /**
     * @dataProvider providerUserIdAndResult
     */
    public function testNormalUsage( $user_id, $fetch_result, $expected_result )
    {
        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->execute( Argument::any() )->willReturn ( true );
        $stmt->fetch( Argument::any() )->willReturn ( $fetch_result );
        $stmt_mock = $stmt->reveal();

        $pdo_mock = $this->createPdoMock( $stmt_mock );

        $sut = new RetailerNumberFinder( $pdo_mock, $this->logger);

        $result = $sut( $user_id );
        $this->assertSame( $result, $expected_result);
    }



    public function providerUserIdAndResult()
    {
        return array(
            [1,  '100000',  '100000'],
            [99, false, null],
            [99, array(), null]
        );
    }



    protected function createPdoMock( $stmt )
    {
        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt );
        return $pdo->reveal();
    }

}
