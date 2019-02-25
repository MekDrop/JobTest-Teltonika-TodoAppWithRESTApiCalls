# -*- mode: ruby -*-
# vi: set ft=ruby :

require 'yaml'

VAGRANTFILE_API_VERSION ||= "2"
confDir = $confDir ||= File.expand_path(File.dirname(__FILE__))

homesteadYamlPath = confDir + "/Homestead.yaml"
afterScriptPath = confDir + "/homestead-provision.sh"
aliasesPath = confDir + "/homestead-aliases.sh"

needed_reboot = false
[
    'vagrant-hostmanager',
    'vagrant-notify',
    'vagrant-fsnotify',
].each do |plugin|
    unless Vagrant.has_plugin?(plugin)
        system 'vagrant plugin install ' + plugin
        needed_reboot = true
    end
end
if needed_reboot
    system 'vagrant ' + ARGV.join(" ")
    exit true
end
needed_reboot = nil

system 'git submodule update'

require File.expand_path(File.dirname(__FILE__) + '/.homestead/scripts/homestead.rb')

Vagrant.require_version '>= 2.1.0'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    if File.exist? aliasesPath then
        config.vm.provision "file", source: aliasesPath, destination: "/tmp/bash_aliases"
        config.vm.provision "shell" do |s|
            s.inline = "awk '{ sub(\"\r$\", \"\"); print }' /tmp/bash_aliases > /home/vagrant/.bash_aliases && chown vagrant:vagrant /home/vagrant/.bash_aliases"
        end
    end

    if File.exist? homesteadYamlPath then
        settings = YAML::load(File.read(homesteadYamlPath))
    else
        abort "Homestead settings file not found in #{confDir}"
    end

    Homestead.configure(config, settings)

    config.vm.provision "shell", path: afterScriptPath, privileged: false, keep_color: true, args: Vagrant::Util::Platform.windows?.to_s

    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true
    config.hostmanager.manage_guest = true
    config.hostmanager.ignore_private_ip = false
    config.hostmanager.include_offline = true
    config.hostmanager.aliases = settings['sites'].map do |site|
        site['map']
    end

    config.trigger.after :up do |trigger|
        trigger.info = 'If you want to monitor file changes on host, you need to run "vagrant fsnotify" command.'
    end
end
