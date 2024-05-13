# Recruitment - Hub
A platform for recruiters to post jobs listings and candidates to apply.

## Features
Free jobs postings for recruiters(limited visibility)   
Jobs seekers can search for jobs and apply     
Premium jobs listings(promoted) - one time payment implemented by stripe  
Jobs Applications management  

## Tech Stack
Built by Laravel

## Running the project 

**Prerequisites**: Composer, PHP 8.2, Node, Stripe account + api keys.  

## Roles
1. Admin  
2. Recruiter  
3. Candidate  

Admin email: admin@admin.com, password: password  

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
Start the backend development server  
```
  php artisan serve
```
Open new terminal to start frontend development server  
```
 npm run dev
```

**Open in your browser**  
```
http://localhost:8000
```

