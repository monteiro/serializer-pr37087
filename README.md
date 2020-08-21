# symfony 5.2 

This is a sample project where we can the bug and the fix.


| Q             | A
| ------------- | ---
| Branch?       | 5.2
| Bug fix?      | yes
| New feature?  | yes <!-- please update src/**/CHANGELOG.md files -->
| Deprecations? | no <!-- please update UPGRADE-*.md and src/**/CHANGELOG.md files -->
| Tickets       | Fix #32719  ... <!-- prefix each issue number with "Fix #", if any -->
| License       | MIT


I have just duplicated the PR https://github.com/symfony/symfony/pull/33650 (from @skalpa) but using the new component ErrorHandler and removing the priority.


### How to reproduce the bug?

```
  docker-compose up
  bin/console messenger:consume external_messages
  bin/console app:event:test
  bin/console messenger:failed:retry -vvv 
```

```
In PropertyAccessor.php line 201:                                                                                                                          
  [Symfony\Component\PropertyAccess\Exception\InvalidArgumentException]                                                      
  Expected argument of type "Symfony\Component\Debug\Exception\FlattenException", "null" given at property path "previous".  
                                                                                                                             
```

### Solution

- Create a FlattenException Normalizer into the Serializer Component.
- Take into account that in this specific case the headers (in AMQP) are saved as json (because we are using the symfony serializer json format instead of the default php serializer).
