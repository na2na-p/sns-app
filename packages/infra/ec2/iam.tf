resource "aws_iam_instance_profile" "sns-app-backend_for_ssm" {
  name = var.iam_instance_profile_name
  role = aws_iam_role.sns-app-backend_for_ssm.name
}

resource "aws_iam_role" "sns-app-backend_for_ssm" {
  name = "NA2NASNSAPPBackendForSSM"
  path = "/"

  assume_role_policy = <<EOF
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Action": "sts:AssumeRole",
            "Principal": {
							"Service": "ec2.amazonaws.com"
            },
            "Effect": "Allow",
            "Sid": ""
        }
    ]
}
EOF
}

resource "aws_iam_role_policy_attachment" "backend_for_ssm_for_ssm_attachment0" {
  role       = aws_iam_role.sns-app-backend_for_ssm.name
  policy_arn = "arn:aws:iam::aws:policy/AmazonSSMManagedInstanceCore"
}
