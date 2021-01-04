# Lara Dokan  - Laravel 8 Project
A simple shop management system. It can help to run a small shop. Such as, paying the employees, managing the product, managing the stock, knowing the income and expenditure account, etc. It is an offline project. Only accounts can be created online and products can be viewed but not purchased. The member will be the default user role after creating the account. 

## Instruction:
<ul>
    <li>1. Creating a Database 'lara_dokan' in your database server</li>
    <li>2. composer update</li>
    <li>3. 'npm install' and then 'npm run dev'</li>
    <li>4. php artisan storage:link</li>
    <li>5. copy the file .env.example and rename into .env, then give information of database, server and create app key by 'php artisan key:gen' the save the file</li>
    <li>6. php artisan migrate</li>
    <li>7. php artisan serve</li> 
    <li>8. First time you have to install this app. After 'serve command' this app will show you installation process automatically.</li> 
    <li>9. After installation you will get information to login. You will be a super admin. Now you can access everything.</li> 
</ul>

### Creating employee:
<ul>
At first you have to create a user -
    <li>1. Go to User</li>
    <li>2. Go to 'Create User'</li>
then create a employee -
    <li>3. Go to 'Create Employee'</li>
    <li>4. Select 'User_ID' and give other information</li>
    <li>5. Click the button 'Create Employee'.</li>
</ul>

### User Role:
<ul>
    <li>superadmin - can access everything.</li>
    <li>admin - </li>
    <li>editor -  only can access create, read and update of the 'product sell', but not delete. 
</li>
    <li>salesman - only can access create and read of the 'product sell' and also can access Home, Contact, Register, Login.</li>
    <li>member - only can access Home, Contact, Register, Login and 'product read'. Member means customer.</li>
</ul>

### About SuperAdmin:
<ul>
<li>After installing this app, a user ID will be created automatically which will be the role of super admin.</li>
<li>The user ID of the super admin cannot be changed. This ID must be 1 at all times.</li>
<li>If the super admin's ID changes due to a mistake, then you have to manually fix it from the users table of the database.</li>
</ul>
 

### Change TimeZone:
<ul>
<li>Go to app.php of the project folder</li>
<li>(For Asia/Dhaka) Add this line and save</li>
'timezone' => 'Asia/Dhaka',
</ul>
 

<hr>

### Project Version:
1.0.0

### Start Date:
22-Dec-2020

### Last Update:
04-Jan-2021

### Developed by:
Md. Rezwan Saki Alin
https://www.alinsworld.com/

### Used Tools:
Laravel 8, Bootstrap free admin template 'AdminLTE 3.0.5' 


   
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
