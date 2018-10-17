## Installing

First clone the codebase into a local directory. 

```
server {
    listen       80;
    server_name  [package-name].local.firestitch.com;
    root         [local-directory]\demo;
    include      c:/nginx/default.d/*.conf;

    location / {
      try_files $uri /index.php?$query_string;
    }
}
```

In the root of the codebase run the following command

```
php composer.phar update
```