import { Navigate } from 'react-router-dom';

import type { PostApiV1LoginBody } from '@/generated/';
import useLogin from '@/hooks/api/useLogin';

export const Attempt = ({ data }: { data: PostApiV1LoginBody }) => {
	const { mutate } = useLogin();
	mutate(data);
	return <Navigate to={'/'} />;
};
