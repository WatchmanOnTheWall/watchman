#!/bin/bash

.SILENT:	all
.PHONY:		all

all:
	echo   ""
	echo   "DB helpers"
	echo   "    create-db-%		- create table from downloaded table"
	echo   ""

create-db-%:
	@echo "Creating database $*"
	@if [ -f ./$*.db ]; then				\
		echo "create database $*;"								| mysql -u root --password=;	\
		echo "grant all privileges on $*.* to dev_watchman@localhost; flush privileges;"	| mysql -u root --password=;	\
		mysql -u dev_watchman --password=testing $* < ./$*.db;	\
	else							\
		echo "Error: missing db file ./$*.db";	\
	fi

drop-db-%:
	@echo "Dropping database $*"
	@echo "drop database if exists $*;" | mysql -u dev_watchman -ptesting;
