import Card from '@/components/dataDisplay/Card';

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
