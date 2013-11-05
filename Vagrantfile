# -*- mode: ruby -*-
Vagrant.configure("2") do |config|
  config.vm.box				= "jessie64"
  config.vm.box_url			= "http://box.hardconsulting.com/jessie64.box"
  config.vm.provision "shell" do |s|
    s.inline 				= '			\
        apt-get update						\
        && apt-get -u -y dist-upgrade				\
        && apt-get install -y					\
            apt-show-versions python-pip			\
            lxc wget bsdtar curl git aufs-tools			\
            emacs24-nox emacs24-el screen			\
            multitail aspell					\
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
