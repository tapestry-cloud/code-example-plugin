# Tapetry Asset Plugin

## Install

To install run: `composer require tapestry-cloud/code-example-plugin`
 
Next you need to update your site configuration to include the path to your code examples folder: 

```php
// ...

    'plugins' => [
        'code_example_path' => __DIR__ . '/code_examples/'
    ],

// ...
```

Finally within your site Kernel.php you need to register the plugin's service provider:

```php
<?php

use Tapestry\Modules\Kernel\KernelInterface;

class Kernel implements KernelInterface
{
    /**
     * @var Tapestry
     */
    private $tapestry;
    
    public function __construct(Tapestry $tapestry)
    {
        $this->tapestry = $tapestry;
    }
    
    /**
     * This method is executed by Tapestry when the Kernel is registered.
     *
     * @return void
     */
    public function register()
    {
        // Use project autoloader
        require_once(__DIR__ . '/vendor/autoload.php');
    }
    
    /**
     * This method of executed by Tapestry as part of the build process.
     *
     * @return void
     */
    public function boot()
    {
        $this->tapestry->register(\TapestryCloud\CodeExample\ServiceProvider::class);
    }
}
```

## Usage

This plugin adds the `$this->codeExample('example.php')` helper, which will output your code examples with their html entities encoded. 