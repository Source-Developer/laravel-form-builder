<?php

namespace IntoTheSource\LaravelFormBuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    /**
     * @var string
     */
    protected $table = 'formbuilder_forms';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'emails',
        'success_message',
        'redirect_url',
        'confirm_email',
        'send_email',
        'save_data',
        'recaptcha',
        'recaptcha_private_key',
        'recaptcha_public_key',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'active',
        'emails',
        'confirm_email',
        'send_email',
        'save_data',
        'recaptcha_private_key',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $with = [
        'elements'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elements()
    {
        return $this->hasMany(FormElement::class, 'formbuilder_form_id', 'id')
                    ->orderBy('order');
    }
}
