import { yupResolver } from '@hookform/resolvers/yup';
import axios from 'axios';
import { createElement, useState } from 'react';
import type { SubmitHandler } from 'react-hook-form';
import { useForm } from 'react-hook-form';
import { redirect, useNavigate } from 'react-router-dom';
import * as yup from 'yup';

import { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PostApiV1LoginMutationBody } from '@/generated/default/default';
import { usePostApiV1Login } from '@/generated/default/default';
import useLogin from '@/hooks/api/useLogin';
import useAuth from '@/hooks/useAuth';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

export const useHooks = () => {
	const [isAttempted, setIsAttempted] = useState(false);
	const navigation = useNavigate();
	const [formData, setFormData] = useState<PostApiV1LoginMutationBody>();
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
	const { register, handleSubmit, formState: { errors } } = useForm<PostApiV1LoginMutationBody>({
		resolver: yupResolver(schema)
	});
	const { mutate } = useLogin();
	const onSubmit: SubmitHandler<PostApiV1LoginMutationBody> = (data) => {
		mutate(data);
		// navigation('/');
	};

	return {
		isAttempted,
		formData,
		register,
		handleSubmit,
		onSubmit,
		errors
	};
};
