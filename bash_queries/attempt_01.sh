#!/usr/bin/env bash
curl -XPOST 'elastic-server.dev:9200/bank/_search?pretty' -d '
{
  "query": { "match_all": {} },
  "from": 10,
  "size": 10,
  "sort": { "balance": { "order": "desc" } },
  "_source": ["account_number", "balance"]
}'