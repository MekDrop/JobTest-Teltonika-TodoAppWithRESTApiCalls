#!/usr/bin/env bash

pushd /home/vagrant/todo
    if [ ! -f .env ]; then
        cp .env.example .env
    fi;
    composer install --no-ansi --no-interaction --no-progress
    php artisan migrate --force
    if [ "$1" == "true" ]; then
        yarn install --non-interactive --no-bin-links
    else
        yarn install --non-interactive
    fi;
    yarn development
popd