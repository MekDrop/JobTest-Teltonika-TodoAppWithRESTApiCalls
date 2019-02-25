# JobTest for Teltonika: Todo App With REST Api Calls (incomplete)

This todo app based on [Lumen framework](https://lumen.laravel.com) was created as a job test for [Teltonika.lt](https://teltonika.lt).

## How to use it

Easiest way is to start [Vagrant](https://www.vagrantup.com) with [VirtualBox](https://www.virtualbox.org) adapter box.

`vagrant up` will boot the box and preconfigures `http://todo.localhost` url for your computer.

Standard configuration doesn't have any users so you will need to create at least one. That you can do by typing: `vagrant ssh -t -c "cd todo && php artisan user:register YOUR@EMAIL"`. If you want to register admin user use `vagrant ssh -t -c "cd todo && php artisan user:register YOUR@EMAIL --admin"` command. Both times an email will be sent to provided email addresses with link to set password for the user. 

Use http://todo.localhost:8025/ for reading emails if you haven't configured another method in .env file.
