import type { StackProps as MuiStackProps } from '@mui/material/Stack';
import MuiStack from '@mui/material/Stack';

export type StackProps = MuiStackProps;

const Stack = ({ spacing = 2, children, ...rest }: StackProps) => (
	<MuiStack spacing={spacing} {...rest}>
		{children}
	</MuiStack>
);
export default Stack;
