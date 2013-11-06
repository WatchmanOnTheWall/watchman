# -*- mode: ruby -*-
Vagrant.configure("2") do |config|
  config.vm.box				= "wheezy64"
  config.vm.box_url			= ""
  config.vm.provision "shell" do |s|
    s.inline 				= '			\
        echo -e "\
\ndeb http://mirrors.kernel.org/debian/ jessie main contrib non-free\
\ndeb-src http://mirrors.kernel.org/debian/ jessie main contrib non-free\
\n" >> /etc/apt/sources.list					\
        && echo \'APT::Default-Release "wheezy";\' > /etc/apt/apt.conf \
        && apt-get update					\
        && apt-get -u -y dist-upgrade				\
        && DEBIAN_FRONTEND=noninteractive apt-get install -y -t jessie \
            emacs24-nox emacs24-el				\
        && DEBIAN_FRONTEND=noninteractive apt-get install -y	\
            apt-show-versions python-pip			\
            wget bsdtar curl git				\
            multitail aspell screen				\
            apache2 mysql-server mysql-client php5 php5-mysql	\
        && sudo addgroup vagrant staff				\
        && echo && echo "Login w/ vagrant ssh"			\
	'
  end
  config.vm.synced_folder		   "..", "/home/vagrant/src"
  config.vm.provider "vmware_fusion" do |v|
    v.vmx["memsize"]			= "2048"
    v.vmx["numvcpus"]			= "2"
    v.gui 				= true
  end
  config.vm.provider "virtualbox" do |v|
    v.gui 				= true
  end
end
