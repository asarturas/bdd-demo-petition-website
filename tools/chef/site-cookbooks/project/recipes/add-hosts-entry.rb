bash "add-hosts-entry" do
  user "root"
  cwd "/"
  code <<-EOH
  echo "127.0.0.1 #{node['project']['server_name']}" >> /etc/hosts
  EOH
end
