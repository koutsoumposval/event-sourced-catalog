# Event Sourced Catalog

[![Build Status](https://travis-ci.org/koutsoumposval/event-sourced-catalog.svg?branch=master)](https://travis-ci.org/koutsoumposval/event-sourced-catalog.svg?branch=master)

An event sourced Category-Product catalog, Proof Of Concept project for the 
usage of [ProophEventSourcing][1]
Library.

[Proof][2] provides CQRS and EventSourcing Infrastructure for PHP

Bounded Contexts
----------------
There is one `Catalog` bounded context.
`Common` in a helper directory.

Composer Install
----------------
Run `composer install` to install all dependencies

Test
----------------
Tests (`phpunit`) can be found in `tests` directory.

[1]: https://github.com/prooph/event-sourcing
[2]: https://github.com/prooph