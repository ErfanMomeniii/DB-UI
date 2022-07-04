<?php
class db_model {

    public function __construct()
    {
        $cluster   = Cassandra::cluster()
            ->build();
        $keyspace  = 'system';
        $session   = $cluster->connect($keyspace);
        $statement = new Cassandra\SimpleStatement(
            'SELECT keyspace_name, columnfamily_name FROM schema_columnfamilies'
        );
        $future    = $session->executeAsync($statement);
        $result    = $future->get();
    }
}