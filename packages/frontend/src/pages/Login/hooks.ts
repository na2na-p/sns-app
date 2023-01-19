import { yupResolver } from '@hookform/resolvers/yup';
import type { SubmitHandler } from 'react-hook-form';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';

import type { PostApiV1LoginBody } from '@/generated/';
import useLogin from '@/hooks/api/useLogin';

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
			.max(32, '32文字以下で入力してください。')
	});
	const {
		register,
		handleSubmit,
		formState: { errors }
	} = useForm<PostApiV1LoginBody>({
		resolver: yupResolver(schema)
	});
	const { mutate } = useLogin();
	const onSubmit: SubmitHandler<PostApiV1LoginBody> = (data) => {
		mutate(data);
	};

	return {
		register,
		handleSubmit,
		onSubmit,
		errors
	};
};
