import type { MutableRefObject } from 'react';
import { useEffect, useState } from 'react';

/**
 * ## HTMLElementのサイズを取得する
 *
 * 参照：[React公式ドキュメント](https://ja.reactjs.org/docs/hooks-faq.html#how-can-i-measure-a-dom-node)
 *
 * @param ref 対象のref
 */
const useClientRect = (ref: MutableRefObject<HTMLElement | null>) => {
	const getClientRect = () => {
		if (!ref || !ref.current) return null;
		const clientRects = ref.current.getClientRects();
		return clientRects.length > 0 ? clientRects[0] : null;
	};

	const [rect, setRect] = useState(getClientRect());
	const updateRect = () => setRect(getClientRect());

	useEffect(() => {
		updateRect();
		window.addEventListener('resize', updateRect);
		return () => window.removeEventListener('resize', updateRect);
	}, [ref.current]); // eslint-disable-line react-hooks/exhaustive-deps

	return rect;
};

export default useClientRect;
