terraform {
  required_version = "~> 1.3.7"
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 3.0"
    }
    http = {
      source  = "hashicorp/http"
      version = "~> 3.2"
    }
  }
  backend "s3" {
    bucket         = "na2na-terraform-states"
    region         = "ap-northeast-1"
    key            = "sns-app/terraform.tfstate"
    encrypt        = true
    dynamodb_table = "na2na-sns-app-iac-backend"
  }
}

variable "availability_zone" {
  type = string
}

variable "instance_tag_name" {
  type = string
}

variable "iam_instance_profile_name" {
  type = string
}
