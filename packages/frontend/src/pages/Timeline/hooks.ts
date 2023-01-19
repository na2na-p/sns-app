import { useState } from 'react';

export const useHooks = () => {
	const [openModal, setOpenModal] = useState(false);
	const handleOpen = () => setOpenModal(true);
	const handleClose = () => setOpenModal(false);

	return {
		openModal,
		handleOpen,
		handleClose
	};
};
