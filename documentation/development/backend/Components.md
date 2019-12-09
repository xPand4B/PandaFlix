# PandaFlix / Docs / Dev / Backend / Components

- **Location**: _app/Components/*_

## Table of Content
* [Structure](#structure)
    * [Database](#database)
    * [Repositories](#repositories)
    * [Resources](#resources)
    * [Routes](#routes)
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
    ├── Routes (Component web/api routes)
    |       api.php
    |       web.php
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

If we would use the Models we would break our plan in splitting everything into it's own directory.
That's because we still would have had a direct reference to the Models inside our Controllers.

A repository should implement the `RepositoryInterface` in order to get all default operations.

### Resources
There are two default resources.
- `ComponentCollection`
    - The Collection basically just calls the normal resource as a collection.
    
- `ComponentResource`
    - The Resource contains all fields that should be returned by the api.

Resources should follow this structure:
```php
// Add additional data like the project version and response-type
$this->with = PandaFlix::ResourceAdditions();

return [
    'type' => Component::class,
    'id' => (string)$this->id,
    
    'attributes' => [
        // All fields that should be displayed
    ],
    
    'relationships' => [
        // Relationships to the model
    ],
    
    links => [
        'self => // the 'show' route,
        'related' => // some related stuff, if not available null
    ]
];
```

### Routes
Here you will find the api and web route files for the given component.

### Tests
If you are a dev and want to participate you properly know how to write Unit/Feature tests using [PHPUnit](https://phpunit.de/).
The only difference _(maybe you already know)_ is that test are specific for each component.

### Controller
