// global-setup.ts
import type { FullConfig } from '@playwright/test';
import { request } from '@playwright/test';

async function globalSetup(_: FullConfig) {
	const requestContext = await request.newContext();
	await requestContext.post('http://localhost:3000/api/v1/login', {
		form: {
			'email': 'foo@example.com',
			'password': 'aaaaAAAA'
		}
	});
	// const browser = await chromium.launch();
	// const page = await browser.newPage();
	// await page.goto('http://localhost:3000/');
	// await page.waitForNavigation();
	// await page.locator('input[name="email"]').click();
	// await page.locator('input[name="email"]').fill('foo@example.com');
	// await page.locator('input[name="email"]').press('Tab');
	// await page.locator('input[name="password"]').fill('aaaaAAAA');

	// await Promise.all([
	// 	page.waitForNavigation(),
	// 	page.locator('text=ログイン').click()
	// ]);

	// Save signed-in state to 'storageState.json'.
	await requestContext.storageState({ path: './tests/playwright/storageState.json' });
	await requestContext.dispose();
}

export default globalSetup;
