module.exports = {
	'env': {
		'browser': true,
		'es2021': true
	},
	'extends': [
		'plugin:react/recommended',
		'google'
	],
	'parser': '@typescript-eslint/parser',
	'parserOptions': {
		'ecmaFeatures': {
			'jsx': true
		},
		'ecmaVersion': 'latest',
		'sourceType': 'module'
	},
	'plugins': [
		'react',
		'react-hooks',
		'@typescript-eslint'
	],
	'rules': {
		'react/react-in-jsx-scope': 'off',
		'react/no-unknown-property': [
			'error',
			{ ignore: ['css'] }
		],
		'require-jsdoc': 'off',
		'react/display-name': 'off',
		'no-tabs': 'off',
		'max-len': 'off',
		'indent': ['error', 'tab'],
		'react-hooks/exhaustive-deps': 'error',
		'comma-dangle': ['error', 'never'],
		'object-curly-spacing': ['error', 'always'],
		'no-unused-vars': 'off',
		'react/jsx-tag-spacing': 2,
		'spaced-comment': ['error', 'always', { markers: ['/ <reference'] }]
	},
	'settings': {
		'react': {
			'version': 'detect'
		}
	}
};
