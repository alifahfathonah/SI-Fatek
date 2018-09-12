# Sistem Informasi Fatek

Proyek pengembangan sistem informasi Fakultas Teknik Universitas Sam Ratulangi. 

## Versioning

Versi 1.0.0
1. Sistem informasi SK1

## Prerequisites

1. Apache Web Server & MySQL Database
2. Text Editor.
3. GitHub Desktop

## Instalation

1. Click Clone or download
2. Clik Open in desktop 
3. In GitHub desktop: choose your htdocs directory for the project
4. Before working the code, don't forget to create a branch with your name in it
5. Customize these two file with your development environment
```
$config['base_url'] in /project/zerolevel2/config/config.php
/project/zerolevel2/config/database.php
```
6. Working the code
7. Publish the branch

## Project Structure

### CodeIgniter Engine
Codeigniter engine (/system) are exclude in the project directory. Feel free to edit the index.php file pointing at your system directory
```
$system_path = '../system' in /[root]/index.php
```

### Testing Controller
Create your own testing controller in folder testing. Note: This directory will be remove in production stage
```
/controller/testing/
```

### Images and assets
Place your editable custom css and js in to
```
/assets/custom_css/ & /assets/custom_js/
```

## Tim Pengembang

* **Alwin Sambul** - *Project Leader* - asambul@unsrat.ac.id
* **Xaverius Najoan** - *Programmer* - xnajoan@unsrat.ac.id
* **Edsie Jacobus** - *Database/Programmer* - 
* **Virginia Tulenan** - *System Analyst/Programmer* - 
