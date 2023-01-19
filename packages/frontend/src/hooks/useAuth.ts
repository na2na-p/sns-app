import type { QueryObserverResult, UseQueryOptions } from '@tanstack/react-query';
import { useQuery } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';
import { useEffect, useState } from 'react';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import {
	useGetApiV1UsersMe
} from '@/generated/default/default';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';
import UserContext from '@/utils/UserContext';

const getLoginUser = async (): Promise<User> => {
	const response = await axios.get(`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.users}/me`, { withCredentials: true });
	return response.data;
};

export const useGetUserQuery = <TData = User>(
	options?: UseQueryOptions<User, AxiosError, TData>
): QueryObserverResult<TData, AxiosError> =>
		useQuery(['user'], getLoginUser);

export const useAuth = () => {
	const [check, setCheck] = useState<{
    checked: boolean;
    isAuthenticated: boolean;
  }>({ checked: false, isAuthenticated: false });
	useEffect(()=>{
		const handleCheckSession = async () => {
			try {
				const { data } = await axios.get(`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.users}/me`, { withCredentials: true });
				console.log(data);
				setCheck({ checked: true, isAuthenticated: true });
			} catch {
				setCheck({ checked: true, isAuthenticated: false });
			}
		};
		handleCheckSession();
	}, []);

	return check;
};

export default useAuth;
