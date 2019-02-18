<?php
namespace mysql;

use Germania\UsersRetailers\AssignUserToRetailer;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Prophecy\Argument;


class AssignUserToRetailerTest extends DatabaseTestCaseAbstract
{

    public $logger;


    public function setUp()
    {
        parent::setUp();
        $this->logger = new NullLogger;
    }

    public function getDataSet()
    {
        return $this->createMySQLXMLDataSet(__DIR__ . '/../users-retailers-dataset.xml');
    }



    public function testInstantiation(  )
    {
        $pdo_mock = $this->getPdo();

        $sut = new AssignUserToRetailer( $pdo_mock, $this->logger);
        $this->assertInstanceOf( \PDOStatement::class, $sut->stmt );
    }


    /**
     * @dataProvider providerUserIdAndResult
     */
    public function testNormalUsage( $user_id, $retailer_number, $expected_result )
    {
        $pdo_mock = $this->getPdo();

        $sut = new AssignUserToRetailer( $pdo_mock, $this->logger);

        $result = $sut( $user_id, $retailer_number );
        $this->assertSame( $result, $expected_result);
    }


    /**
     * @dataProvider providerUserIdAndResult
     */
    public function testDuplicateUsage( $user_id, $retailer_number, $expected_result )
    {
        $pdo_mock = $this->getPdo();

        $sut = new AssignUserToRetailer( $pdo_mock, $this->logger);

        // Make sure entry exists
        $sut( $user_id, $retailer_number );

        // Provocate PDOException 23000 (Duplicate Selector)
        $result = $sut( $user_id, $retailer_number );
        $this->assertSame( $result, $expected_result);
    }


    public function providerUserIdAndResult()
    {
        return array(
            [1,  '200000', true]
        );
    }



    protected function createPdoMock( $stmt )
    {
        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt );
        return $pdo->reveal();
    }

}
