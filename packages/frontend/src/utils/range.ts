const range = (last = 30, first = 1, step = 1) => {
	const result: number[] = [];
	for (let i = first; i <= last; i = i + step) {
		result.push(i);
	}
	return result;
};

export default range;
