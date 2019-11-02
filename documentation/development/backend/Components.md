# PandaFlix / Docs / Dev / Backend / Components

- **Location**: _app/Components/*_

## Table of Content
* [Structure](#structure)
    * [Database](#database)
    * [Repositories](#repositories)
    * [Resources](#resources)
    * [Tests](#tests)
        * [Feature](#feature)
        * [Unit](#unit)
    * [Controller](#controller)

## Structure
Everything that has to do with backend-code has it's own component.

This is what a default component looks like.
```
├── YourComponent
    ├── Database (communicate between model and controller)
    |       Component.php
    ├──────────────────────────────────────────────────────────
    ├── Repositories (communicate between model and controller)
    |       ComponentRepositories.php
    ├──────────────────────────────────────────────────────────
    ├── Resources (handles json responses)
    |       ComponentCollection.php
    |       ComponentResource.php
    ├──────────────────────────────────────────────────────────
    ├── tests (basic unit/feature tests)
    ├──── Feature
    |       ComponentApiControllerTest.php
    ├──── Unit
    |       ComponentCollectionTest.php
    |       ComponentRepositoryTest.php
    |       ComponentResourceTest.php
    ├──────────────────────────────────────────────────────────
    |   ComponentApiController.php
    ├──────────────────────────────────────────────────────────
```

A new component can easily be created by running the command
`php artisan make:component {ComponentName}`.

### Database
Here you will find stuff like the component model and anything other database related (except the repository).

### Repositories
### Why?!
At first, you're right, **Repositories are not needed in Laravel**.
The reason we implemented repos is simply to better organize our components.

If we simply would use the Models we would break our plan in splitting everything into it's own directory.
That's because we still would have a directly reference to the Models inside our Controllers.

### Resources

### Tests
If you are a dev and want to participate you properly know how to write Unit/Feature tests using [PHPUnit](https://phpunit.de/).
The only difference _(maybe you already know)_ is that test are specific for each component.

### Controller
