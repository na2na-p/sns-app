terraform {
  required_version = "~> 1.3.7"
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 3.0"
    }
    http = {
      source  = "hashicorp/http"
      version = "~> 2.0"
    }
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
