import type { SxProps, Theme } from '@mui/material';
import type { StackProps as MuiStackProps } from '@mui/material/Stack';

import Box from '@/components/layout/Box';
import mergeSx from '@/utils/mergeSx';


const DEFAULT_SX = {
	overflowY: 'auto',
	height: '100%'
} satisfies SxProps<Theme>;

export type StackProps = MuiStackProps;

const ScrollContainer = ({ height, sx, children }: StackProps) => {
	const sxMerged = mergeSx(DEFAULT_SX, sx);
	return (
		<Box height={height} sx={sxMerged}>
			{children}
		</Box>
	);
};

export default ScrollContainer;
