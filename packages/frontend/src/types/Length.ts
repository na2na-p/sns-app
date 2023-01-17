/**
 * width, heightに渡せる値の型
 */
type Length = `${number}${'px' | 'vw' | 'vh' | '%'}` | `calc(${string})`;

export default Length;
