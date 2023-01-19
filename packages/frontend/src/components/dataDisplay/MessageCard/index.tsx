import Card from '@/components/dataDisplay/Card';
import CardContent from '@/components/dataDisplay/Card/CardContent';
import CardHeader from '@/components/dataDisplay/Card/CardHeader';
import Typography from '@/components/dataDisplay/Typography';
import Box from '@/components/layout/Box';

import FavoriteButton from './FavoriteButton';

type MessageCardProps = {
	userName: string;
	created_at: Date;
	body: string;
	favoriteCount: number;
	isFavorited: boolean;
};

const MessageCard = (message: MessageCardProps) => {
	return (
		<Card>
			<CardHeader
				title={message.userName}
				titleTypographyProps={{ variant: 'subtitle1' }}
				subheader={message.created_at.toLocaleString()}
			/>
			<CardContent>
				<Typography variant="body1">{message.body}</Typography>
				<Box
					sx={{
						display: 'flex',
						justifyContent: 'flex-end',
						alignItems: 'center'
					}}
				>
					<FavoriteButton
						count={message.favoriteCount}
						isFavorited={message.isFavorited}
					/>
				</Box>
			</CardContent>
		</Card>
	);
};

export default MessageCard;
