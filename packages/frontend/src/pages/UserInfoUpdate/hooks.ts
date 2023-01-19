import { yupResolver } from '@hookform/resolvers/yup';
import type { SubmitHandler } from 'react-hook-form';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';

import type { PutApiV1UsersMeBody } from '@/generated/';
import useUserInfoUpdate from '@/hooks/api/useUserInfoUpdate';

import type { SignUpForm } from './SignUpForm';

export const useHooks = () => {
	const schema = yup.object({
		email: yup
			.string()
			.email('正しい形式で入力してください。')
			.required('この項目は必須です。'),
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
	const { mutate } = useUserInfoUpdate();
	const onSubmit: SubmitHandler<PutApiV1UsersMeBody> = (data) => {
		mutate({
			email: data.email,
			name: data.name
		} satisfies PutApiV1UsersMeBody);
	};

	return {
		register,
		handleSubmit,
		onSubmit,
		errors
	};
};
