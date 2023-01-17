import type { ReactNode } from 'react';

import Box from '@/components/layout/Box';
import Stack from '@/components/layout/Stack';
import type Length from '@/types/Length';

export type GrayContainerProps = {
	width?: Length;
	height?: Length;
	children: ReactNode;
};

const GrayContainer = ({ width, height, children }: GrayContainerProps) => {
	return (
		<Stack spacing={0} height="100%" sx={{ overflowY: 'auto' }}>
			<Box
				boxSizing={'border-box'}
				padding={2}
				borderRadius={2}
				sx={{
					backgroundColor: '#FAFBFC',
					width,
					height,
					maxHeight: '100%',
					overflowY: 'auto'
				}}
			>
				{children}
			</Box>
		</Stack>
	);
};

export default GrayContainer;
