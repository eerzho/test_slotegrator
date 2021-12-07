# test_slotegrator

Project deployment instructions:
1) Clone the project.
2) Copy the file "env.example.php" to the root of the project and name it "env.php".
3) Run the command "composer install".
4) Run the command "php -S localhost:8000"
5) Run the command "php run-migrations.php"
6) Run the command "php run-seeders.php"
___

# Routes:
<h3>Users management:</h3>
**POST:** `/user` <br/>
**AUTH:** `false` <br/>
**DESCRIPTION:** _New user registration_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;email: 'required', 'email', <br/>
&nbsp;&nbsp;password: 'required', 'str', 'min:8', 'max:255' <br/>
} <br/>
<br/>

[comment]: <> (___)

[comment]: <> (**POST:** `/auth/login` <br/>)

[comment]: <> (**AUTH:** `false` <br/>)

[comment]: <> (**DESCRIPTION:** _Login_ <br/>)

[comment]: <> (**BODY**: { <br/>)

[comment]: <> (&nbsp;&nbsp;email: 'required', 'email', <br/>)

[comment]: <> (&nbsp;&nbsp;password: 'required', 'str', 'min:8', 'max:255' <br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**GET:** `/auth/me` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get auth user_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**GET:** `/user` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get all users_ <br/>)

[comment]: <> (**QUERY**: { <br/>)

[comment]: <> (&nbsp;&nbsp; sort: `id, -id, created_at, -created_at` <br/>)

[comment]: <> (&nbsp;&nbsp; search: `[id, email, name]`<br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**GET:** `/user/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get one user_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**PUT:** `/user/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Update user_ <br/>)

[comment]: <> (**BODY**: { <br/>)

[comment]: <> (&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>)

[comment]: <> (&nbsp;&nbsp;email: 'required', 'email', <br/>)

[comment]: <> (&nbsp;&nbsp;password: 'required', 'str', 'min:8', 'max:255' <br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**DELETE:** `/user/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Delete user_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (<h3>Products management &#40;физический предмет&#41;:</h3>)

[comment]: <> (**GET:** `/product` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get all products_ <br/>)

[comment]: <> (**QUERY**: { <br/>)

[comment]: <> (&nbsp;&nbsp; sort: `id, -id, count, -count` <br/>)

[comment]: <> (&nbsp;&nbsp; search: `[id, name, count]`<br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**POST:** `/product` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Create new product_ <br/>)

[comment]: <> (**BODY**: { <br/>)

[comment]: <> (&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>)

[comment]: <> (&nbsp;&nbsp;description: 'required', 'str', 'min:3', 'max:255', <br/>)

[comment]: <> (&nbsp;&nbsp;count: 'required', 'int', 'min:2', 'max:200' <br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**GET:** `/product/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get one product_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**PUT:** `/product/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Update product_ <br/>)

[comment]: <> (**BODY**: { <br/>)

[comment]: <> (&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>)

[comment]: <> (&nbsp;&nbsp;description: 'required', 'str', 'min:3', 'max:255', <br/>)

[comment]: <> (&nbsp;&nbsp;count: 'required', 'int', 'min:2', 'max:200' <br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (<h3>Monetary management &#40;случайная сумма в интервале&#41;:</h3>)

[comment]: <> (**GET:** `/monetary` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get all monetary_ <br/>)

[comment]: <> (**QUERY**: { <br/>)

[comment]: <> (&nbsp;&nbsp; sort: `id, -id, type, -type` <br/>)

[comment]: <> (&nbsp;&nbsp; search: `[id, type]`<br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**POST:** `/monetary` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Create new monetary_ <br/>)

[comment]: <> (**BODY**: { <br/>)

[comment]: <> (&nbsp;&nbsp; type: bonus or real money, <br/>)

[comment]: <> (&nbsp;&nbsp; max_sum: 'int', 'min:1' <br/>)

[comment]: <> (&nbsp;&nbsp; interval_from: 'required', 'int', 'min:1', 'max:interval_to' <br/>)

[comment]: <> (&nbsp;&nbsp; interval_to: 'required', 'int', 'min:interval_from', 'max:max_sum' <br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**GET:** `/monetary/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get one monetary_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**PUT:** `/monetary/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Update monetary_ <br/>)

[comment]: <> (**BODY**: { <br/>)

[comment]: <> (&nbsp;&nbsp; max_sum: 'int', 'min:1' <br/>)

[comment]: <> (&nbsp;&nbsp; interval_from: 'required', 'int', 'min:1', 'max:interval_to' <br/>)

[comment]: <> (&nbsp;&nbsp; interval_to: 'required', 'int', 'min:interval_from', 'max:max_sum' <br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (<h3>Prize &#40;Призы&#41;:</h3>)

[comment]: <> (**GET:** `/prize` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get all prizes_ <br/>)

[comment]: <> (**QUERY**: { <br/>)

[comment]: <> (&nbsp;&nbsp; sort: `id, -id` <br/>)

[comment]: <> (&nbsp;&nbsp; search: `[target_id, type, user_id]`<br/>)

[comment]: <> (} <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**POST:** `/prize` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _To receive a prize_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**GET:** `/prize/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Get one prize_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**DELETE:** `/prize/:id` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Waiver of a prize_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

[comment]: <> (**POST:** `/prize/:id/convert` <br/>)

[comment]: <> (**AUTH:** `true` <br/>)

[comment]: <> (**DESCRIPTION:** _Real money convert to bonus_ <br/>)

[comment]: <> (<br/>)

[comment]: <> (___)

# Commands:
**NAME:** `php run-migrations.php` <br/>
**DESCRIPTION:** _Runs all migrations from database/migrations directories_ <br/>
<br/>
___
**NAME:** `php run-seeders.php` <br/>
**DESCRIPTION:** _Runs all seeders from database/seeders directories_ <br/>
<br/>
___
**NAME:** `php send-bonus.php` <br/>
**DESCRIPTION:** _Accrues bonuses to users_ <br/>
<br/>
___

# Additionally:
Project in Insomnia: [insomnia_project.json](Insomnia_project.json) <br/>
Request example: <br/>
![img.png](img.png)

