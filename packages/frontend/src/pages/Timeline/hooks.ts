import { useState } from 'react';

import type Message from '@/types/models/Message';

export const useHooks = () => {
	const [messages, setMessages] = useState<Message[]>([]);
	const [openModal, setOpenModal] = useState(false);
	const handleOpen = () => setOpenModal(true);
	const handleClose = () => setOpenModal(false);

	return {
		openModal,
		handleOpen,
		handleClose,
		messages,
		setMessages
	};
};
