<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;
use App\Models\SearchRules\ProductSearchRule;

class Product extends Model
{
    use Searchable;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
    ];

    protected $indexConfigurator = \App\Models\IndexConfigurators\ProductIndexConfigurator::class;

    protected $searchRules = [
        ProductSearchRule::class
    ];

    // Here you can specify a mapping for model fields
    protected $mapping = [
        'properties' => [
            'name' => [
                'type' => 'text',
//                'analyzer' => 'keyword'
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
//            'description' => [
//                'type' => 'text',
//                'analyzer' => 'keyword'
//            ],
        ]
    ];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
