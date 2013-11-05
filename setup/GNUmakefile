
.PHONY:	all FORCE clean site_config

config			= ../application/config/config.php
database		= ../application/config/database.php
index			= ../index.php
apache_conf		= /etc/apache2/sites-available/watchman.conf

all:	$(index) $(config) $(database)

$(config):	config.php
	cp $< $@

$(database):	database.php
	cp $< $@

$(index):	index.php
	cp $< $@

site_config:	$(apache_conf)

$(apache_conf):	watchman.conf
	sudo cp $< $@

clean:
	rm $(index)
	rm $(config)
	rm $(database)
