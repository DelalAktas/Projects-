# Laravel Package

Run following command in the workspace directory in order to install latest packages
`php artisan install` or `php artisan update`
`composer update`.
Create .env file.
`php artisan migrate` - can also do `php artisan db:seed`, but it's not required.
 For local hosting
`php artisan serve`.`php artisan migrate:refresh --seed` this command will drop all tables and recreate them. Then it will seed the data.

Note: Can also clear & recreate caches


# Extras
Week 2:
- Extra view to see content "in depth"

Week 3:
- Extra view for users to see their blogs, and redirecting to CRUD from it as well

Week 4:
- Profile image is being pixelated and it's circle shaped

Week 5:
- Admin guard, login, and dashboard with list of all users, it's possible to "impersonate" a user, but not possible to do CRUD as this user (To register an admin Tinker is required)
- We went with PDF instead of EXCEL files download

Week 6:
- RESTful API has been implemented and has 10 request 
	- Blog/store,Blog/destroy,Blog/update,Blog/index,Blog/Show || User/store,User/destroy,User/update,User/index,User/show
	- Postman IDE has been used 

# WEB3-group-c
- Mateusz Ulas 3638308
- Bilal Delal Aktas 3769186