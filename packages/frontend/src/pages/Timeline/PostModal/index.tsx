import type { Dispatch } from 'react';

import Card from '@/components/dataDisplay/Card';
import Modal from '@/components/dataDisplay/Modal';
import Button from '@/components/input/Button';
import TextInput from '@/components/input/TextInput';
import Box from '@/components/layout/Box';
import Stack from '@/components/layout/Stack';
import type Message from '@/types/models/Message';

import { useHooks } from './hooks';

export type PostModalProps = {
	openModal: boolean;
	handleClose: () => void;
	messages: Message[];
	setMessages: Dispatch<React.SetStateAction<Message[]>>;
};

const PostModal = ({
	openModal,
	handleClose,
	messages,
	setMessages
}: PostModalProps) => {
	const { register, handleSubmit, errors, isValid, onSubmit } = useHooks({
		handleClose,
		messages,
		setMessages
	});
	return (
		<Modal open={openModal} onClose={handleClose}>
			<Box
				sx={{
					position: 'absolute',
					top: '50%',
					left: '50%',
					transform: 'translate(-50%,-50%)'
				}}
			>
				<Card
					sx={{
						width: 500,
						height: 325,
						radius: 4,
						border: `solid 1px #E4E5E6`,
						padding: '30px'
					}}
				>
					<Stack height="100%" spacing={5}>
						<TextInput
							required
							multiline
							rows={4}
							type="body"
							placeholder="何を考えていますか？"
							{...register('body')}
							error={'body' in errors}
							helperText={errors.body?.message}
						/>
						<Button
							color="primary"
							variant="contained"
							label="投稿する"
							size="large"
							disabled={!isValid}
							onClick={handleSubmit(onSubmit)}
						/>
					</Stack>
				</Card>
			</Box>
		</Modal>
	);
};

export default PostModal;
