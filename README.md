# test_slotegrator

Project deployment instructions:
1) Clone the project.
2) Copy the file `env.example.php` to the root of the project and name it `env.php`.
3) Run the command `composer install`.
4) Run the command `php -S localhost:8000`
5) Run the command `php run-migrations.php`
6) Run the command `php run-seeders.php`

___
# Routes:
**Users management:** <br/> 
**POST:** `/user` <br/>
**AUTH:** `false` <br/>
**DESCRIPTION:** _New user registration_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;email: 'required', 'email', <br/>
&nbsp;&nbsp;password: 'required', 'str', 'min:8', 'max:255' <br/>
} <br/>

**POST:** `/auth/login` <br/>
**AUTH:** `false` <br/>
**DESCRIPTION:** _Login_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;email: 'required', 'email', <br/>
&nbsp;&nbsp;password: 'required', 'str', 'min:8', 'max:255' <br/>
} <br/>

**GET:** `/auth/me` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get auth user_ <br/>

**GET:** `/user` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get all users_ <br/>
**QUERY**: { <br/>
&nbsp;&nbsp; sort: `id, -id, created_at, -created_at` <br/>
&nbsp;&nbsp; search: `[id, email, name]`<br/>
} <br/>

**GET:** `/user/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get one user_ <br/>

**PUT:** `/user/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Update user_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;email: 'required', 'email', <br/>
&nbsp;&nbsp;password: 'required', 'str', 'min:8', 'max:255' <br/>
} <br/>

**DELETE:** `/user/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Delete user_ <br/>

**Products management (физический предмет):**
**GET:** `/product` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get all products_ <br/>
**QUERY**: { <br/>
&nbsp;&nbsp; sort: `id, -id, count, -count` <br/>
&nbsp;&nbsp; search: `[id, name, count]`<br/>
} <br/>

**POST:** `/product` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Create new product_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;description: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;count: 'required', 'int', 'min:2', 'max:200' <br/>
} <br/>

**GET:** `/product/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get one product_ <br/>

**PUT:** `/product/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Update product_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;description: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;count: 'required', 'int', 'min:2', 'max:200' <br/>
} <br/>

**Monetary management (случайная сумма в интервале):**
**GET:** `/monetary` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get all monetary_ <br/>
**QUERY**: { <br/>
&nbsp;&nbsp; sort: `id, -id, type, -type` <br/>
&nbsp;&nbsp; search: `[id, type]`<br/>
} <br/>

**POST:** `/monetary` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Create new monetary_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp; type: bonus or real money, <br/>
&nbsp;&nbsp; max_sum: 'int', 'min:1' <br/>
&nbsp;&nbsp; interval_from: 'required', 'int', 'min:1', 'max:interval_to' <br/>
&nbsp;&nbsp; interval_to: 'required', 'int', 'min:interval_from', 'max:max_sum' <br/>
} <br/>

**GET:** `/monetary/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get one monetary_ <br/>

**PUT:** `/monetary/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Update monetary_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp; max_sum: 'int', 'min:1' <br/>
&nbsp;&nbsp; interval_from: 'required', 'int', 'min:1', 'max:interval_to' <br/>
&nbsp;&nbsp; interval_to: 'required', 'int', 'min:interval_from', 'max:max_sum' <br/>
} <br/>

**Prize (Призы):**
**GET:** `/prize` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get all prizes_ <br/>
**QUERY**: { <br/>
&nbsp;&nbsp; sort: `id, -id` <br/>
&nbsp;&nbsp; search: `[target_id, type, user_id]`<br/>
} <br/>

**POST:** `/prize` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _To receive a prize_ <br/>

**GET:** `/prize/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get one prize_ <br/>

**DELETE:** `/prize/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Waiver of a prize_ <br/>

**POST:** `/prize/:id/convert` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Real money convert to bonus_ <br/>

___
# Commands:
**NAME:** `php run-migrations.php` <br/>
**DESCRIPTION:** _Runs all migrations from database/migrations directories_ <br/>

**NAME:** `php run-seeders.php` <br/>
**DESCRIPTION:** _Runs all seeders from database/seeders directories_ <br/>

**NAME:** `php send-bonus.php` <br/>
**DESCRIPTION:** _Accrues bonuses to users_ <br/>

___
# Additionally:
Project in Insomnia: [insomnia_project.json](Insomnia_project.json) <br/>
Request example: <br/>
![img.png](img.png)

