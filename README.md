# CMS MVC Application
## 📚 Table of Contents

1. [Quick Start](#quick-start)
2. [Home](#home)
3. [Admin](#admin)
4. [Admin  Profile](#admin-profile)
5. [About](#about)
6. [Contact](#contact)
7. [Login](#login)
8. [Register](#register)

## Quick Start
1. Virtual Host Configuration
To configure your local development environment with XAMPP, add the following block to your httpd-vhosts.conf file(typically at xampp/apache/conf/extra/httpd-vhosts.conf):

<pre>
&lt;VirtualHost *:80&gt;
    DocumentRoot "C:/xampp/htdocs/mvc_app/public"
    ServerName mvc_app.local
    &lt;Directory "C:/xampp/htdocs/mvc_app/public"&gt;
        AllowOverride All
        Require all granted
    &lt;/Directory&gt;
&lt;/VirtualHost&gt;
</pre>

2. Host File Entry
Add this line to your system hosts file (c:\Windows\System32\drivers\etc\hosts):
 <pre>127.0.0.1 mvc_app.local </pre>

Restart Apache via the XAMPP Control Panel after making these changes. Now, visit http://mvc_app.local in your browser to access the app.

## Home
See recent posts, featured content, and easy navigation.

<img width="1919" height="952" alt="image" src="https://github.com/user-attachments/assets/4df78af7-9533-4980-8283-298a0c4b94cc" />

## Admin
Take control of site content, manage posts, users, and settings from a central, secure admin panel.

<img width="959" height="479" alt="image" src="https://github.com/user-attachments/assets/c14f6b53-abf1-4bf8-875d-a05e96a6a215" />

## Admin Profile
Edit your admin profile details and manage account preferences.

<img width="959" height="469" alt="image" src="https://github.com/user-attachments/assets/a5e2b611-b447-4813-b821-d26da956179b" />


## About
View project information, team details, and more about the CMS.

<img width="957" height="473" alt="image" src="https://github.com/user-attachments/assets/19aecb3f-e14b-491a-a133-32c94f2215d1" />


## contact 
Submit queries or feedback via a built-in contact form.

<img width="956" height="469" alt="image" src="https://github.com/user-attachments/assets/1387d32a-a7f7-4ef4-b588-460c3891c093" />

## Login
Securely sign in to your account using your credentials.

<img width="959" height="470" alt="image" src="https://github.com/user-attachments/assets/554e51fa-b9ae-4d6d-9ff7-822616ba9b18" />


## Register
Create a new account to contribute or manage content.

<img width="951" height="472" alt="image" src="https://github.com/user-attachments/assets/389d9c8d-795f-49f6-aeae-d3afcf90932d" />
