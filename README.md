### Installation

 - Require this package using composer
```
    composer require netcore/module-setting
```

 - Publish configuration
```
    php artisan module:publish-config Setting
```
 
### Configuration

 - Cache key name
```
    // Default key is - settings
    'cache_key' => 'settings'
```

 - Upload path for file type
```
    // Default path is - /uploads/settings
    'upload_path' => '/uploads/settings'
```

### Seeding settings

```php
    use Modules\Setting\Models\Setting;
	
    $settings = [
        [
            'group' => 'global',
            'name'  => 'Name',
            'key'   => 'key',
            'value' => 'value',
            'type'  => 'select', // Available types: text, textarea, select, checkbox, file
            'meta'  => [
                // Here you can specify what HTML attributes you want for this input
                'attributes' => [
                    'required'  => 'required',
                    'min'       => '0',
                    'max'       => '100'
                ],
                // Here you can specify what data select input will have.
                // You can pass it as array or string (it will be called as a function)
                'options'    => [
                    'one'  => 'One',
                    'two'  => 'Two'
                ]
            ]
        ]
    ];
	
    foreach ($settings as $setting) {
        Setting::create($setting);
    }
```

### Usage

```php
    // Fetch setting by key
    setting()->get('key');
    
    // Optionally you can pass second parameter as the default value if the setting is not found
    setting()->get('key', 'default');
    
    // You can pass key variable as array to get multiple settings at once
    setting()->get(['one', 'two']);
    
    // Optionally you can pass second parameter as the default value as string or array and it will set defaults respectively
    setting()->get(['one', 'two'], ['default_one', 'default_two']);
    
    // Fetch all settings
    setting()->all();
```
