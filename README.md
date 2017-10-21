# Event Sourced Catalog

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/b61bab2d81f748879604bef46bbd47f8)](https://www.codacy.com/app/koutsoumposval/event-sourced-catalog?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=koutsoumposval/event-sourced-catalog&amp;utm_campaign=Badge_Grade)
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