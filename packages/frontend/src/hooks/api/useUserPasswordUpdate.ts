
import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PutApiV1UsersMePasswordBody } from '@/generated';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const signUp = async (formData: PutApiV1UsersMePasswordBody): Promise<User> => {
	const response = await axios.put(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.users}/me/password`,
		formData,
		{ withCredentials: true }
	);
	return response.data;
};

const useUserPasswordUpdate = (): UseMutationResult<
	User,
	AxiosError,
	PutApiV1UsersMePasswordBody,
	undefined
> => {
	const queryClient = useQueryClient();
	const navigate = useNavigate();

	return useMutation(signUp, {
		onSuccess: (data) => {
			queryClient.setQueryData(['user'], data);
			navigate('/');
		}
	});
};

export default useUserPasswordUpdate;
