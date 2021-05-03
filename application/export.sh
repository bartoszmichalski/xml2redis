#!/bin/bash

for params in "$@" 
do
    if [ $params == "-v" ]
        then
        verify=' verify'
    else
        path=$params
    fi
done
app="./app/bin/console app:xml-parse ${path} ${verify}"
$app