https://moonshine-laravel.com/docs/resource/ui-components/ui-loader?change-moonshine-locale=en

------

# Loader  

The `moonshine::loader` component allows you to create a stylized loading indicator.
  
```php
<x-moonshine::loader />
```


<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xl:col-span-4">
    <div class="box">
    
    <div class="moonshine-loader text-center">
    <div class="loader">
        <svg viewBox="0 0 80 80">
            <circle id="test" cx="40" cy="40" r="32"></circle>
        </svg>
    </div>

    <div class="loader triangle">
        <svg viewBox="0 0 86 80">
            <polygon points="43 8 79 72 7 72"></polygon>
        </svg>
    </div>

    <div class="loader">
        <svg viewBox="0 0 80 80">
            <rect x="8" y="8" width="64" height="64"></rect>
        </svg>
    </div>
</div>
</div>
</div>
</div>

