
# Calculator API

## Installation:

### Requirements:

- Docker.
- Git

### Clone Project
```bash
git clone git@github.com:cibrian/calculator-backend.git
cd calculator-backend
```
### Set up .env file with your local paths
```bash
cp .env.example .env
```
### Building Docker images
```bash
docker-compose build
```
### Start App
```bash
docker-compose up -d
```
## Preparing project

Install the application dependencies:
```bash
docker-compose exec app composer install
```
## Initializing data
Generate Database Tables
```bash
docker-compose exec app php artisan migrate
```
Run Seed (This seed is going to create a default User and Operations)
```bash
docker-compose exec app php artisan db:seed
```
Generate random key.
```bash
docker-compose exec app php artisan key:generate
```
## Set up hosts file [optional]
Edit /etc/hosts file to add
```bash
127.0.0.1  laravel.local
```
## APP Credentials :robot:
- Email: calculator@email.com
- Password: calculator
- URL: http://127.0.0.1
## ENDPOINTS:

### LOGIN:

- Login User: `POST /login`
```bash
curl --location --request POST 'http://127.0.0.1/api/v1/login' \

--form 'email="calculator@email.com"' \

--form 'password="calculator"'
```
### Operations:

- Perform Addition: `POST /api/v1/calculator` (Needs Bearer Token)
```bash
curl --location --request POST 'http://127.0.0.1/api/v1/calculator' \

--header 'Authorization: Bearer {token}' \

--form 'type="addition"' \

--form 'value1=1' \

--form 'value2=2'
```

### API Live version (AWS):
http://34.212.162.188/api/v1

### Live version (AWS)
Calculator Frontend: http://35.89.169.61:8080
```
Username: calculator@email.com
Password: calculator
```
