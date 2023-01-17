import type { CardContentProps as MuiCardContentProps } from '@mui/material/CardContent';
import MuiCardContent from '@mui/material/CardContent';

export type CardContentProps = MuiCardContentProps;

const CardContent = ({ children, ...rest }: CardContentProps) => (
	<MuiCardContent {...rest}>
		{children}
	</MuiCardContent>
);

export default CardContent;
