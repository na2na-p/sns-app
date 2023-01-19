import { Navigate } from 'react-router-dom';

import type { PostApiV1LoginMutationBody } from '@/generated/default/default';
import useLogin from '@/hooks/api/useLogin';

export const Attempt = ({ data }: {data: PostApiV1LoginMutationBody}) => {
	const { mutate } = useLogin();
	mutate(data);
	return <Navigate to={'/'} />;
};
