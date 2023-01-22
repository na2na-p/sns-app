# AMI
data "aws_ssm_parameter" "amzn2_ami" {
  name = "/aws/service/ami-amazon-linux-latest/amzn2-ami-hvm-x86_64-gp2"
}

# EC2 Instance
resource "aws_instance" "na2na-sns-app-backend" {
  ami                    = data.aws_ssm_parameter.amzn2_ami.value
  vpc_security_group_ids = [aws_security_group.na2na-sns-app-backend.id]
  subnet_id              = aws_subnet.public.id
  key_name               = aws_key_pair.na2na-sns-app-backend.id
  instance_type          = "t2.micro"

  user_data = file("./setup.sh")

  tags = {
    Name = "na2na-sns-app-backend"
  }
}

# Elastic IP
resource "aws_eip" "na2na-sns-app-backend" {
  instance = aws_instance.na2na-sns-app-backend.id
  vpc      = true
}

# Output PublicIp
output "public_ip" {
  value = aws_eip.na2na-sns-app-backend.public_ip
}

# Key Pair
resource "aws_key_pair" "na2na-sns-app-backend" {
  key_name   = "na2na-sns-app-backend-key"
  public_key = file("~/.ssh/id_ed25519.pub")
}
