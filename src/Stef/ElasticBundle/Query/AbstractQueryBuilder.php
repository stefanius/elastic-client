<?php

namespace Stef\ElasticBundle\Query;

abstract class AbstractQueryBuilder
{
    protected $source = [];

    protected $index;

    protected $type;

    protected $query = [];

    protected $params = [];

    protected $from = 0;

    protected $size = 10;

    protected $sort = [];

    function __construct($params)
    {
        $this->params = $params;
    }

    abstract protected function build();

    /**
     * @param mixed $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param array $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @param int $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function addToSource($source)
    {
        if (is_array($source)) {
            $this->source = array_merge($this->source, $source);
        } else {
            $this->source[] = $source;
        }
    }

    public function addToSort($field, $direction)
    {
        $this->sort[$field]['order'] = $direction;
    }

    public function paginated($page, $size, $firstPageIsZero = true)
    {
        $this->setSize($size);
        $this->setFrom($page * $size);
    }

    public function getQuery()
    {
        $query['query'] = $this->query;

        if (is_array($query['query']) && count($query['query']) === 0) {
            $query['query']['match_all'] = new \stdClass();
        }

        if (is_array($this->source) && count($this->source) > 0) {
            $query['_source'] = $this->source;
        }

        $query['from'] = $this->from;
        $query['size'] = $this->size;

        return [
            'body' => $query,
            'index' => $this->index,
            'type' => $this->type
        ];
    }
}