import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PutApiV1UsersMeBody } from '@/generated';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const signUp = async (formData: PutApiV1UsersMeBody): Promise<User> => {
	const response = await axios.put(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.users}/me`,
		formData,
		{ withCredentials: true }
	);
	return response.data;
};

const useUserInfoUpdate = (): UseMutationResult<
	User,
	AxiosError,
	PutApiV1UsersMeBody,
	undefined
> => {
	const queryClient = useQueryClient();
	const navigate = useNavigate();

	return useMutation(signUp, {
		onSuccess: (data) => {
			queryClient.setQueryData(['user'], data);
			// navigation('/');
			navigate('/');
		}
	});
};

export default useUserInfoUpdate;
