## Quick Start

Companies assessment project is pretty basic laravel-based application with a couple of necessary prerequisites for
launching a project.

* PHP: Requires PHP version 8.1 or higher.
* Composer: Make sure you have Composer installed.
* Web Server: A web server like Nginx.
* Database: Set up your database (e.g., MySQL).

Next, whenever requirements are met, you need to install dependencies with *composer install* command. Set up your env
variables and make sure application has a connection to the db. Then you can apply migrations by running *php artisan
migrate* command. And from this point you are pretty much ready to run your application with *php artisan serve*
command.

***

## Endpoints

This application covers only campaign resource(with 3 of 5 base methods required by the tech req) and therefore has only
3 available endpoints:

* INDEX /campaigns
* POST /campaigns
* PUT /campaigns/${campaignId}

Note: *remember, those endpoints are created for the api purposes only and need to being prefixed with /api*

### *Basic campaign creation curl request to speed up the process of testing*

curl --location 'localhost:8000/api/campaigns' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'name=CompanyTestName' \
--data-urlencode 'order=1320' \
--data-urlencode 'type=Type1123' \
--data-urlencode 'status=active' \
--data-urlencode 'start_date=2023-08-10'

*You can either put it to postman(don't forget about the Accept and Content-Type headers if you are using postman to see
proper validation messages) or use it within your terminal*


***

## Seeding

You may consider using campaigns table population seed to create a desired number of campaigns with random values used.

To use this seeder, simply run *php artisan db:seed --class=CampaignSeeder* command in your terminal (with laravel
application context). It will ask you some questions to adjust the number of companies.

***

## Commands

For the last *Bulk Update* assessment point I created command that you can run to achieve the goal.

Run *php artisan campaigns:update-start-dates* command in your terminal (with laravel application context). It will ask
you some questions to adjust the chunk size, so you can test it out with different conditions. Chunk size has a default
value in the command, and it can vary a lot depending on given conditions.

***

## Important Notes

You can notice that code has some comments here and there to bring some light on my POV about some solutions. This
project has a big room for improvement and a lot of solutions are here just as examples of tech req points. A lot of
solutions are not mentioned or presented but could be used in specific situations. 

I want to also mention some notes here:

* This project is a very basic create-laravel-app project with no docker or any containerisation methods enchantments
  that were intentionally skipped.
* As you may notice, I changed the url from the one mention in tech req to fully suit rest-naming principles.
* Endpoints are being built like a basic endpoints without any additions like pagination, custom messaged validation or
  middlewares(assuming that we use no-user application version in which we can talk more about roles, gating and so on).
* I created CampaignService to show one of available solutions for data managing operations problem(so models and
  controllers remain clean and declarative). I also used DI to show how service could be injected in different parts of
  application with different ways(e.g. via constructor or App::make).
* Campaign service methods were used in only store and update methods but not in index method to show that we can still
  use different approaches to solve different problems. Somewhere, scope method of model could be enough, and somewhere
  we tend more to use strictly service oriented pattern to keep everything in one place or combined.
* In the last *Bulk Update* assessment point main challenge is to keep up with memory limit, that's why I decided to
  write simple chunk update. We may look forward and enhance this solution with row locking or commit(db transaction) on
  demand depending on our needs e.g. speed or consistency. Actually, a lot of enhancement are possible here.
* It's also a good thing to add indexes here in the table, as an example it could be status column index or composite
  index for *findActiveCampaigns* operation purposes, or both. To make this decision, we first need to understand use
  cases metrics of our application.
* We may also consider to follow the semantic of some campaign table columns and make order either a unique,
  consequenced or recalculatible one. Make the name unique or add custom status and type validation as they are probably
  intended to have one of predefined values.

### *Thanks for attention!*
