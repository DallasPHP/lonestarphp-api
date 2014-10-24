Setting Up Database Credentials
------------------------
copy .env.example to .env with your specific environment variable values

Running Migrations
------------------------
```bash
export $(cat .env | xargs) && ./vendor/bin/phinx migrate
```
