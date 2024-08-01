# Recruitment - Hub
A platform for recruiters to post jobs listings and candidates to apply.

## Features
Free jobs postings for recruiters(limited visibility)   
Jobs seekers can search for jobs and apply     
Premium jobs listings(promoted) - one time payment implemented by stripe  
Jobs Applications management  

## Tech Stack
Built by Laravel 11, tailwind(flowbite), Mysql

## Running the project 

**Prerequisites**: Composer, PHP 8.2, MySql, Node, Stripe account + api keys.  

## Roles
1. Admin  
2. Recruiter  
3. Candidate  


Download or clone this repository    
```
 https://github.com/ivanmizz/recruitment-hub.git
```
Install dependencies  
  ```sh
  composer install
  ```  
  Incase of errors update dependencies using `composer update`    

Copy the .env.example into a newly created .env file , then edit credentials for your database. 

Create a stripe account and paste in the public and secret key in the .env file to enable payments

Generate key:  
```sh
 php artisan key:generate
```   

Perform database migrations:  
```sh
 php artisan migrate

``` 


Seed the database:  
```sh
 php artisan db:seed

``` 


Start the backend development server  
```
  php artisan serve
```
Open new terminal to start frontend development server  
```
 npm run dev
```

## Sample User login data

 **Role**      | Email               | Password  |   
---------------|---------------------|-----------|
 **Admin**     | admin@gmail.com     | password0 |   
 **Recruiter** | recruiter@gmail.com | password1 |    
 **Candidate** | user@gmail.com      | password2 |     
    
 ## Use any of the following test cards to simulate a payment:
Payment succeeds:  
```sh
 4242 4242 4242 4242

``` 
Payment requires authentication:  
```sh
 4000 0025 0000 3155

``` 
Payment is declined:  
```sh
 4000 0000 0000 9995

``` 
 
**Open in your browser**  
```
http://localhost:8000
```

