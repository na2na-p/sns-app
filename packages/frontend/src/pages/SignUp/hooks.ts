import { yupResolver } from '@hookform/resolvers/yup';
import type { SubmitHandler } from 'react-hook-form';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';

import type { PostApiV1UsersBody } from '@/generated/';
import useSignUp from '@/hooks/api/useSignUp';

import type { SignUpForm } from './SignUpForm';

export const useHooks = () => {
	const schema = yup.object({
		email: yup
			.string()
			.email('正しい形式で入力してください。')
			.required('この項目は必須です。'),
		password: yup
			.string()
			.required('この項目は必須です。')
			.min(8, '8文字以上で入力してください。')
			.max(32, '32文字以下で入力してください。'),
		passwordConfirm: yup
			.string()
			.required('この項目は必須です。')
			.min(8, '8文字以上で入力してください。')
			.max(32, '32文字以下で入力してください。')
			.oneOf([yup.ref('password')], 'パスワードが一致しません。'),
		name: yup
			.string()
			.required('この項目は必須です。')
			.max(64, '64文字以下で入力してください。')

	});
	const {
		register,
		handleSubmit,
		formState: { errors }
	} = useForm<SignUpForm>({
		resolver: yupResolver(schema)
	});
	const { mutate } = useSignUp();
	const onSubmit: SubmitHandler<SignUpForm> = (data) => {
		mutate({
			email: data.email,
			name: data.name,
			password: data.password
		} satisfies PostApiV1UsersBody);
	};

	return {
		register,
		handleSubmit,
		onSubmit,
		errors
	};
};
