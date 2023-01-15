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
		'import',
		'react',
		'react-hooks',
		'react-refresh',
		'@typescript-eslint'
	],
	'rules': {
		'react/react-in-jsx-scope': 'off',
		'react/no-unknown-property': [
			'error',
			{ ignore: ['css'] }
		],
		'no-console': [
			'error',
			{
				'allow': ['error']
			}
		],
		'no-debugger': 'error',
		'object-shorthand': 2,
		'react-hooks/exhaustive-deps': 'error',
		'require-jsdoc': 'off',
		'react/display-name': 'off',
		'no-tabs': 'off',
		'max-len': 'off',
		'indent': ['error', 'tab'],
		'react-hooks/exhaustive-deps': 'error',
		'comma-dangle': ['error', 'never'],
		'object-curly-spacing': ['error', 'always'],
		'no-unused-vars': 'off',
		'react-refresh/only-export-components': 'warn',
		'react/jsx-tag-spacing': 2,
		'spaced-comment': ['error', 'always', { markers: ['/ <reference'] }],
		'sort-imports': [
			'error',
			{ 'ignoreCase': true, 'ignoreDeclarationSort': true }
		],
		'import/order': [
			'error',
			{
				'groups': [
					'builtin',
					'external',
					'internal',
					['sibling', 'parent'],
					'object'
				],
				'pathGroups': [
					{
						'pattern': '@/**',
						'group': 'external',
						'position': 'after'
					}
				],
				'alphabetize': {
					'order': 'asc',
					'caseInsensitive': true
				},
				'newlines-between': 'always'
			}
		],
		'@typescript-eslint/consistent-type-imports': [
			'error',
			{ 'prefer': 'type-imports' }
		],
		'import/no-duplicates': 'error',
		'@typescript-eslint/naming-convention': [
			'error',
			{
				'selector': 'typeAlias',
				'format': ['PascalCase']
			}
		]
	},
	'settings': {
		'react': {
			'version': 'detect'
		}
	}
};
