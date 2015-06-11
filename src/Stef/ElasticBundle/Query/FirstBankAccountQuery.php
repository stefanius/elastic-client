<?php

namespace Stef\ElasticBundle\Query;

class FirstBankAccountQuery extends AbstractQueryBuilder
{
    protected function build()
    {
        /*
           {
              "query": { "match_all": {} },
              "from": 10,
              "size": 10,
              "sort": { "balance": { "order": "desc" } },
              "_source": ["account_number", "balance"]
            }
         */

        $this->query[];
    }
}