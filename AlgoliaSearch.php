
<?php
require __DIR__ . '/vendor/autoload.php';
include('config.php');

$client = new \AlgoliaSearch\Client('STCRIU9DFR','0d126f8f883e86ae899aac3ce7ebda12'
);
$index = $client->initIndex('search_engine');




$data = $con->query("SELECT * FROM sites")->fetchAll();
foreach(array_chunk($data,1000) as  $chunck){

  $index->setSettings([
    // Select the attributes you want to search in
      'searchableAttributes' => [
        'title', 'description'
      ],
       // Define business metrics for ranking and sorting
      'customRanking' => [
        'desc(clicks)'
      ],

      // Set up some attributes to filter results on
      'attributesForFaceting' => [
        'clicks'
        ]
        ]);
        $index->addObjects($chunck);

}


    
?>
