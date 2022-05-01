# Habbo-Forum
Habbo-Forum is a PHP written project where you can build your own forum community. 
It is ideal for a maintenance mode or a fansite.

## Why this Project?
Habbo forum was developed back in 2016 and served as a maintenance site. Even though
forums are now considered almost dead, I wanted to refactor this old project. It is a learning project and was developed to get to know new things, but also to represent my current state of knowledge adequately.

## Current state of this Project
The Habbo forum is still under development. It is still missing some and important functionalities that will make the forum experience more pleasant both for the user and for moderation purposes.

### To-Do Liste
- Register & Login
- User Rights (Close threads, open threads, lock user, delete post and so one)
- Create thread and fill in meta information (like thread type)
- Text formatting in your own editor
- User statistics

The to-do list might be incomplete!

## Usage
Install the project and run ``composer install`` to download the dependencies like Twig. Configure your project under ``app\lib\Config\Config.php``.

### Add Route
You can add a POST route with the following command:

```php
$route->addRoute('POST', ['url' => '/YOURURL'], function(){
    //CALLBACK
});
```

The third parameter is **optional** and excepts a functions which serves as callback.

### Add route with Twig template as callback
The following example shows a POST route that loads a Twig template as a callback

```php 
$route->addRoute('GET', ['url' => '/example'], function() {
    echo (new TemplateHandler('overview', '/example/info'))->renderTemplate(['name' => 'Wieland']);
});
```

### TemplateHandler 
With the TemplateHandler it is possible to render new pages as well as single HTML pieces via
Twig to render.

Example:
```php 
echo (new TemplateHandler('overview', '/example/info'))->renderTemplate(['name' => 'Wieland']);
```
The ``constructor`` of the ``TemplateHandler`` class expects two parameters of type string.
The first parameter must contain the name of the file to be called. The second parameter contains
the file path of the calling file.

The ``renderTemplate`` method renders the inputs and takes an array as an optional parameter, which are appended to the Twig template.

You can also display individual elements of a Twig page. Use here for the method ``displayTemplate()``. Example:

```php
echo (new TemplateHandler('thread', '/forum'))->displayTemplate([]);
```
