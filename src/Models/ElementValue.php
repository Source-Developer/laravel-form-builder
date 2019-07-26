<?php

namespace IntoTheSource\LaravelFormBuilder\Models;

use Illuminate\Database\Eloquent\Model;

class ElementValue extends Model
{
    /**
     * @var string
     */
    protected $table = 'formbuilder_element_values';

    /**
     * @var array
     */
    protected $fillable = [
        'formbuilder_element_id',
        'active',
        'order',
        'name',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'formbuilder_element_id',
        'active',
        'created_at',
        'updated_at'
    ];
}
