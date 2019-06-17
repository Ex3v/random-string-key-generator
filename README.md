### Random String Key Generator

This little library makes it easy to generate short, unique, YouTube-like IDs that you can use instead of UUID in your application. 

Using shorter (but still unique) ids will have positive inpact on database performance (especially MySQL, which don't handle UUID well).

This library consists of both generator itself, as well as Doctrine integration.

It allows you to customize length of default generator, as well as to write generators of your own.

##### Will it REALLY generate short unique ids?

Let's look at how many unique values can standard 8 characters long sequence have:
 
```
Example id:

9ZGpFadq

8 characters, each can have one of 64 values.

64^8 = 281 474 976 710 656 different values

```
 
In the end even UUID might not be unique, it depends on the way you see it. In the end, unless you're using really short ids, it's very close to impossible to get two duplicate strings.
I ran multiple tests of generating large amounts of ids (tens of millions) in very short time and couldn't make it to get two duplicate ids.

If you are really afraid of duplicate values, you can extend the key length, but in general this is not neccesary.

### 1. Installation

Use Composer to install it:

```bash
composer require ex3v/random-string-key-generator
```

### 2. Usage

#### Generating ID manually

```php
$factory   = new GeneratorFactory();
$generator = $factory->getGenerator(); //will give you default generator with basic config

$id = $generator->generateId();
```

#### Generating ID automatically in Doctrine

Just set up generator annotations (`GeneratedValue(strategy="CUSTOM")` and `CustomIdGenerator(...)`) on top of field declaration.
```php
/**
 * @var string
 *
 * @ORM\Id()
 * @ORM\Column(name="id", type="string")
 * @ORM\GeneratedValue(strategy="CUSTOM")
 * @ORM\CustomIdGenerator(class="Ex3v\RandomStringKeyGenerator\Doctrine\RandomStringKeyGenerator")
 */
 private $id;
```

#### Changing default settings

This library comes with single generator, that returns 8 characters long strings.

##### Changing default key length and other default settings

```php
//now default generator will return 12 characters long keys
GeneratorFactory::setDefaultStrategy(UniqIdBasedGenerator::class, [GeneratorInterface::KEY_LENGTH => 12]);
```


##### Getting instance of your own generator

```php
$factory = new GeneratorFactory();

$generator = $factory->getGenerator(YourGeneratorImplementingGeneratorInterface::class, ['generator' => 'options']);
```

##### I want to change default generator config for Doctrine and Symfony. How can I do that?

Unfortunately, Doctrine metadata factory restricts from passing any parameters or container parameters/services to ID Generators. Your only option here is to set GeneratorFactory defaults before app initialization. In case of Symfony, the place you're looking for is Kernel class.



### 3. Testing

Just run
```bash
composer test
```
in this repository, to run the test suite.

### 4. Contribution

Have idea on how to develop it? Found a bug and want to fix it? Pull Requests and Issues are welcome :)
