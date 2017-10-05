### Installation

 - TODO

### Seeding settings

```php
    use Modules\Setting\Models\Setting;
	
    $settings = [
        [
            'group' => 'global',
            'name'  => 'Name',
            'key'   => 'key',
            'value' => 'value',
            'type'  => 'select', // Available types: text, select, checkbox, file
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

 - Fetch setting by key
```php
    setting()->get('key');
    
    // Optionally you can pass second parameter as the default value if the setting is not found
    setting()->get('key', 'default');
    
    // You can pass key variable as array to get multiple settings at once
    setting()->get(['one', 'two']);
```

- Fetch all settings
```php
    setting()->all();
```
