import type { StackProps as MuiStackProps } from '@mui/material/Stack';

import mergeSx from '@/utils/mergeSx';

import Box from './Box';

const DEFAULT_SX = {
	overflowY: 'clip',
	minHeight: 0
};

export type StackProps = MuiStackProps;

const StackRest = ({ sx, children }: StackProps) => {
	const sxMerged = mergeSx(DEFAULT_SX, sx);
	return (
		<Box flexGrow={1} flexBasis={0} sx={sxMerged}>
			{children}
		</Box>
	);
};
export default StackRest;
