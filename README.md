## Description
This module was made for easy management of settings

## Pre-installation

This package is part of Netcore CMS ecosystem and is only functional in a project that has following packages
installed:

1. https://github.com/netcore/netcore
2. https://github.com/netcore/module-admin
3. https://github.com/netcore/module-translate

### Installation

 - Require this package using composer
```
    composer require netcore/module-setting
```

 - Publish configuration/migrations
```
    php artisan module:publish-config Setting
    php artisan module:publish-migration Setting
    php artisan migrate
```
 
### Configuration

 - Configuration file is available at config/netcore/module-setting.php

### Seeding settings

```php
    $settings = [
        [
            'group' => 'global',
            'name'  => 'Name',
            'key'   => 'key',
            'value' => 'value', // This will set this value to all languages
            // Or you can pass value as array and set different value in different language
            // 'value' => [
            //      'en' => 'value en',
            //      'lv' => 'value lv',
            // ],
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
            ],
            'is_translatable' => 0, // If you need different values for different languages, set this to 1(default is 0)
            'has_manager'     => 0, // If you have module-media, you can set this to 1 and set setting value to selected file url
        ]
    ];
	
    setting()->seed($settings);
```

### Usage

```php
    // Fetch setting by key
    setting()->get('global.key');
    
    // Optionally you can pass second parameter as the default value if the setting is not found
    setting()->get('global.key', 'default');
    
    // You can pass key variable as array to get multiple settings at once
    setting()->get(['global.one', 'global.two']);
    
    // Optionally you can pass second parameter as the default value as string or array and it will set defaults respectively
    setting()->get(['global.one', 'global.two'], ['default_one', 'default_two']);
    
    // Fetch all settings
    setting()->all();
    
    // Fetch grouped settings
    setting()->grouped();
```
