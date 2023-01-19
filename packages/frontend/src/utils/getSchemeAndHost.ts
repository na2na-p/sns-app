const getSchemeAndHost = (): string => {
	const { location } = window;
	return `${location.protocol}//${process.env.NODE_ENV === 'development' ? '' : 'api.'}${location.hostname}:${location.protocol === 'https' ? 443 : 80}`;
};

export default getSchemeAndHost;
