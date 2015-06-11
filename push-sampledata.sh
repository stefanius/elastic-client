#!/usr/bin/env bash
curl -XPOST 'elastic-server.dev:9200/bank/account/_bulk?pretty' --data-binary @accounts.json
curl 'elastic-server.dev:9200/_cat/indices?v'
