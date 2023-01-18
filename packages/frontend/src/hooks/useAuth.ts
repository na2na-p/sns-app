import { useEffect, useState } from 'react';

import {
	useGetApiV1UsersMe
} from '@/generated/default/default';
import UserContext from '@/utils/UserContext';

export const useAuth = () => {
	const [check, setCheck] = useState<{
    checked: boolean;
    isAuthenticated: boolean;
  }>({ checked: false, isAuthenticated: false });
	useEffect(()=>{
		const handleCheckSession = async () => {
			try {
				const { data: _ } = useGetApiV1UsersMe();
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
