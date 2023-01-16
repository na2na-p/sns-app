const getSchemeAndHost = (): string => {
	const { location } = window;
	return `${location.protocol}//${location.host}`;
};

export default getSchemeAndHost;
