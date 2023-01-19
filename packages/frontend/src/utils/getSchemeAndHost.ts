const getSchemeAndHost = (): string => {
	const { location } = window;
	return `${location.protocol}//${location.hostname}:${location.protocol === 'https' ? 443 : 80}`;
};

export default getSchemeAndHost;
