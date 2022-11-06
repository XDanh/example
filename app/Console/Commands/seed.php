<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laudis\Neo4j\Basic\Session;

class seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private Session $session;
    public function __construct(Session $session)
    {
        $this->session = $session;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

/*         $this->session->run(<<<'CYPHER'
        LOAD CSV FROM 'file:///movies.csv' AS line
        create (m:Movie {movieID: line[0], title: line[1], genres: line[2]})
        CYPHER
        ); */
        $result = $this->session->run(<<<'CYPHER'
        MERGE (neo4j:Database {name: $dbName})
        RETURN neo4j
        CYPHER, ['dbName' => 'danh']);

        $neo4j = $result->getAsCypherMap(0)->getAsNode('neo4j');


        // Outputs "neo4j is 10 out of 10"
        echo ($neo4j->getProperty('name').' is ');
/*     foreach ($result->getResults() as $record) {
             echo sprintf('Person name is : %s', $record->get('p')->value('movieID')) . "\n";
             echo sprintf('Person name is : %s', $record->get('p')->value('title')) . "\n";
             echo sprintf('Person name is : %s', $record->get('p')->value('genres')) . "\n";
         } */
    }
}
