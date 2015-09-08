# PHP Value Objects

*This is a proof-of-concept and very much a work-in-progress*

## What Are Value Objects? ##
A value object is simply an object that is meant to have minimal functionality and retains a single value. In fully object oriented languages all values are objects, but since PHP is not fully OO we don't have this functionality. This library is an example of a possible implementation of value objects in PHP

## Why Do We Need Them? ##
We don't! But that's not the point. Value Objects can be incredibly useful. In some languages it's possible to extend other primitives, so for example you could create an email address object which extends a string. An email address is just a string, so all string functions should work on an email address object. The only difference between a string and an email address is that the email address has very specific rules about what is and isn't acceptable.

In PHP we will often pass a string around which contains an email address, but we never know that it IS an email address unless we validate it at that step. Unfortunately that often leads to us needing to validate at multiple steps to be sure that a) it was an email address in the first place and b) that it's still an email address.

So this is where Value Objects (herein called simply VOs) come in. If we create a new email address object we can pass it around our code and type hint it in our arguments. For example:

```php
function echoEmail(EmailAddress $em)
{
    echo $em;
}
```

There's no way that this won't be an email address now. That's incredibly useful because we never need to validate, simply type hint the argument in our functions, class methods etc.

## What Happens If The Value Changes? ##
In this implementation, it can't. The object is _immutable_. That is, you can set it in the constructor, and you can retrieve the value, but you can't ever change the value. You can replace it, but you'll need to replace it with another new email address object and that will also have to be validated.

## What If I Don't Like Your Validation? ##
I don't expect you to. I implemented some simple validation but it's only an example. You can add your own validator and as long as it implements the `PVO\Validators\Interfaces\Validator` interface then you can write your own. You simply need to return true if validation is successful and throw `PVO\Exceptions\InvalidValueException` if it isn't.

Why throw an exception? Because if your value isn't appropriate then I need something more dramatic than just returning a bool, for example. This needs to be caught and handled properly. At the moment the VO constructor itself will throw a new `PVO\Exceptions\InvalidValueException` itself but I'll be sorting this out soon :)

## There Aren't Many Implementations. What Use Is This? ##
This wasn't meant as a serious library for you to implement in your application, though I would be quite pleased if it does grow to such a state. However, the point was for people to fork it, add their own, and then submit a PR back to me so that we can add your VOs into the library. Maybe one day it will become useful to others

## How To Install ##
Installation is via [Composer](https://getcomposer.org/), of course. Simply `composer require antnee/php-value-objects` from within your project or add this to your composer.json and run `composer update`:

```json
{
    "require": {
        "antnee/php-value-objects": "*"
    }
}
```

and you will have the latest dev version. I'll tag stable releases if we ever get that far
