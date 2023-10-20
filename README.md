### Employee manager

To run the project you will need installed docker on your machine.

After cloning the project in command line run:

```
cd /path/to/cloned/project
cp .env.example .env
docker-compose up -d server
docker-compose run --rm composer i
docker-compose run --rm artisan key:generate
docker-compose run --rm artisan migrate --seed
docker-compose run --rm npm i
docker-compose run --rm npm run dev
```
