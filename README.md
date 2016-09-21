# runlock

## Help
```
runlock <options>
    acquire/free lock

    exit codes:
    0 - lock acquired
    1 - failed acquiring lock
    2 - other error

Options:
  -a, --action <arg>      lock or unlock
  -l, --lockname <arg>    lock name
  -n, --count <arg>       how many locks can be aquired
  -h, --help
```

## How to install
`composer global install thesebas/runlock`
