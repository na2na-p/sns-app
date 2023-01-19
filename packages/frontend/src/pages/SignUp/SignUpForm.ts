import type { PostApiV1UsersBody } from '@/generated';

export type SignUpForm = PostApiV1UsersBody & {
	passwordConfirm: string;
}
