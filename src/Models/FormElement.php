<?php

namespace IntoTheSource\LaravelFormBuilder\Models;

use Illuminate\Database\Eloquent\Model;

class FormElement extends Model
{
    /**
     * @var string
     */
    protected $table = 'formbuilder_elements';

    /**
     * @var array
     */
    protected $fillable = [
        'formbuilder_form_id',
        'active',
        'order',
        'required',
        'name',
        'placeholder',
        'help_block',
        'type',
    ];

    /**
     * @var array
     */
    protected $with = [
        'values'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'formbuilder_form_id',
        'active',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(ElementValue::class, 'formbuilder_element_id', 'id')
                    ->orderBy('order');
    }
}
