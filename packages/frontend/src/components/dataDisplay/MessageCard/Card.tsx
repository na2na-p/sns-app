import type { CardProps as MuiCardProps } from '@mui/material/Card';
import MuiCard from '@mui/material/Card';

export type CardProps = MuiCardProps;

const Card = ({ children, ...rest }: CardProps) => (
	<MuiCard {...rest}>
		{children}
	</MuiCard>
);

export default Card;
