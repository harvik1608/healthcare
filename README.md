This Laravel project implements all the exercises provided in the practical assignment. The application demonstrates features such as healthcare booking related API like user can see all available professionals with their speciality and book appointment.

All business logic is implemented cleanly, and corresponding unit tests have been written to ensure correctness.


database name: db_healthcare
You have to make database in your local with db_healthcare name.
---

⚙️ Setup Instructions

1. Clone the repository

git clone https://github.com/harvik1608/healthcare.git
cd your-laravel-project


2. Install dependencies

composer install
npm install && npm run dev


3. Environment setup

cp .env.example .env
php artisan key:generate


4. Configure your .env file with your database and mail settings.


5. Run migrations and seeders

php artisan migrate --seed


6. Start the development server

php artisan serve



---

📝 Folder Structure

app/Models/ – Eloquent models

app/Http/Controllers/ – Controllers

resources/views/ – all blade files

public/ - all css & js files

Improvements :
1) Due to short time & this is only practical test so I am loading all data once. otherwise i can load in chunk.
2) As per practical assignment, Professionals can't login & register otherwise i can make pages for professionals.
3) Super admin can view all data of both users. but at this time I don't give.

---

👤 Author

Harshal Kithoriya

https://github.com/harvik1608/healthcare.git