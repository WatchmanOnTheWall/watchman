
.PHONY:	all FORCE clean clean-configs site_config website database
.SILENT: clean

config			= ../application/config/config.php
database		= ../application/config/database.php
index			= ../index.php
apache_conf		= /etc/apache2/sites-available/watchman.conf
web_dir			= /server/watchman.ca
web_log_dir		= /server/logs/watchman.ca

git_username		= $$( git config --global user.name )
git_email		= $$( git config --global user.email )

all:		$(index) $(config) $(database) website
	@/bin/echo -e "\e[1;37mFinished making all\e[1;00m"
	@if [ ! -n "$(git_username)" ]; then			\
	    echo "Git user.name is not set";			\
	    read -p "What is your git user.name: " username;	\
	    git config --global user.name "$$username";		\
	    echo "Git user.name is now set to: $$username";	\
	fi
	@if [ ! -n "$(git_email)" ]; then			\
	    echo "Git user.email is not set";			\
	    read -p "What is your git user.email: " email;	\
	    git config --global user.email "$$email";		\
	    echo "Git user.email is now set to: $$email";	\
	fi

all-dev:	all database-dev_watchman
all-live:	all database-watchman

$(config):	config.php
	cp $< $@

$(database):	database.php
	cp $< $@

$(index):	index.php
	cp $< $@

website:	site_config $(web_log_dir) $(web_dir)
	@/bin/echo -e "\e[1;37mFinished making website\e[1;00m"

site_config:	$(apache_conf)

$(web_dir):	/server/logs
	@if [ ! -d $@ ]; then 				\
	    /bin/echo -e "\e[1;37mLinking $@\e[1;00m";	\
	    ln -s ~/src/watchman.ca/ $@;		\
	fi

$(apache_conf):	./watchman.conf
	@/bin/echo -e "\e[1;37mCopying apache config $< to $@\e[1;00m"
	sudo cp $< $@
	sudo a2ensite watchman.conf
	@/bin/echo -e "\e[1;37mFinished making site_config\e[1;00m"
	@/bin/echo -e "\e[1;37mRun \e[1;35m'sudo service apache2 reload'\e[1;00m"

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

database-%:
	@if [ ! -f "$*.db" ]; then		\
	    echo "Creating database $* and user $*"; \
	    pass='testing';			\
	    echo "CREATE DATABASE $*;"		\
	         "GRANT ALL PRIVILEGES ON $*.* TO $*@localhost IDENTIFIED BY '$pass';" \
	         "FLUSH PRIVILEGES;"		\
	    | mysql -u root;			\
	    echo "Loading ../sql/watchman.db.sql into database $*"; \
	    mysql -u root $* < ../sql/watchman.db.sql; \
	    touch $*.db;			\
	fi

drop-database-%:
	@if [ -f "$*.db" ]; then		\
	    echo "Dropping database $* and user $*"; \
	    echo "DROP DATABASE $*;"		\
	         "DROP USER $*@localhost;"	\
	         "FLUSH PRIVILEGES;"		\
	    | mysql -u root;			\
	    rm $*.db;				\
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
