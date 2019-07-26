# Laravel form builder

## Installation

Add the following to your composer.json
```
{
  "repositories": [{
    "type": "composer",
    "url": "https://composer.intothesource.com"
  }]
}
```

and install via composer
```
composer require intothesource/laravel-form-builder
``` 

### Register Service Provider

> Note! This and next step are optional if you use laravel>=5.5 with package
auto discovery feature.

Add service provider to `config/app.php` in `providers` section
```php
IntoTheSource\LaravelFormBuilder\ServiceProvider::class,
```

### Register Facade

Register package facade in `config/app.php` in `aliases` section
```php
'Formbuilder' => IntoTheSource\LaravelFormBuilder\Facades\LaravelFormBuilder::class,
```

## Usage

### Migrate the migrations
```bash
php artisan migrate
```

### Build the form
```php
<?php
$form = Formbuilder::form()->create([
    'name'                  => '',      // Validations: required|string       Default: null
    'active'                => '',      // Validations: required|boolean      Default: false
    'emails'                => '',      // Validations: nullable|string       Default: null
    'success_message'       => '',      // Validations: nullable|string       Default: null
    'redirect_url'          => '',      // Validations: nullable|string       Default: null
    'confirm_email'         => '',      // Validations: required|boolean      Default: false
    'send_email'            => '',      // Validations: required|boolean      Default: false
    'save_data'             => '',      // Validations: required|boolean      Default: false
    'recaptcha'             => '',      // Validations: required|boolean      Default: false
    'recaptcha_private_key' => '',      // Validations: nullable|string       Default: null
    'recaptcha_public_key'  => '',      // Validations: nullable|string       Default: null
]);
```

### Adding elements
```php
<?php
$element = $form->element()->create([
     'formbuilder_form_id' => '',        // Validations: required|integer      Default: Autofilled
     'active'              => '',        // Validations: required|boolean      Default: false 
     'order'               => '',        // Validations: integer|nullable      Default: null
     'required'            => '',        // Validations: required|boolean      Default: false
     'name'                => '',        // Validations: required|string       Default: null
     'placeholder'         => '',        // Validations: string|nullable       Default: null
     'help_block'          => '',        // Validations: string|nullable       Default: null
     'type'                => '',        // Validations: required|string       Default: null
 ]);
```

### Adding values
```php
<?php
$value = $element->value()->create([
    'formbuilder_element_id' => '',      // Validations: required|integer     Default: Autofilled
    'active'                 => '',      // Validations: required|boolean     Default: false
    'order'                  => '',      // Validations: integer|nullable     Default: null
    'name'                   => '',      // Validations: required|string      Default: null
 ]);
```

### Building the form
```php
<?php
$array = $form->build()->toArray();
Array response example:
/**
 array (
   'id' => 1,
   'name' => 'Test formulier',
   'success_message' => NULL,
   'redirect_url' => NULL,
   'recaptcha' => 0,
   'recaptcha_public_key' => NULL,
   'elements' => 
   array (
     0 => 
     array (
       'id' => 1,
       'order' => NULL,
       'required' => 0,
       'name' => 'Test element',
       'placeholder' => NULL,
       'help_block' => NULL,
       'type' => 'text',
       'values' => 
       array (
       ),
     ),
     1 => 
     array (
       'id' => 2,
       'order' => NULL,
       'required' => 0,
       'name' => 'select test',
       'placeholder' => NULL,
       'help_block' => NULL,
       'type' => 'select',
       'values' => 
       array (
         0 => 
         array (
           'id' => 1,
           'order' => NULL,
           'name' => 'Waarde 1',
         ),
         1 => 
         array (
           'id' => 2,
           'order' => NULL,
           'name' => 'Waarde 2',
         ),
         2 => 
         array (
           'id' => 3,
           'order' => NULL,
           'name' => 'Waarde 3',
         ),
         3 => 
         array (
           'id' => 4,
           'order' => NULL,
           'name' => 'Waarde 4',
         ),
       ),
     ),
   ),
 )
*/

$json  = $form->build()->toJson();

/**
Json response example:
 {
     "id": 1,
     "name": "Test formulier",
     "success_message": null,
     "redirect_url": null,
     "recaptcha": 0,
     "recaptcha_public_key": null,
     "elements": [{
         "id": 1,
         "order": null,
         "required": 0,
         "name": "Test element",
         "placeholder": null,
         "help_block": null,
         "type": "text",
         "values": []
     }, {
         "id": 2,
         "order": null,
         "required": 0,
         "name": "select test",
         "placeholder": null,
         "help_block": null,
         "type": "select",
         "values": [{
             "id": 1,
             "order": null,
             "name": "Waarde 1"
         }, {
             "id": 2,
             "order": null,
             "name": "Waarde 2"
         }, {
             "id": 3,
             "order": null,
             "name": "Waarde 3"
         }, {
             "id": 4,
             "order": null,
             "name": "Waarde 4"
         }]
     }]
 }
*/

```

## Updating forms/elements/values
### Updating a Form
```php
<?php
$form = Formbuilder::form()-load(25);
$form->update([
    'emails'                => 'test@example.com, me@you.org',
    'success_message'       => 'Yes, you did it right!',
]);
```

### Updating a Element
```php
<?php
$element = Formbuilder::element()-load(69);
$element->update([
    'name'                => 'Voornaam',
    'placeholder'         => 'John Doe',
]);
```

### Updating a Value
```php
<?php
$element = Formbuilder::value()-load(12);
$element->update([
    'active'                 => true,
]);
```

## Deleting Forms/element/values
### Deleting a Form
```php
<?php
$form = Formbuilder::form()-load(25)->delete();
// or
$form = Formbuilder::form()->delete(25);
```
This removes the form with all the elemenets and values

### Deleting a Element
```php
<?php
$element = Formbuilder::element()-load(69)->delete();
// or
$element = Formbuilder::element()->delete(25);
```
This removes the element with all the values

### Deleting a Value
```php
<?php
$value = Formbuilder::value()-load(12)->delete();
// or
$value = Formbuilder::value()->delete(12);
```
This removes only a value

## Security
If you discover any security related issues, please email rsmit@intothesource.com
instead of using the issue tracker.

## Credits

- [Ramon Smit](https://github.com/intothesource/laravel-form-builder)
- [All contributors](https://github.com/intothesource/laravel-form-builder/graphs/contributors)
