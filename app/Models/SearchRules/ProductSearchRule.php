<?php

namespace App\Models\SearchRules;

use ScoutElastic\SearchRule;

class ProductSearchRule extends SearchRule
{
    // This method returns an array, that represents bool query.
    public function buildQueryPayload()
    {
        return [
            'should' => [
                'query_string' => [
//                    'query' => $this->builder->query . ' OR *' . $this->builder->query . '*',
                    'query' => '*' . $this->builder->query . '*',
                ],
            ],



//            "intervals" => [
//                "name" => [
//                    "all_of" => [
//                        "intervals" => [
//                            "match" => [
//                                "query" => $this->builder->query,
//                            ]
//                        ],
//                    ],
//                ],
//            ],
        ];
    }

}
