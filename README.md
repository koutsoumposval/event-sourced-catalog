# Event Sourced Catalog

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/b61bab2d81f748879604bef46bbd47f8)](https://www.codacy.com/app/koutsoumposval/event-sourced-catalog?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=koutsoumposval/event-sourced-catalog&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/b61bab2d81f748879604bef46bbd47f8)](https://www.codacy.com/app/koutsoumposval/event-sourced-catalog?utm_source=github.com&utm_medium=referral&utm_content=koutsoumposval/event-sourced-catalog&utm_campaign=Badge_Coverage)
[![Build Status](https://travis-ci.org/koutsoumposval/event-sourced-catalog.svg?branch=master)](https://travis-ci.org/koutsoumposval/event-sourced-catalog.svg?branch=master)

An event sourced Category-Product catalog, Proof Of Concept project for the 
usage of [ProophEventSourcing][1]
Library.

[Proof][2] provides CQRS and EventSourcing Infrastructure for PHP

Known Problems
----------------
There is a known problem in `prooph/common` dependency.
Failing tests caused by a wrong Assertion:
```
# MessageDataAssertion.php Line 71
Assertion::nullOrscalar($payload, 'payload must only contain arrays and scalar values');
# Failing when payload are Value Objects

# Change with
Assertion::nullOrNotEmpty($payload, 'payload must be null or not Empty');
```
A Pull Request (rejected) has been made [here][3]

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
[3]: https://github.com/prooph/common/pull/64