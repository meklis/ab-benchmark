# Wrapper for apache benchmark

### Install:
Must be installed: 
- PHP 7+  
- git 
- composer 
- PHP modules: php-{curl,yaml,json}   

Install commands:   
```text
git clone https://github.com/meklis/ab-benchmark.git
cd ab-benchmark
composer install 
```

### Usage: 
``` 
./console ab:load --help
Usage:
  ab:load [options] [--] <address>

Arguments:
  address                          Address of page to testing

Options:
  -C, --concurrency[=CONCURRENCY]  Set list of concurencies [default: "10,20,30,40,50"]
  -T, --timeout[=TIMEOUT]          Set timeout for iteration of cuncurencies [default: 0]
  -N, --number[=NUMBER]            Number of requests [default: 0]
  -f, --format[=FORMAT]            Type of output, variants: table|json|yaml|csv [default: "table"]
  -h, --help                       Display help for the given command. When no command is given display help for the list command
  -q, --quiet                      Do not output any message
  -V, --version                    Display this application version
      --ansi                       Force ANSI output
      --no-ansi                    Disable ANSI output
  -n, --no-interaction             Do not ask any interactive question
  -v|vv|vvv, --verbose             Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

### Examples 
With use time `-T` for concurrency
``` 
./console  ab:load  -T 5 "https://google.com/" -f table -C 1,2,3,4,5,6,7,8,9,10 
+-----------+----------------+-------+---------------+-------------+-------------+-------------+-----------+-----------+-----------+-------------+------------------+--------+
| test_time | count_requests | rps   | transfer_rate | waiting_min | waiting_avg | waiting_max | total_min | total_avg | total_max | concurrency | time_per_request | errors |
+-----------+----------------+-------+---------------+-------------+-------------+-------------+-----------+-----------+-----------+-------------+------------------+--------+
| 5.061     | 46             | 9.09  | 6.28          | 39          | 40          | 42          | 105       | 108       | 129       | 1           | 110.025          | 0      |
| 5.008     | 91             | 18.17 | 12.56         | 38          | 41          | 58          | 106       | 109       | 124       | 2           | 110.074          | 0      |
| 5.015     | 138            | 27.52 | 19.02         | 38          | 40          | 48          | 104       | 108       | 116       | 3           | 109.03           | 0      |
| 5.011     | 183            | 36.52 | 25.25         | 38          | 40          | 61          | 104       | 108       | 131       | 4           | 109.529          | 0      |
| 5.007     | 224            | 44.74 | 30.93         | 38          | 42          | 139         | 104       | 110       | 207       | 5           | 111.768          | 0      |
| 5.008     | 273            | 54.52 | 37.69         | 38          | 40          | 61          | 104       | 109       | 142       | 6           | 110.057          | 0      |
| 5.009     | 318            | 63.48 | 43.89         | 38          | 41          | 157         | 104       | 109       | 225       | 7           | 110.269          | 0      |
| 5.01      | 361            | 72.05 | 49.82         | 38          | 41          | 141         | 104       | 109       | 212       | 8           | 111.034          | 0      |
| 5.001     | 404            | 80.78 | 55.85         | 38          | 41          | 148         | 104       | 110       | 224       | 9           | 111.413          | 0      |
| 5.013     | 449            | 89.57 | 61.93         | 38          | 41          | 145         | 105       | 110       | 213       | 10          | 111.645          | 0      |
+-----------+----------------+-------+---------------+-------------+-------------+-------------+-----------+-----------+-----------+-------------+------------------+--------+
```

With use number `-N` by requests by one of concurrency step and verbose `-v`
``` 
 ./console  ab:load  -N 10 "https://google.com/" -f table -C 1,2,3 -v 

Start step {"concurrency":"1","count":"10"}
Step {"concurrency":"1","count":"10"} test finished with time 4.286
        CompletedRequests:      10
        ConcurrencyLevel:       1
        RPS:    2.33 req/sec
        Errors: 0
        TransferRate:   2.09 kbytes/sec received
        TimePerRequest: 428.554 ms
        Total min/avg/max:      306/428/579 ms
        Waiting min/avg/max:    239/361/512 ms

Start step {"concurrency":"2","count":"10"}
Step {"concurrency":"2","count":"10"} test finished with time 2.16
        CompletedRequests:      10
        ConcurrencyLevel:       2
        RPS:    4.63 req/sec
        Errors: 0
        TransferRate:   4.15 kbytes/sec received
        TimePerRequest: 431.968 ms
        Total min/avg/max:      321/408/485 ms
        Waiting min/avg/max:    251/339/418 ms

Start step {"concurrency":"3","count":"10"}
Step {"concurrency":"3","count":"10"} test finished with time 1.453
        CompletedRequests:      10
        ConcurrencyLevel:       3
        RPS:    6.88 req/sec
        Errors: 0
        TransferRate:   6.16 kbytes/sec received
        TimePerRequest: 435.855 ms
        Total min/avg/max:      309/402/566 ms
        Waiting min/avg/max:    237/333/487 ms
+-----------+----------------+------+---------------+-------------+-------------+-------------+-----------+-----------+-----------+-------------+------------------+--------+
| test_time | count_requests | rps  | transfer_rate | waiting_min | waiting_avg | waiting_max | total_min | total_avg | total_max | concurrency | time_per_request | errors |
+-----------+----------------+------+---------------+-------------+-------------+-------------+-----------+-----------+-----------+-------------+------------------+--------+
| 4.286     | 10             | 2.33 | 2.09          | 239         | 361         | 512         | 306       | 428       | 579       | 1           | 428.554          | 0      |
| 2.16      | 10             | 4.63 | 4.15          | 251         | 339         | 418         | 321       | 408       | 485       | 2           | 431.968          | 0      |
| 1.453     | 10             | 6.88 | 6.16          | 237         | 333         | 487         | 309       | 402       | 566       | 3           | 435.855          | 0      |
+-----------+----------------+------+---------------+-------------+-------------+-------------+-----------+-----------+-----------+-------------+------------------+--------+```

