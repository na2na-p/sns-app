import { defineConfig } from 'orval';

const config = defineConfig({
	api: {
		input: '../../documents/api/schema.json',
		output: {
			mode: 'tags-split',
			schemas: './src/generated/',
			client: 'react-query',
			clean: true,
			override: {
				query: {
					useQuery: true
				}
			}
		}
	}
});

export default config;
