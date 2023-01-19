import { test } from '@playwright/test';

test.use({ storageState: { cookies: [], origins: [] } });

test.skip('ログイン', async ({ page }) => {
	await page.goto('/');
	await page.waitForNavigation();
	await page.locator('input[name="email"]').click();
	await page.locator('input[name="email"]').fill('foo@example.com');
	await page.locator('input[name="email"]').press('Tab');
	await page.locator('input[name="password"]').fill('aaaaAAAA');

	await Promise.all([
		page.waitForNavigation(),
		page.locator('text=ログイン').click()
	]);

	await page.waitForSelector('text=タイムライン');
});
