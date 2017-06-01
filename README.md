## Booking Demo; functional TDD attempt
_Work in progress.._

[![Build Status](https://travis-ci.org/AlexMasterov/booking-tdd-demo.svg)](https://travis-ci.org/AlexMasterov/booking-tdd-demo)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/AlexMasterov/booking-tdd-demo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/AlexMasterov/booking-tdd-demo/?branch=master)

## Challenge
* Decoupling decisions from effects

  **Solution:** The world is impure. Instead, we strive towards implementing as much of our code base as pure functions, so that an application is impure only at its boundaries. Using functional composition with monads, we can succinctly conditionally compose from pure and impure functions.

  **Benefits:** Pure functions only makes a decision based on input, and returns information about this decision as output, so is easy to unit test. Impure functions are used as [humble functions](http://xunitpatterns.com/Humble%20Object.html) that you may don't need to unit test. Impure functions can call pure functions, so at the boundary, an application must gather impure data, and use it to call pure functions. This [automatically leads to the ports and adapters architecture](http://blog.ploeh.dk/2016/03/18/functional-architecture-is-ports-and-adapters).

## Requirements
To run this application, you will need:

 * [PHP 7.1](https://secure.php.net/downloads.php)
 * [composer](https://getcomposer.org/)
 * [ext-pdo](https://secure.php.net/manual/en/book.pdo.php)
 * [ext-pdo_sqlite](https://secure.php.net/manual/en/ref.pdo-sqlite.php)

## Installation

```sh
composer install
composer sqlite
```

## Usage

```sh
composer serve
```

### Example request
```bash
curl -X POST http://localhost/reservations/ \
 -H 'Content-Type: application/json' \
 -d '{"date": "Y-m-d H:i:s", "name": "Some name", "email": "Some email", "quantity": 1}'
```
