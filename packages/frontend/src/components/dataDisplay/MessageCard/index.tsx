import Card from './Card';

type MessageCardProps = {
	userName: string;
	createdAt: Date;
	body: string;
	favoriteCount: number;
	isFavorited: boolean;
}

const MessageCard = ({
	userName,
	createdAt,
	body,
	favoriteCount,
	isFavorited
}: MessageCardProps) => {
	return (
		<Card>
		</Card>
	);
};

export default MessageCard;
