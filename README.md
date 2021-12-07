# test_slotegrator

Project deployment instructions:

1) Clone the project.
2) Copy the file "env.example.php" to the root of the project and name it "env.php".
3) Run the command "composer install".
4) Run the command "php -S localhost:8000"
5) Run the command "php run-migrations.php"
6) Run the command "php run-seeders.php"

# Routes:

<h3>Users management:</h3>
**POST:** `/user` <br/>
**AUTH:** `false` <br/>
**DESCRIPTION:** _New user registration_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;email: 'required', 'email', <br/>
&nbsp;&nbsp;password: 'required', 'str', 'min:8', 'max:255' <br/>
}

**POST:** `/auth/login` <br/>
**AUTH:** `false` <br/>
**DESCRIPTION:** _Login_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;email: 'required', 'email', <br/>
&nbsp;&nbsp;password: 'required', 'str', 'min:8', 'max:255' <br/>
}

**GET:** `/auth/me` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get auth user_ <br/>

**GET:** `/user` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get all users_ <br/>
**QUERY**: { <br/>
&nbsp;&nbsp; sort: `id, -id, created_at, -created_at` <br/>
&nbsp;&nbsp; search: `[id, email, name]`<br/>
}

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
}

**DELETE:** `/user/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Delete user_ <br/>


<h3>Products management (физический предмет):</h3>
**GET:** `/product` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get all products_ <br/>
**QUERY**: { <br/>
&nbsp;&nbsp; sort: `id, -id, count, -count` <br/>
&nbsp;&nbsp; search: `[id, name, count]`<br/>
}

**POST:** `/product` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Create new product_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp;name: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;description: 'required', 'str', 'min:3', 'max:255', <br/>
&nbsp;&nbsp;count: 'required', 'int', 'min:2', 'max:200' <br/>
}

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
}

<h3>Monetary management (случайная сумма в интервале):</h3>
**GET:** `/monetary` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get all monetary_ <br/>
**QUERY**: { <br/>
&nbsp;&nbsp; sort: `id, -id, type, -type` <br/>
&nbsp;&nbsp; search: `[id, type]`<br/>
}

**POST:** `/monetary` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Create new monetary_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp; type: bonus or real money, <br/>
&nbsp;&nbsp; max_sum: 'int', 'min:1' <br/>
&nbsp;&nbsp; interval_from: 'required', 'int', 'min:1', 'max:interval_to' <br/>
&nbsp;&nbsp; interval_to: 'required', 'int', 'min:interval_from', 'max:max_sum' <br/>
}

**GET:** `/monetary/:id` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Get one monetary_ <br/>

**PUT:** `/monetary` <br/>
**AUTH:** `true` <br/>
**DESCRIPTION:** _Update monetary_ <br/>
**BODY**: { <br/>
&nbsp;&nbsp; max_sum: 'int', 'min:1' <br/>
&nbsp;&nbsp; interval_from: 'required', 'int', 'min:1', 'max:interval_to' <br/>
&nbsp;&nbsp; interval_to: 'required', 'int', 'min:interval_from', 'max:max_sum' <br/>
}