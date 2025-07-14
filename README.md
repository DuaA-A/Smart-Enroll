
<!DOCTYPE html>
<html lang="en">
</head>
<body>

  <header>
      <h1>Smart-Enroll</h1>
            <img src="/Screenshot%202025-05-16%20010813.png"/>      
    <p>
      Smart-Enroll is a Laravel-based web application designed as a clean and user-friendly signup form.
      It features advanced validation mechanisms and a polished UI/UX design to ensure a smooth user registration experience.
    </p>
    <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>
       </p>
  </header>
 <h2>Contributors</h2>
    <ul>
      <li><strong><a href="https://github.com/DuaA-A">Duaa Abd-Elati </a></strong> – Project Lead, Database Designer, Server-Side Validation, UI designer</li>
      <li><strong><a href="https://github.com/NadaBadawy186">Nada Badawy</a></strong> – WhatsApp Number Verification, Multilingual Support</li>
      <li><strong><a href="https://github.com/Roqaia2005">Roqaia Hassan</a></strong> – User Signup Form, Client-Side Validation</li>
      <li><strong><a href="https://github.com/Fatimah3844">Fatemah</a></strong> – Header and Footer</li>
    <li><strong><a href="https://github.com/Nourmeena">Nouran Ashraf </a></strong> – >Welcome Page, Testing</li>
      <li><strong><a href="https://github.com/Mayaamohamed">Maya Mohammed</a></strong> </li>        
    </ul>
  <section>
    <h2>Features</h2>
    <ul>
      <li><strong>User Signup Form:</strong> Allows new users to register with essential details.</li>
      <li><strong>WhatsApp Number Verification:</strong> Uses an API to verify if the entered WhatsApp number is valid and active.</li>
      <li><strong>Server-Side Validation:</strong> Ensures data integrity and security by validating inputs on the server.</li>
      <li><strong>Client-Side Validation:</strong> Provides instant feedback to users on input errors before form submission.</li>
      <li><strong>User Existence Check:</strong> Checks if the user already exists in the database to prevent duplicate registrations.</li>
      <li><strong>Multilingual Support:</strong> Supports multiple languages for wider accessibility.</li>
      <li><strong>Welcome Page:</strong> Redirects users to a friendly welcome page upon successful login.</li>
      <li><strong>Responsive and Modern UI:</strong> Designed with great attention to UI/UX for a seamless experience across devices.</li>
      <li><strong>Header and Footer:</strong> Consistent layout with reusable header and footer components.</li>
    </ul>
  </section>

  <section>
    <h2>Technologies Used</h2>
    <ul>
      <li>Laravel Framework (PHP)</li>
      <li>Bootstrap for UI styling and responsiveness</li>
      <li>JavaScript/jQuery for client-side validation</li>
      <li>API integration for WhatsApp number validation</li>
      <li>MySQL for user data storage</li>
    </ul>
  </section>

  <section>
    <h2>Installation</h2>
    <p>Clone the repository:</p>
    <pre><code>git clone https://github.com/your-username/Smart-Enroll.git</code></pre>
    <p>Navigate to the project directory:</p>
    <pre><code>cd Smart-Enroll</code></pre>
    <p>Install dependencies using Composer:</p>
    <pre><code>composer install</code></pre>
    <p>Set up your <code>.env</code> file by copying from <code>.env.example</code> and configuring your database and API keys:</p>
    <pre><code>cp .env.example .env</code></pre>
    <p>Generate application key:</p>
    <pre><code>php artisan key:generate</code></pre>
    <p>Run database migrations:</p>
    <pre><code>php artisan migrate</code></pre>
    <p>Serve the application:</p>
    <pre><code>php artisan serve</code></pre>
  </section>

  <section>
    <h2>Usage</h2>
    <ul>
      <li>Open your browser and navigate to <a href="http://localhost:8000" target="_blank" rel="noopener">http://localhost:8000</a>.</li>
      <li>Use the signup form to register a new account.</li>
      <li>The form validates inputs both on UI and server sides.</li>
      <li>WhatsApp number is verified using the integrated API.</li>
      <li>If the user already exists, the system notifies you accordingly.</li>
      <li>Upon successful registration and login, you are redirected to a welcome page.</li>
    </ul>
  </section>

  <section>
    <h2>Folder Structure Overview</h2>
    <ul>
      <li><code>app/</code> - Contains core application logic, including controllers like <code>RegisterController</code>.</li>
      <li><code>bootstrap/</code> - Contains the bootstrap files.</li>
      <li><code>config/</code> - Configuration files for the application.</li>
      <li><code>database/</code> - Database migrations and seeders.</li>
      <li><code>lang/</code> - Language files for multilingual support.</li>
      <li><code>public/</code> - Public assets such as CSS, JavaScript, and images.</li>
      <li><code>resources/views/</code> - Blade templates for the frontend views (header, footer, signup form, welcome page).</li>
      <li><code>routes/</code> - Application routes.</li>
    </ul>
  </section>

  <section>
    <h2>Validation Details</h2>
    <ul>
      <li>Server-side validation includes checks for all form fields, ensuring data consistency and security.</li>
      <li>Client-side validation uses JavaScript for instant feedback.</li>
      <li>Unique email/phone checks prevent duplicate user registrations.</li>
      <li>WhatsApp number validity is confirmed via external API calls.</li>
    </ul>
  </section>

  <section>
    <h2>Contributing</h2>
    <p>Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes.</p>
  </section>

  <section>
    <h2>License</h2>
    <p>This project is open-source and available under the MIT License.</p>
  </section>

</body>
</html>
