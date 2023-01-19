import axios from 'axios';
import { useEffect, useState } from 'react';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

export const useAuth = () => {
	const [check, setCheck] = useState<{
		checked: boolean;
		isAuthenticated: boolean;
	}>({ checked: false, isAuthenticated: false });
	useEffect(() => {
		const handleCheckSession = async () => {
			try {
				const { data: _ } = await axios.get(
					`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.users}/me`,
					{ withCredentials: true }
				);
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
