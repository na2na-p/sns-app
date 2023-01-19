import { forwardRef } from 'react';

import type { TextInputProps } from '@/components/input/TextInput';
import TextInput from '@/components/input/TextInput';

export type TextFormInputProps = TextInputProps;

const TextFormInput = forwardRef<TextInputProps>((props, ref) => {
	const { ...restProps } = props;
	return (
		<TextInput
			{...restProps}
			inputRef={ref}
		/>
	);
});

export default TextFormInput;
