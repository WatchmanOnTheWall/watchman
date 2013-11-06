
.PHONY:	all FORCE clean clean-configs site_config website
.SILENT: clean

config			= ../application/config/config.php
database		= ../application/config/database.php
index			= ../index.php
apache_conf		= /etc/apache2/sites-available/watchman.conf
web_dir			= /server/watchman.ca
web_log_dir		= /server/logs/watchman.ca

all:	$(index) $(config) $(database) website
	@/bin/echo -e "\e[1;37mFinished making all\e[1;00m"

$(config):	config.php
	cp $< $@

$(database):	database.php
	cp $< $@

$(index):	index.php
	cp $< $@

website:	site_config $(web_log_dir) $(web_dir)
	@/bin/echo -e "\e[1;37mFinished making website\e[1;00m"
	@/bin/echo -e "\e[1;37mRun \e[1;35m'a2ensite watchman.conf; service apache2 reload'\e[1;00m"

site_config:	$(apache_conf)
	@/bin/echo -e "\e[1;37mFinished making site_config\e[1;00m"

$(web_dir):	/server/logs
	@/bin/echo -e "\e[1;37mLinking $@\e[1;00m"
	@if [ ! -d $@ ]; then 			\
	    ln -s ~/src/watchman.ca/ $@;	\
	fi

$(apache_conf):	./watchman.conf
	@/bin/echo -e "\e[1;37mCopying apache config $< to $@\e[1;00m"
	sudo cp $< $@

/server:
	@/bin/echo -e "\e[1;37mMaking $@ director in root\e[1;00m"
	sudo mkdir --mode=775 -p $@
	sudo chown root:sudo $@

/server/logs:	/server
	@/bin/echo -e "\e[1;37mMaking $@ director in /server/\e[1;00m"
	@if [ -d '/server' ]; then		\
	    mkdir --mode=775 -p $@;		\
	    sudo chown www-data:sudo $@;	\
	fi

/server/logs/%:	/server/logs
	@/bin/echo -e "\e[1;37mMaking $@ director in /server/logs/\e[1;00m"
	@if [ -d '/server/logs' ]; then		\
	    mkdir --mode=775 -p $@;		\
	    sudo chown www-data:sudo $@;	\
	fi

clean:	FORCE
	/bin/echo -e "\e[1;37m"
	/bin/echo -e "Clean options:"
	/bin/echo -e " - clean-configs:    removes $(index) $(config) $(database)"
	/bin/echo -e "\e[1;00m"

clean-configs:
	rm $(index)
	rm $(config)
	rm $(database)
