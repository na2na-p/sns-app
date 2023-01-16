import Card from '@components/dataDisplay/MessageCard/Card'; // TODO: MessageCardに置換
import React from 'react';

import usePing from '@/hooks/usePing';
import isNil from '@/utils/isNil';

const Timeline = () => {
	const { data, isLoading } = usePing();
	if (isNil(isLoading)) return null;
	console.log(data); // eslint-disable-line no-console
	return (
		<>
			<h1>sns-app</h1>
		</>
	);
};

export default Timeline;
