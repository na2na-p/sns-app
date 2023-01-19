import { useQueryClient } from '@tanstack/react-query';

import type User from '@/types/models/User';

// ログイン：User  非ログイン時：null  デフォルト：undefined
const useCurrentUser = (): User | null | undefined => {
	const queryClient = useQueryClient();
	return queryClient.getQueryData(['user']);
};

export default useCurrentUser;
