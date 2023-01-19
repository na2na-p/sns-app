import { yupResolver } from '@hookform/resolvers/yup';
import type { SubmitHandler } from 'react-hook-form';
import { useForm } from 'react-hook-form';
import { useNavigate } from 'react-router-dom';
import * as yup from 'yup';

import type { PostApiV1LoginBody } from '@/generated/';
import useLogin from '@/hooks/api/useLogin';
import routes from '@/routes';

export const useHooks = () => {
	const navigate = useNavigate();
	const signUpNavigate = () => {
		navigate(routes.signUp.path());
	};
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
		navigate(routes.timeline.path());
	};

	return {
		signUpNavigate,
		register,
		handleSubmit,
		onSubmit,
		errors
	};
};
