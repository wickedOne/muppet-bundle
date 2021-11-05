# muppet-bundle
symfony bundle for the [muppet generator](https://github.com/wickedOne/muppet)

[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%wickedOne%2Fmuppet-bundle%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/wickedOne/muppet-bundle/master)
[![codecov](https://codecov.io/gh/wickedOne/muppet-bundle/branch/master/graph/badge.svg)](https://codecov.io/gh/solrphp/solarium-bundle)
[![PHPStan static analysis](https://github.com/wickedOne/muppet-bundle/actions/workflows/phpstan.yml/badge.svg)](https://github.com/solrphp/solarium-bundle/actions/workflows/phpstan.yml)
[![coding standards](https://github.com/wickedOne/muppet-bundle/actions/workflows/coding-standards.yml/badge.svg)](https://github.com/solrphp/solarium-bundle/actions/workflows/coding-standards.yml)


## installation
to add this bundle to your dev dependencies use
```bash
composer require --dev wickedone/muppet-bundle
```

## configuration
add a ``wicked_one_muppet.yaml`` to your ``config/dev`` directory

```yaml
wicked_one_muppet:
  base_dir: '%kernel.project_dir%/src'
  test_dir: '%kernel.project_dir%/tests/Unit'
  fragments:
    - NameSpace
    - Tests
    - Unit
  author: john <john.doe@example.com>
```

## generation
in order to generate a phpunit test for you model / entity you can run the following command

```bash
$ php bin/console muppet:generate:test Foo
```

where ``Foo.php`` would be a model / entity class somewhere in you ``base_dir``

## test files
please read the assumptions the muppet library makes regarding your models.
the tests, most of the time, won't be perfect but will offer a descent starting point for a test covering your entire model / entity class.
