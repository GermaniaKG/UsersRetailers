<?php
/**
 * This file is part of package germania/fachhaendlerbereich/core
 *
 * Copyright: Germania KG, Altenholz
 */
namespace Germania\UsersRetailers;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class RetailerNumberFinder
{

    public $table = 'users_retailers';

    /**
     * @var PDOStatement
     */
    public $stmt;

    /**
     * @var LoggerInterface
     */
    public $logger;


    public function __construct (\PDO $pdo, LoggerInterface $logger = null, $table = null)
    {
        $this->logger = $logger ?: new NullLogger;

        $this->table = $table ?: $this->table;

        $sql = "SELECT retailer_number
        FROM {$this->table}
        WHERE user_id = :user_id
        LIMIT 1";

        $this->stmt = $pdo->prepare( $sql );

    }

    /**
     * @param  int $user_id
     * @return mixed Retailer number or NULL
     */
    public function __invoke( $user_id )
    {
        $exec_result = $this->stmt->execute([
          ':user_id' => $user_id
        ]);

        return $this->stmt->fetch( \PDO::FETCH_COLUMN) ?: null;
    }
}
