<?php
namespace Germania\UsersRetailers;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class AssignUserToRetailer
{

    /**
     * Database table
     * @var string
     */
    public $table = "users_retailers";

    /**
     * @var PDOStatement
     */
    public $stmt;

    /**
     * @var LoggerInterface
     */
    public $logger;


    /**
     * @param PDO             $pdo     PDO instance
     * @param LoggerInterface $logger  Optional: PSR-3 Logger
     * @param string          $table   Optional: Database table name
     */
    public function __construct(\PDO $pdo, LoggerInterface $logger = null, $table = null)
    {
        // Setup
        $this->table  = $table  ?: $this->table;
        $this->logger = $logger ?: new NullLogger;


        // Prepare business
        $sql = "INSERT INTO {$this->table}
        (user_id, retailer_number)
        VALUES (:user_id, :retailer_number)";

        $this->stmt = $pdo->prepare( $sql );
    }


    /**
     * @param  int  $user_id
     * @param  int  $retailer_number
     *
     * @return bool
     */
    public function __invoke( $user_id, $retailer_number )
    {
        try {
            $result = $this->stmt->execute([
                'user_id'         => $user_id,
                'retailer_number' => $retailer_number
            ]);
        } catch(\PdoException $e) {
            if ($e->getCode() === "23000") {
                // Duplicate selector:
                // Not quite what we wanted, but useful in this case.
                $result = true;
            }
            else {
                throw $e;
            }
        }


        // Evaluate
        $loginfo = [
            'user_id'         => $user_id,
            'retailer_number' => $retailer_number,
            'result'          => $result
        ];

        if ($result):
            $this->logger->notice("Successfully assigned user to retailer number.", $loginfo);
        else:
            $this->logger->warning("Could not assign user to retailer number?!", $loginfo);
        endif;


        return $result;
    }


}
