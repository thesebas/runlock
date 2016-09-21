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
  -a, --action <arg>      lock or unlock [default: lock]
  -l, --lockname <arg>    lock name
  -n, --count <arg>       how many locks can be acquired [default: 1]
  -c, --config <arg>      path to file with params in .ini format [default: /etc/runlock/config.ini]
  -v, --verbose           verbose mode
  -h, --help              show help
```

## How to install
`composer global require thesebas/runlock:dev-master`
