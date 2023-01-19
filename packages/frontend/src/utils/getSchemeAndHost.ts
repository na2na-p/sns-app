const getSchemeAndHost = (): string => {
	const { location } = window;
	return `${location.protocol}//${location.hostname}:80`;
};

export default getSchemeAndHost;
