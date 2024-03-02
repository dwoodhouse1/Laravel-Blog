## Installation

First clone this repository, install the dependencies, and setup your .env file.

<pre>
<code>git clone git@github.com:dwoodhouse1/Laravel-Blog.git blog
composer install
cp .env.example .env
</code></pre>

Then create the necessary database.

<pre>
<code>php artisan db
create database blog
</code></pre>

And run the initial migrations and seeders.

<pre>
<code>php artisan migrate --seed
</code></pre>


## Mailchimp

To get the Mailchimp newsletter service working, follow these steps:

- Create an account with <a href="https://mailchimp.com">Mailchimp</a>.  
- Once logged in, go to your account profile.
- Click on the dropdown named 'Extras' and click on 'API Keys'.
- Click the 'Create A Key' button.
- Use that created API key in your .env file under `MAILCHIMP_KEY=` (don't forget the -us12 at the end).
- For the `MAILCHIMP_LIST_SUBSCRIBERS=`, locate the id by following the instructions <a href="https://mailchimp.com/help/find-audience-id/#:~:text=Click%20the%20Settings%20drop-down,This%20is%20your%20audience%20ID.">found here (wrap the id within single quotes '')</a>.
