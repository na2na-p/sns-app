#!/bin/bash
sudo yum update -y
sudo yum install -y git
sudo yum install -y docker
sudo systemctl start docker
sudo systemctl enable docker
sudo usermod -a -G docker ec2-user
sudo mkdir -p /usr/local/lib/docker/cli-plugins
VER=2.5.1
sudo curl \
-L https://github.com/docker/compose/releases/download/v${VER}/docker-compose-$(uname -s)-$(uname -m) \
-o /usr/local/lib/docker/cli-plugins/docker-compose
sudo chmod +x /usr/local/lib/docker/cli-plugins/docker-compose
sudo ln -s /usr/local/lib/docker/cli-plugins/docker-compose /usr/bin/docker-compose
cd /home/ec2-user
sudo chown -R ec2-user .git/
sudo -u ec2-user git clone https://github.com/na2na-p/sns-app.git
cd sns-app
sudo -u ec2-user make setup-local

curl -L --output cloudflared.rpm https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-x86_64.rpm && 
sudo yum localinstall -y cloudflared.rpm && 
