
.PHONY:	all FORCE clean

config			= ../application/config/config.php
database		= ../application/config/database.php
index			= ../index.php

all:	$(index) $(config) $(database)

$(config):	config.php
	cp $< $@

$(database):	database.php
	cp $< $@

$(index):	index.php
	cp $< $@

clean:
	rm $(index)
	rm $(config)
	rm $(database)
