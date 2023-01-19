const getSchemeAndHost = (): string => {
	const { location } = window;
	return `${location.protocol}//${process.env.NODE_ENV === 'development' ? '' : 'api.'}${location.hostname}:${process.env.NODE_ENV === 'development' ? 80 : 443}`;
};

export default getSchemeAndHost;
