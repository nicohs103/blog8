<!-- #######  THIS IS A COMMENT - Visible only in the source editor #########-->
<div>
<h3>Requirements</h3>
<ol>
<li>PHP 7</li>
<li>Docker</li>
<li>Composer 2</li>
<li>Optional: MySQL Workbench</li>
<li>Optional: Kitematic</li>
</ol>
<hr /><br />
<h3>Installation</h3>
<h4>-&gt; Open terminal:</h4>
<ol>
<li>git clone https://github.com/nicohs103/laravel-8-with-docker</li>
<li>cd laravel-8-with-docker</li>
<li>cp .env.example .env</li>
<li>composer install</li>
<li>./vendor/bin/sail up</li>
</ol>
<br />
<h4>-&gt; Config Mysql Workbench (Or use console)</h4>
<ol>
<li>localhost:3306</li>
<li>User: root</li>
<li>No password</li>
</ol>
<br />
<h4>-&gt; In the MySql container:</h4>
<blockquote>
<div>CREATE SCHEMA `blog8` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;</div>
</blockquote>
<br />
<h4>-&gt; In the app container</h4>
<ol>
<li>php artisan key:generate</li>
<li>php artisan migrate --seed</li>
<li>npm install</li>
<li>npm run dev</li>
</ol>
<br />
<h4>-&gt; Navigate to localhost !!</h4>
<div>Admin user:</div>
<div>admin - admin</div>
<div>&nbsp;</div>
<div><hr /></div>
<br />
<div>This project make the containers for php server, mysql, redis, mailhog, meilisearch, selenium</div>
<br /><hr /><br />
<h3>Use</h3>
<br />
<h3>Post Importer:</h3>
<div>Config your server to run 'php artisan schedule:run' every minute OR</div>
<br />
<blockquote>
<div>Execute in command line 'php artisan GetExternalPosts'</div>
</blockquote>
</div>
