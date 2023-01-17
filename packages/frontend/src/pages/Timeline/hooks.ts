import usePing from '@/hooks/api/usePing';

export const useHooks = () => {
	const { data, isLoading } = usePing();
	return { data, isLoading };
};
