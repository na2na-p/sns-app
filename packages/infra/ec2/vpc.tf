# VPC
resource "aws_vpc" "na2na-sns-app-backend" {
  cidr_block           = "10.0.0.0/16"
  enable_dns_support   = true # DNSサーバーによる名前解決を有効化
  enable_dns_hostnames = false

  tags = {
    Name = "na2na-sns-app-backend"
  }
}

# Subnet
resource "aws_subnet" "public" {
  vpc_id                  = aws_vpc.na2na-sns-app-backend.id
  cidr_block              = "10.0.1.0/24"
  availability_zone       = var.availability_zone
  map_public_ip_on_launch = true

  tags = {
    Name = "na2na-sns-app-backend"
  }
}

# Internet Gateway
resource "aws_internet_gateway" "na2na-sns-app-backend" {
  vpc_id = aws_vpc.na2na-sns-app-backend.id

  tags = {
    Name = "na2na-sns-app-backend"
  }
}

# Route Table
resource "aws_route_table" "public" {
  vpc_id = aws_vpc.na2na-sns-app-backend.id

  tags = {
    Name = "public_na2na-sns-app-backend"
  }
}

resource "aws_route" "na2na-sns-app-backend" {
  route_table_id         = aws_route_table.public.id
  gateway_id             = aws_internet_gateway.na2na-sns-app-backend.id
  destination_cidr_block = "0.0.0.0/0"
}

resource "aws_route_table_association" "na2na-sns-app-backend" {
  subnet_id      = aws_subnet.public.id
  route_table_id = aws_route_table.public.id
}

# Security Group
resource "aws_security_group" "na2na-sns-app-backend" {
  vpc_id = aws_vpc.na2na-sns-app-backend.id
  name   = "na2na-sns-app-backend"

  tags = {
    Name = "na2na-sns-app-backend"
  }
}

# アウトバウンドルール(全開放)
resource "aws_security_group_rule" "out_all" {
  security_group_id = aws_security_group.na2na-sns-app-backend.id
  type              = "egress"
  cidr_blocks       = ["0.0.0.0/0"]
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
}
