# EMAIL VERIFIER AND CHECKER
 This is a simple laravel package that utilizes the [Email Verifier](https://email-checker.net) api to verify that a mailbox actually exists.
 
 ## What You Need 
[Email Checker .net](https://email-checker.net) requires credit for you to utilise the API. 
1. Head to their website and purchase credits.
2. Sign up on [RAPID Api](https://rapidapi.com)  to get an X-RapidAPI-Key

## Features
- [x] Mailbox Verifier
- [ ] Artisan command line verification
- [ ] Email Syntax Verifier
- [ ] Invalid emails log in table

## Installation
1. Install the package via composer `composer require maggz69/emailchecker`
2. If you are using Laravel version < 5.5 or you have disabled package auto discovery, then register the package Service 
provider through adding the following in `config>app.php`
    
    ` EmailChecker\EmailCheckerServiceProvier::class, `
3. Publish the email checker config file

    `php artisan vendor:publish --provider="EmailChecker\EmailCheckerServiceProvider"`

4. Add your `RAPID_API_KEY` in the env file, or the config file `config>emailchecker.php`(not advisable especially if you're using Version Control Systems / in production)

## Usage
To use the email checker, 

```php
$checker = new EmailChecker\Checker;

$result = $checker->check('hello@example.com');
 
if($result){
    //Email is valid Yaay
 }else{
    //Email is not valid dang
    dd($checker->getLastResponse());
 }
```
