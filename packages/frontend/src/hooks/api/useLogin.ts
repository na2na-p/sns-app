import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PostApiV1LoginBody } from '@/generated';
import routes from '@/routes';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const login = async (formData: PostApiV1LoginBody): Promise<User> => {
	const _ = await axios.post(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.login}`,
		formData,
		{ withCredentials: true }
	);
	const { data } = await axios.get(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.users}/me`,
		{ withCredentials: true }
	);
	return data;
};

const useLogin = (): UseMutationResult<
	User,
	AxiosError,
	PostApiV1LoginBody,
	undefined
> => {
	const queryClient = useQueryClient();
	const navigate = useNavigate();

	return useMutation(login, {
		onSuccess: (data) => {
			queryClient.setQueryData(['user'], data);
			navigate(routes.timeline.path());
			location.reload();
		}
	});
};

export default useLogin;
