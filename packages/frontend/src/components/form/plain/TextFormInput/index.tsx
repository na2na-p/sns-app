import { forwardRef } from 'react';
import type {
	DeepMap,
	FieldError,
	FieldValues,
	UseControllerProps } from 'react-hook-form';
import {
	useForm
} from 'react-hook-form';

import type { TextInputProps } from '@/components/input/TextInput';
import TextInput from '@/components/input/TextInput';

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
