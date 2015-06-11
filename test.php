<?php

require 'vendor/autoload.php';
require_once('src/Stef/ElasticBundle/Query/AbstractQueryBuilder.php');

use Stef\ElasticBundle\Query\AbstractQueryBuilder;

$params = [];
$params['hosts'] = ['elastic-server.dev:9200'];
$params['logging'] = true;
$params['logPath'] = '/var/logs/elasticsearch/elasticsearch.log';
$params['logPermission'] = 0664;

$q = new AbstractQueryBuilder();
$q->setIndex('bank');
$q->setType('account');
$q->addBoolMustMatch('city', 'Dellview');
$q->setSource(['city']);
$client = new Elasticsearch\Client($params);

$result = $client->search($q->getQuery());

var_dump($result);

//var_dump($q->getQuery());